<#
  Restaura archivos del paquete de mantenibilidad desde un respaldo.

  Uso:
    .\scripts\restore-paquete-mantenibilidad.ps1 -Latest
    .\scripts\restore-paquete-mantenibilidad.ps1 -BackupDir "D:\...\backups\mantenibilidad-20260618-120000"
    .\scripts\restore-paquete-mantenibilidad.ps1 -List
#>
param(
    [string]$BackupDir = "",
    [switch]$Latest,
    [switch]$List
)

$ErrorActionPreference = 'Stop'
$JuntaRoot = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$RepoRoot  = (Resolve-Path (Join-Path $JuntaRoot "..")).Path
$BackupBase = Join-Path $JuntaRoot "backups"

if ($List) {
    if (-not (Test-Path $BackupBase)) {
        Write-Host "No hay carpeta de respaldos." -ForegroundColor Yellow
        exit 0
    }
    Get-ChildItem $BackupBase -Directory -Filter "mantenibilidad-*" |
        Sort-Object Name -Descending |
        ForEach-Object { Write-Host $_.FullName }
    exit 0
}

if ($Latest) {
    $dir = Get-ChildItem $BackupBase -Directory -Filter "mantenibilidad-*" -ErrorAction SilentlyContinue |
        Sort-Object Name -Descending |
        Select-Object -First 1
    if (-not $dir) {
        Write-Error "No se encontraron respaldos en $BackupBase"
    }
    $BackupDir = $dir.FullName
}

if (-not $BackupDir -or -not (Test-Path $BackupDir)) {
    Write-Error "Especifique -BackupDir o -Latest. Use -List para ver respaldos disponibles."
}

Write-Host "Restaurando desde: $BackupDir" -ForegroundColor Cyan
Write-Host ""

$mapa = @{
    "junta_config.php"                = Join-Path $JuntaRoot "junta_config.php"
    "Usuarios_Conexion_Sqlserver.php" = Join-Path $JuntaRoot "Usuarios_Conexion_Sqlserver.php"
    "Config\Config.php"               = Join-Path $JuntaRoot "Config\Config.php"
    "_repo_.gitignore"                = Join-Path $RepoRoot  ".gitignore"
}

$restaurados = 0
foreach ($rel in $mapa.Keys) {
    $src = Join-Path $BackupDir $rel
    $dst = $mapa[$rel]
    if (Test-Path $src) {
        $dstFolder = Split-Path $dst -Parent
        if (-not (Test-Path $dstFolder)) {
            New-Item -ItemType Directory -Path $dstFolder -Force | Out-Null
        }
        Copy-Item -LiteralPath $src -Destination $dst -Force
        Write-Host "  Restaurado: $rel" -ForegroundColor Green
        $restaurados++
    }
}

# Eliminar archivos nuevos del paquete (opcional, seguros de quitar)
$nuevos = @(
    (Join-Path $JuntaRoot ".env"),
    (Join-Path $JuntaRoot "junta_env.php"),
    (Join-Path $JuntaRoot "README.md"),
    (Join-Path $JuntaRoot "scripts\smoke-test.ps1")
)
Write-Host ""
Write-Host "Archivos nuevos del paquete (eliminar manualmente si desea revertir por completo):" -ForegroundColor Yellow
foreach ($f in $nuevos) {
    if (Test-Path $f) {
        Write-Host "  - $f"
    }
}

Write-Host ""
Write-Host "Restauracion completada: $restaurados archivo(s)." -ForegroundColor Green
Write-Host "Reinicie Apache si la aplicacion no responde como antes." -ForegroundColor Cyan
