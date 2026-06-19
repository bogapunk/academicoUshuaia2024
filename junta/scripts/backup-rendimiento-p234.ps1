<#
  Respaldo previo a optimizaciones de rendimiento — puntos 2, 3 y 4:
    2) Conexión única BD (VerInscripciones, ListarDocentes)
    3) DataTables en ListarModalidades
    4) OPcache en php.ini (XAMPP)

  Crea: backups/rendimiento-p234-YYYYMMDD-HHmmss[-etiqueta]/

  Uso:
    .\scripts\backup-rendimiento-p234.ps1
    .\scripts\backup-rendimiento-p234.ps1 -Etiqueta "pre-implementacion"
    .\scripts\backup-rendimiento-p234.ps1 -PhpIniPath "D:\xampp\php\php.ini"
#>
param(
    [string]$Etiqueta = "",
    [string]$PhpIniPath = "D:\xampp\php\php.ini"
)

$ErrorActionPreference = 'Stop'
$JuntaRoot  = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$BackupBase = Join-Path $JuntaRoot "backups"

if (-not (Test-Path $BackupBase)) {
    New-Item -ItemType Directory -Path $BackupBase | Out-Null
}

$stamp = Get-Date -Format "yyyyMMdd-HHmmss"
$suffix = if ($Etiqueta) { "-$Etiqueta" } else { "" }
$BackupDir = Join-Path $BackupBase "rendimiento-p234-$stamp$suffix"
New-Item -ItemType Directory -Path $BackupDir | Out-Null
New-Item -ItemType Directory -Path (Join-Path $BackupDir "views\Docentes") -Force | Out-Null
New-Item -ItemType Directory -Path (Join-Path $BackupDir "views\Modalidades") -Force | Out-Null

function Get-FileSha256 {
    param([string]$Path)
    if (-not (Test-Path $Path)) { return $null }
    return (Get-FileHash -LiteralPath $Path -Algorithm SHA256).Hash
}

$archivos = @(
    @{
        Origen  = Join-Path $JuntaRoot "views\Docentes\VerInscripciones.php"
        Destino = "views\Docentes\VerInscripciones.php"
    },
    @{
        Origen  = Join-Path $JuntaRoot "views\Docentes\ListarDocentes.php"
        Destino = "views\Docentes\ListarDocentes.php"
    },
    @{
        Origen  = Join-Path $JuntaRoot "views\Modalidades\ListarModalidades.php"
        Destino = "views\Modalidades\ListarModalidades.php"
    },
    @{
        Origen  = $PhpIniPath
        Destino = "_xampp_php.ini"
        Externo = $true
    }
)

$manifest = @()
foreach ($item in $archivos) {
    $destPath = Join-Path $BackupDir $item.Destino
    if (Test-Path $item.Origen) {
        $destFolder = Split-Path $destPath -Parent
        if ($destFolder -and -not (Test-Path $destFolder)) {
            New-Item -ItemType Directory -Path $destFolder -Force | Out-Null
        }
        Copy-Item -LiteralPath $item.Origen -Destination $destPath -Force
        $manifest += [PSCustomObject]@{
            archivo   = $item.Destino
            origen    = $item.Origen
            respaldo  = $destPath
            sha256    = (Get-FileSha256 $destPath)
            externo   = [bool]$item.Externo
            fecha     = (Get-Date -Format "yyyy-MM-dd HH:mm:ss")
        }
        Write-Host "  OK  $($item.Destino)" -ForegroundColor Green
    } else {
        Write-Host "  --  $($item.Destino) (origen no encontrado: $($item.Origen))" -ForegroundColor Yellow
        $manifest += [PSCustomObject]@{
            archivo   = $item.Destino
            origen    = $item.Origen
            respaldo  = $null
            sha256    = $null
            externo   = [bool]$item.Externo
            omitido   = $true
            fecha     = (Get-Date -Format "yyyy-MM-dd HH:mm:ss")
        }
    }
}

$meta = [PSCustomObject]@{
    paquete     = "rendimiento-p234"
    descripcion = "Respaldo previo a puntos 2, 3 y 4 (conexiones BD, DataTables Modalidades, OPcache)"
    fecha       = (Get-Date -Format "yyyy-MM-dd HH:mm:ss")
    carpeta     = $BackupDir
    juntaRoot   = $JuntaRoot
    phpIniPath  = $PhpIniPath
    archivos    = $manifest
}

$manifestPath = Join-Path $BackupDir "MANIFEST.json"
$meta | ConvertTo-Json -Depth 6 | Set-Content -Path $manifestPath -Encoding UTF8

$info = @"
Optimizacion rendimiento P2/P3/P4 - Respaldo
============================================
Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
Carpeta: $BackupDir

Archivos incluidos:
  - views/Docentes/VerInscripciones.php   (punto 2)
  - views/Docentes/ListarDocentes.php     (punto 2)
  - views/Modalidades/ListarModalidades.php (punto 3)
  - _xampp_php.ini                        (punto 4, copia de $PhpIniPath)

Restaurar (PowerShell, desde la carpeta junta):
  .\scripts\restore-rendimiento-p234.ps1 -Latest

Restaurar (doble clic Windows):
  .\scripts\Restaurar-Rendimiento-P234.bat

Verificar integridad del respaldo:
  .\scripts\verify-rendimiento-p234-backup.ps1 -Latest

IMPORTANTE: Tras restaurar php.ini, reinicie Apache desde el Panel de Control XAMPP.
"@

Set-Content -Path (Join-Path $BackupDir "LEEME-RESTAURACION.txt") -Value $info -Encoding UTF8

Write-Host ""
Write-Host "Respaldo completado:" -ForegroundColor Green
Write-Host "  $BackupDir"
Write-Host ""
Write-Host "Para restaurar:" -ForegroundColor Cyan
Write-Host "  .\scripts\restore-rendimiento-p234.ps1 -Latest"
Write-Host "  .\scripts\Restaurar-Rendimiento-P234.bat"
