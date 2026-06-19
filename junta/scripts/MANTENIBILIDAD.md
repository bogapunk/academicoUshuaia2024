# Paquete de mantenibilidad — Documentación de cambios

**Fecha de implementación:** 2026-06-18  
**Respaldo previo:** `backups/mantenibilidad-20260618-151023-pre-implementacion`

---

## Objetivo

Mejorar mantenibilidad y organización **sin modificar** la lógica de negocio ni el comportamiento de la aplicación.

---

## Archivos nuevos

| Archivo | Descripción |
|---------|-------------|
| `.env` | Configuración local con credenciales (ignorado por Git) |
| `.env.example` | Plantilla sin secretos para nuevos entornos |
| `junta_env.php` | Cargador de variables desde `.env` |
| `README.md` | Documentación de instalación y uso |
| `scripts/smoke-test.ps1` | Tests de humo HTTP |
| `scripts/backup-paquete-mantenibilidad.ps1` | Script de respaldo |
| `scripts/restore-paquete-mantenibilidad.ps1` | Script de restauración |
| `scripts/MANTENIBILIDAD.md` | Este documento |

---

## Archivos modificados

| Archivo | Cambio |
|---------|--------|
| `junta_config.php` | Lee `.env`; define constantes BD y sesión con valores por defecto idénticos a los anteriores |
| `Usuarios_Conexion_Sqlserver.php` | Usa constantes de `junta_config.php` (mismos valores, misma conexión) |
| `../.gitignore` | Ignora `junta/.env` y `.env` |

---

## Comportamiento preservado

- Mismos valores de conexión BD por defecto (`10.1.9.113`, `SA`, `Junta`, etc.)
- Misma clase `User` y mismos métodos SQL
- Mismos tiempos de sesión por inactividad (20 min / aviso 60 s)
- Sin cambios en pantallas, formularios, PDFs ni flujos de login
- Otros módulos con credenciales hardcodeadas **no se tocaron** (migración futura)

---

## Restaurar versión anterior

```powershell
cd D:\xampp\htdocs\Juntas2024\junta
.\scripts\restore-paquete-mantenibilidad.ps1 -Latest
```

Para eliminar también archivos nuevos del paquete, borrar manualmente:
- `.env`, `junta_env.php`, `README.md`, `scripts/smoke-test.ps1`

---

## Verificar que todo funciona

```powershell
.\scripts\smoke-test.ps1
```

---

## Próximos pasos sugeridos (futuro, fuera de este paquete)

1. Migrar gradualmente otros archivos con credenciales hardcodeadas a `junta_config.php`
2. Bloquear `.env` por HTTP en `.htaccess`
3. Login obligatorio (cambia comportamiento — requiere aprobación institucional)
