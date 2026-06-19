# Optimizaciones de rendimiento P2/P3/P4 — Respaldo y restauración

**Paquete:** `rendimiento-p234`  
**Alcance:** puntos 2, 3 y 4 del informe de rendimiento (sin paginación server-side de Modalidades).

---

## Archivos respaldados

| Archivo | Punto | Descripción |
|---------|-------|-------------|
| `views/Docentes/VerInscripciones.php` | 2 | Conexiones BD redundantes |
| `views/Docentes/ListarDocentes.php` | 2 | Conexión PDO inline no usada |
| `views/Modalidades/ListarModalidades.php` | 3 | DataTables / jQuery duplicado |
| `_xampp_php.ini` (copia de `D:\xampp\php\php.ini`) | 4 | Configuración OPcache |

---

## 1. Crear respaldo (obligatorio antes de modificar)

Desde PowerShell, en la carpeta `junta`:

```powershell
cd D:\xampp\htdocs\Juntas2024\junta
.\scripts\backup-rendimiento-p234.ps1 -Etiqueta "pre-implementacion"
```

Si `php.ini` está en otra ruta:

```powershell
.\scripts\backup-rendimiento-p234.ps1 -Etiqueta "pre-implementacion" -PhpIniPath "D:\xampp\php\php.ini"
```

El respaldo se guarda en:

`backups/rendimiento-p234-YYYYMMDD-HHmmss-pre-implementacion/`

Contiene: archivos copiados, `MANIFEST.json` (checksums SHA256) y `LEEME-RESTAURACION.txt`.

---

## 2. Verificar integridad del respaldo

```powershell
.\scripts\verify-rendimiento-p234-backup.ps1 -Latest
```

Para comparar con los archivos actuales en disco:

```powershell
.\scripts\verify-rendimiento-p234-backup.ps1 -Latest -CompareLive
```

---

## 3. Restaurar (revertir cambios)

### Opción A — PowerShell (recomendada)

```powershell
cd D:\xampp\htdocs\Juntas2024\junta
.\scripts\restore-rendimiento-p234.ps1 -Latest
```

Listar respaldos disponibles:

```powershell
.\scripts\restore-rendimiento-p234.ps1 -List
```

Restaurar un respaldo concreto:

```powershell
.\scripts\restore-rendimiento-p234.ps1 -BackupDir "D:\xampp\htdocs\Juntas2024\junta\backups\rendimiento-p234-20260618-160000-pre-implementacion"
```

Sin confirmación interactiva (automatización):

```powershell
.\scripts\restore-rendimiento-p234.ps1 -Latest -Force
```

### Opción B — Doble clic (Windows)

Ejecutar:

`scripts\Restaurar-Rendimiento-P234.bat`

Solicita confirmación y restaura el respaldo más reciente.

---

## 4. Pasos post-restauración (obligatorios)

1. **Reiniciar Apache** en el Panel de Control XAMPP (Stop → Start).
2. Verificar que la aplicación responde:
   - `http://localhost:8080/juntas2024/junta/views/panel1.php`
   - `http://localhost:8080/juntas2024/junta/views/Docentes/ListarDocentes.php`
   - `http://localhost:8080/juntas2024/junta/views/Modalidades/ListarModalidades.php`
3. (Opcional) Ejecutar tests de humo si están disponibles:
   ```powershell
   .\scripts\smoke-test.ps1
   ```

---

## 5. Cuándo usar la restauración

- Errores PHP tras modificar conexiones BD.
- Pantalla en blanco o fallos en Modalidades / Docentes / Inscripciones.
- Comportamiento inesperado tras habilitar OPcache.
- Cualquier regresión detectada en pruebas manuales.

---

## 6. Notas de seguridad

- Los scripts **solo** restauran los 4 archivos del paquete; no eliminan otros cambios del proyecto.
- `php.ini` está **fuera** del repositorio Git; el respaldo incluye una copia en `_xampp_php.ini`.
- La restauración de `php.ini` puede requerir permisos de administrador si Windows lo bloquea.
- No exponga los scripts de restauración vía web; úselos solo en el servidor local.

---

## 7. Orden de trabajo recomendado

1. Ejecutar `backup-rendimiento-p234.ps1 -Etiqueta "pre-implementacion"`.
2. Ejecutar `verify-rendimiento-p234-backup.ps1 -Latest` → debe terminar en OK.
3. Aplicar cambios P2, P3 y P4.
4. Probar la aplicación.
5. Si hay problemas → `Restaurar-Rendimiento-P234.bat` o `restore-rendimiento-p234.ps1 -Latest`.
6. Reiniciar Apache y verificar de nuevo.

---

## Respaldo actual

Tras ejecutar el backup inicial, la ruta exacta quedará registrada en:

`backups/rendimiento-p234-*-pre-implementacion/LEEME-RESTAURACION.txt`

---

## Implementación aplicada (2026-06-18)

| Punto | Archivo | Cambio |
|-------|---------|--------|
| 2 | `VerInscripciones.php` | Una sola conexión `sqlsrv_connect` |
| 2 | `ListarDocentes.php` | Eliminada conexión PDO no usada |
| 3 | `ListarModalidades.php` | DataTables CDN, tabla HTML corregida, paginación cliente |
| 4 | `D:\xampp\php\php.ini` | OPcache habilitado |

**Post-instalación punto 4:** reiniciar Apache desde el Panel XAMPP (Stop → Start) para activar OPcache.
