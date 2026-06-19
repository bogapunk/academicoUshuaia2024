<#
  Restaura archivos del paquete rendimiento P2/P3/P4 desde un respaldo.

  Uso:
    .\scripts\restore-rendimiento-p234.ps1 -Latest
    .\scripts\restore-rendimiento-p234.ps1 -BackupDir "D:\...\backups\rendimiento-p234-..."
    .\scripts\restore-rendimiento-p234.ps1 -List
    .\scripts\restore-rendimiento-p234.ps1 -Latest -PhpIniPath "D:\xampp\php\php.ini"
#>
param(
    [string]$BackupDir = "",
    [string]$PhpIniPath = "D:\xampp\php\php.ini",
    [switch]$Latest,
    [switch]$List,
    [switch]$Force
)

$ErrorActionPreference = 'Stop'
$JuntaRoot  = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$BackupBase = Join-Path $JuntaRoot "backups"

if ($List) {
    if (-not (Test-Path $BackupBase)) {
        Write-Host "No hay carpeta de respaldos." -ForegroundColor Yellow
        exit 0
    }
    Get-ChildItem $BackupBase -Directory -Filter "rendimiento-p234-*" |
        Sort-Object Name -Descending |
        ForEach-Object {
            $manifest = Join-Path $_.FullName "MANIFEST.json"
            $fecha = if (Test-Path $manifest) {
                try {
                    (Get-Content $manifest -Raw | ConvertFrom-Json).fecha
                } catch { "?" }
            } else { "?" }
            Write-Host "$($_.Name)  ($fecha)"
            Write-Host "  $($_.FullName)"
        }
    exit 0
}

if ($Latest) {
    $dir = Get-ChildItem $BackupBase -Directory -Filter "rendimiento-p234-*" -ErrorAction SilentlyContinue |
        Sort-Object Name -Descending |
        Select-Object -First 1
    if (-not $dir) {
        Write-Error "No se encontraron respaldos rendimiento-p234-* en $BackupBase"
    }
    $BackupDir = $dir.FullName
}

if (-not $BackupDir -or -not (Test-Path $BackupDir)) {
    Write-Error "Especifique -BackupDir o -Latest. Use -List para ver respaldos disponibles."
}

$manifestPath = Join-Path $BackupDir "MANIFEST.json"
if (-not (Test-Path $manifestPath)) {
    Write-Error "MANIFEST.json no encontrado en $BackupDir"
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host " RESTAURACION rendimiento P2/P3/P4" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Origen:  $BackupDir"
Write-Host ""

if (-not $Force) {
    Write-Host "Se restauraran los archivos originales previos a las optimizaciones." -ForegroundColor Yellow
    Write-Host "Presione Enter para continuar o Ctrl+C para cancelar..."
    [void][System.Console]::ReadLine()
}

$mapa = @{
    "views\Docentes\VerInscripciones.php"     = Join-Path $JuntaRoot "views\Docentes\VerInscripciones.php"
    "views\Docentes\ListarDocentes.php"       = Join-Path $JuntaRoot "views\Docentes\ListarDocentes.php"
    "views\Modalidades\ListarModalidades.php" = Join-Path $JuntaRoot "views\Modalidades\ListarModalidades.php"
    "_xampp_php.ini"                          = $PhpIniPath
}

$restaurados = 0
$errores = @()

foreach ($rel in $mapa.Keys) {
    $src = Join-Path $BackupDir $rel
    $dst = $mapa[$rel]
    if (-not (Test-Path $src)) {
        Write-Host "  --  $rel (no estaba en el respaldo)" -ForegroundColor Yellow
        continue
    }
    try {
        $dstFolder = Split-Path $dst -Parent
        if ($dstFolder -and -not (Test-Path $dstFolder)) {
            New-Item -ItemType Directory -Path $dstFolder -Force | Out-Null
        }
        Copy-Item -LiteralPath $src -Destination $dst -Force
        Write-Host "  OK  $rel -> $dst" -ForegroundColor Green
        $restaurados++
    } catch {
        $errores += "$rel : $($_.Exception.Message)"
        Write-Host "  ERR $rel : $($_.Exception.Message)" -ForegroundColor Red
    }
}

Write-Host ""
if ($errores.Count -gt 0) {
    Write-Host "Restauracion completada con errores ($restaurados OK, $($errores.Count) fallos)." -ForegroundColor Red
    foreach ($e in $errores) { Write-Host "  - $e" -ForegroundColor Red }
    exit 1
}

Write-Host "Restauracion completada: $restaurados archivo(s)." -ForegroundColor Green
Write-Host ""
Write-Host "PASOS OBLIGATORIOS tras restaurar:" -ForegroundColor Cyan
Write-Host "  1. Reinicie Apache desde el Panel de Control XAMPP (Stop -> Start)"
Write-Host "  2. Verifique: http://localhost:8080/juntas2024/junta/views/panel1.php"
Write-Host "  3. (Opcional) .\scripts\verify-rendimiento-p234-backup.ps1 -Latest -CompareLive"
Write-Host ""
