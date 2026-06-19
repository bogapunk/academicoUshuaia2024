<#
  Crea un ZIP con una copia del directorio de la app (Juntas / junta), excluyendo
  /backups para no anidar archivos de respaldo.
  Uso: desde PowerShell en la carpeta del proyecto o con ruta absoluta al script.
  .\scripts\backup-junta-ui.ps1
#>
$ErrorActionPreference = 'Stop'
$JuntaRoot = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$BackupDir = Join-Path $JuntaRoot "backups"
if (-not (Test-Path $BackupDir)) { New-Item -ItemType Directory -Path $BackupDir | Out-Null }

$stamp    = Get-Date -Format "yyyyMMdd-HHmmss"
$zipName  = "junta-copia-$stamp.zip"
$zipPath  = Join-Path $BackupDir $zipName

$items = @(Get-ChildItem $JuntaRoot -Force | Where-Object { $_.Name -ne 'backups' })
if ($items.Count -eq 0) {
  Write-Error "No se encontró contenido para respaldar en: $JuntaRoot"
  exit 1
}

if (Test-Path $zipPath) { Remove-Item -LiteralPath $zipPath -Force }

# PowerShell: comprimir el contenido de $JuntaRoot (sin la carpeta backups) 
$work = Join-Path $env:TEMP "junta-zipwork-$stamp"
if (Test-Path $work) { Remove-Item -Recurse -Force $work }
New-Item -ItemType Directory -Path $work | Out-Null
foreach ($i in (Get-ChildItem $JuntaRoot -Force | Where-Object { $_.Name -ne 'backups' })) {
  Copy-Item -LiteralPath $i.FullName -Destination (Join-Path $work $i.Name) -Recurse -Force
}
Compress-Archive -Path (Join-Path $work '*') -DestinationPath $zipPath -Force
Remove-Item -Recurse -Force $work

Write-Host "Respaldo creado: $zipPath" -ForegroundColor Green
Write-Host "Para deshacer cambios de la interfaz, ejecuta restore-junta-ui.ps1 y elige este archivo o -Latest" -ForegroundColor Cyan
