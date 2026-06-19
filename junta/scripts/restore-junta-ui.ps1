<#
  Restaura un ZIP generado con backup-junta-ui.ps1 sobre el directorio junta/ actual.
  Antes de reemplazar, crea otro respaldo "auto-antes-restore" en /backups.
  Uso:
    .\scripts\restore-junta-ui.ps1 -Latest
    .\scripts\restore-junta-ui.ps1 -ZipPath "D:\...\backups\junta-copia-20250424-120000.zip"
#>
[CmdletBinding()]
param(
  [string]$ZipPath = "",
  [switch]$Latest,
  [switch]$SkipPreBackup
)

$ErrorActionPreference = 'Stop'
$JuntaRoot  = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$BackupDir  = Join-Path $JuntaRoot "backups"
if ($Latest) {
  if (-not (Test-Path $BackupDir)) { Write-Error "No existe la carpeta backups. Ejecuta primero backup-junta-ui.ps1"; exit 1 }
  $cands = Get-ChildItem -Path $BackupDir -Filter "junta-copia-*.zip" -File -ErrorAction SilentlyContinue | Sort-Object LastWriteTime -Descending
  if (-not $cands) { Write-Error "No hay archivos junta-copia-*.zip en $BackupDir"; exit 1 }
  $ZipPath = $cands[0].FullName
  Write-Host "Usando el respaldo mas reciente: $ZipPath" -ForegroundColor Yellow
}

if ([string]::IsNullOrWhiteSpace($ZipPath) -or -not (Test-Path -LiteralPath $ZipPath)) {
  Write-Error "Indica -Latest o -ZipPath con un .zip existente"
  exit 1
}

if (-not $SkipPreBackup) {
  Write-Host "Creando respaldo de seguridad previo a la restauracion..." -ForegroundColor Yellow
  & (Join-Path $PSScriptRoot "backup-junta-ui.ps1")
}

$stamp  = Get-Date -Format "yyyyMMdd-HHmmss"
$tmp    = Join-Path $env:TEMP "junta-restore-extract-$stamp"
if (Test-Path $tmp) { Remove-Item -Recurse -Force $tmp }
New-Item -ItemType Directory -Path $tmp | Out-Null

try {
  Expand-Archive -LiteralPath $ZipPath -DestinationPath $tmp -Force
} catch {
  Write-Error "No se pudo extraer el ZIP: $_"
  exit 1
}

# Contenido extraído: a veces un solo directorio o archivos en raíz
$rootItems = Get-ChildItem $tmp
$sourceRoot = $tmp
if ($rootItems.Count -eq 1 -and $rootItems[0].PSIsContainer) { $sourceRoot = $rootItems[0].FullName }

# Copiar (sobrescribir) sobre $JuntaRoot, sin borrar toda la carpeta; preserva /backups si queda fuera del zip
foreach ($i in (Get-ChildItem -LiteralPath $sourceRoot -Force)) {
  $name = $i.Name
  if ($name -eq 'backups') { continue }  # no pisa la cola de respaldos
  $dest = Join-Path $JuntaRoot $name
  if (Test-Path $dest) { Remove-Item -LiteralPath $dest -Recurse -Force -ErrorAction SilentlyContinue }
  Copy-Item -LiteralPath $i.FullName -Destination $dest -Recurse -Force
}

Remove-Item -Recurse -Force $tmp
Write-Host "Restauracion finalizada. Revisa el sitio en el navegador." -ForegroundColor Green
Write-Host "Si algo falla, en /backups tienes pre-restore y otras copias." -ForegroundColor Cyan
