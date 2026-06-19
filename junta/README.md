# Sistema de Juntas

Plataforma institucional de gestión y consulta para Juntas de Clasificación Docente.

---

## Requisitos

- **PHP** 8.x (XAMPP) con extensiones `sqlsrv` y `pdo_sqlsrv`
- **Apache** con `mod_rewrite` (opcional)
- **Microsoft SQL Server** accesible en red
- **Windows:** XAMPP recomendado para desarrollo local

---

## Instalación local (XAMPP)

1. Clonar o copiar el proyecto en:
   ```
   C:\xampp\htdocs\Juntas2024\junta
   ```

2. Copiar configuración de entorno:
   ```powershell
   cd D:\xampp\htdocs\Juntas2024\junta
   copy .env.example .env
   ```
   Editar `.env` con host, usuario y contraseña de su SQL Server.

3. Verificar extensiones PHP en `C:\xampp\php\php.ini`:
   - `extension=sqlsrv`
   - `extension=pdo_sqlsrv`

4. Iniciar **Apache** desde el panel de XAMPP.

5. Acceder a:
   ```
   http://localhost:8080/Juntas2024/junta/index.php
   ```
   > Si Apache usa otro puerto, ajustar `JUNTA_APP_BASE_URL` en `.env`.

---

## Configuración centralizada

| Archivo | Propósito |
|---------|-----------|
| `.env` | Credenciales y parámetros locales (**no subir a Git**) |
| `.env.example` | Plantilla sin secretos (sí subir a Git) |
| `junta_config.php` | Constantes del sistema (lee `.env` con valores por defecto) |
| `junta_env.php` | Cargador de variables de entorno |

### Variables principales (.env)

```env
JUNTA_DB_HOST=10.1.9.113
JUNTA_DB_USER=SA
JUNTA_DB_PASS=su_contraseña
JUNTA_DB_NAME=Junta
JUNTA_APP_BASE_URL=http://localhost:8080/Juntas2024/junta/
```

### Sesión por inactividad (opcional en .env)

```env
JUNTA_SESSION_TIMEOUT_SEC=1200   # 20 minutos
JUNTA_SESSION_WARNING_SEC=60     # aviso 1 min antes
JUNTA_SESSION_DEBUG=false
```

---

## Docker (repositorio padre)

Desde `Juntas2024/`:

```bash
docker compose up -d
```

App en `http://localhost:8009/` (requiere SQL Server externo configurado en `.env`).

---

## Tests de humo

Verificar que la aplicación responde sin errores fatales:

```powershell
cd D:\xampp\htdocs\Juntas2024\junta
.\scripts\smoke-test.ps1
```

Con URL personalizada:

```powershell
.\scripts\smoke-test.ps1 -BaseUrl "http://localhost:8080/Juntas2024/junta"
```

---

## Respaldo y restauración (paquete mantenibilidad)

### Crear respaldo antes de cambios

```powershell
.\scripts\backup-paquete-mantenibilidad.ps1
```

### Restaurar versión anterior

```powershell
# Ver respaldos disponibles
.\scripts\restore-paquete-mantenibilidad.ps1 -List

# Restaurar el más reciente
.\scripts\restore-paquete-mantenibilidad.ps1 -Latest

# Restaurar uno específico
.\scripts\restore-paquete-mantenibilidad.ps1 -BackupDir "D:\...\backups\mantenibilidad-YYYYMMDD-HHmmss"
```

Los respaldos se guardan en `junta/backups/mantenibilidad-*`.

---

## Estructura relevante

```
junta/
├── index.php              # Login
├── MiCuenta.php           # Autenticación / logout
├── junta_config.php       # Configuración centralizada
├── junta_env.php          # Cargador .env
├── .env                   # Config local (ignorado por Git)
├── views/                 # Módulos (Docentes, Listados, etc.)
├── scripts/
│   ├── smoke-test.ps1
│   ├── backup-paquete-mantenibilidad.ps1
│   └── restore-paquete-mantenibilidad.ps1
└── backups/               # Respaldos locales
```

---

## Notas

- Otros módulos pueden tener credenciales de BD en archivos propios (legacy). La clase `User` (login) ya usa `junta_config.php` / `.env`.
- El puerto **80** en esta máquina puede estar ocupado por IIS; usar **8080** (XAMPP).
- Para revertir solo cambios de interfaz UI: `scripts/restore-junta-ui.ps1`.
