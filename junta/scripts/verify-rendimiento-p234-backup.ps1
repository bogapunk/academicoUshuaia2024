<#
  Verifica integridad de un respaldo rendimiento P2/P3/P4.

  Uso:
    .\scripts\verify-rendimiento-p234-backup.ps1 -Latest
    .\scripts\verify-rendimiento-p234-backup.ps1 -BackupDir "D:\...\backups\rendimiento-p234-..."
    .\scripts\verify-rendimiento-p234-backup.ps1 -Latest -CompareLive
#>
param(
    [string]$BackupDir = "",
    [switch]$Latest,
    [switch]$CompareLive
)

$ErrorActionPreference = 'Stop'
$JuntaRoot  = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$BackupBase = Join-Path $JuntaRoot "backups"

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
    Write-Error "Especifique -BackupDir o -Latest."
}

$manifestPath = Join-Path $BackupDir "MANIFEST.json"
if (-not (Test-Path $manifestPath)) {
    Write-Error "MANIFEST.json no encontrado."
}

$meta = Get-Content $manifestPath -Raw | ConvertFrom-Json
$ok = 0
$fail = 0

Write-Host "Verificando respaldo: $BackupDir" -ForegroundColor Cyan
Write-Host "Fecha respaldo: $($meta.fecha)"
Write-Host ""

$liveMap = @{
    "views\Docentes\VerInscripciones.php"     = Join-Path $JuntaRoot "views\Docentes\VerInscripciones.php"
    "views\Docentes\ListarDocentes.php"       = Join-Path $JuntaRoot "views\Docentes\ListarDocentes.php"
    "views\Modalidades\ListarModalidades.php" = Join-Path $JuntaRoot "views\Modalidades\ListarModalidades.php"
}

foreach ($entry in $meta.archivos) {
    if ($entry.omitido) {
        Write-Host "  --  $($entry.archivo) (omitido en respaldo)" -ForegroundColor Yellow
        continue
    }
    $backupFile = Join-Path $BackupDir $entry.archivo
    if (-not (Test-Path $backupFile)) {
        Write-Host "  FAIL $($entry.archivo) - archivo ausente" -ForegroundColor Red
        $fail++
        continue
    }
    $hash = (Get-FileHash -LiteralPath $backupFile -Algorithm SHA256).Hash
    if ($entry.sha256 -and $hash -ne $entry.sha256) {
        Write-Host "  FAIL $($entry.archivo) - checksum no coincide" -ForegroundColor Red
        $fail++
        continue
    }
    Write-Host "  OK   $($entry.archivo)" -ForegroundColor Green
    $ok++

    if ($CompareLive -and $liveMap.ContainsKey($entry.archivo)) {
        $live = $liveMap[$entry.archivo]
        if (Test-Path $live) {
            $liveHash = (Get-FileHash -LiteralPath $live -Algorithm SHA256).Hash
            if ($liveHash -eq $hash) {
                Write-Host "       Live = respaldo (sin cambios desde backup)" -ForegroundColor DarkGray
            } else {
                Write-Host "       Live != respaldo (archivo modificado desde backup)" -ForegroundColor Yellow
            }
        }
    }
}

Write-Host ""
if ($fail -eq 0) {
    Write-Host "Verificacion OK: $ok archivo(s) validos." -ForegroundColor Green
    exit 0
}
Write-Host "Verificacion FALLIDA: $ok OK, $fail errores." -ForegroundColor Red
exit 1
