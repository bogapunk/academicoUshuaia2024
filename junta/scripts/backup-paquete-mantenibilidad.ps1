<#
  Respaldo de archivos del paquete de mantenibilidad (.env, config, conexión).
  Crea una carpeta timestamped en backups/mantenibilidad-YYYYMMDD-HHmmss/

  Uso:
    .\scripts\backup-paquete-mantenibilidad.ps1
    .\scripts\backup-paquete-mantenibilidad.ps1 -Etiqueta "antes-cambios"
#>
param(
    [string]$Etiqueta = ""
)

$ErrorActionPreference = 'Stop'
$JuntaRoot = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$RepoRoot  = (Resolve-Path (Join-Path $JuntaRoot "..")).Path
$BackupBase = Join-Path $JuntaRoot "backups"

if (-not (Test-Path $BackupBase)) {
    New-Item -ItemType Directory -Path $BackupBase | Out-Null
}

$stamp = Get-Date -Format "yyyyMMdd-HHmmss"
$suffix = if ($Etiqueta) { "-$Etiqueta" } else { "" }
$BackupDir = Join-Path $BackupBase "mantenibilidad-$stamp$suffix"

New-Item -ItemType Directory -Path $BackupDir | Out-Null

$archivos = @(
    @{ Origen = Join-Path $JuntaRoot "junta_config.php";           Destino = "junta_config.php" },
    @{ Origen = Join-Path $JuntaRoot "Usuarios_Conexion_Sqlserver.php"; Destino = "Usuarios_Conexion_Sqlserver.php" },
    @{ Origen = Join-Path $JuntaRoot "Config\Config.php";          Destino = "Config\Config.php" },
    @{ Origen = Join-Path $RepoRoot  ".gitignore";                 Destino = "_repo_.gitignore" }
)

$manifest = @()
foreach ($item in $archivos) {
    if (Test-Path $item.Origen) {
        $destPath = Join-Path $BackupDir $item.Destino
        $destFolder = Split-Path $destPath -Parent
        if (-not (Test-Path $destFolder)) {
            New-Item -ItemType Directory -Path $destFolder -Force | Out-Null
        }
        Copy-Item -LiteralPath $item.Origen -Destination $destPath -Force
        $manifest += [PSCustomObject]@{
            archivo  = $item.Destino
            origen   = $item.Origen
            respaldo = $destPath
            fecha    = (Get-Date -Format "yyyy-MM-dd HH:mm:ss")
        }
        Write-Host "  OK  $($item.Destino)" -ForegroundColor Green
    } else {
        Write-Host "  --  $($item.Destino) (no existia, omitido)" -ForegroundColor Yellow
    }
}

$manifestPath = Join-Path $BackupDir "MANIFEST.json"
$manifest | ConvertTo-Json -Depth 4 | Set-Content -Path $manifestPath -Encoding UTF8

$info = @"
Paquete de mantenibilidad - Respaldo
====================================
Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
Carpeta: $BackupDir

Archivos respaldados: $($manifest.Count)

Restaurar con:
  .\scripts\restore-paquete-mantenibilidad.ps1 -BackupDir "$BackupDir"
  .\scripts\restore-paquete-mantenibilidad.ps1 -Latest
"@

Set-Content -Path (Join-Path $BackupDir "LEEME-RESTAURACION.txt") -Value $info -Encoding UTF8

Write-Host ""
Write-Host "Respaldo completado:" -ForegroundColor Green
Write-Host "  $BackupDir"
Write-Host ""
Write-Host "Para restaurar:" -ForegroundColor Cyan
Write-Host "  .\scripts\restore-paquete-mantenibilidad.ps1 -Latest"
