@echo off
chcp 65001 >nul
title Restaurar optimizaciones rendimiento P2/P3/P4 — Sistema de Juntas

echo.
echo ============================================================
echo   RESTAURACION — Respaldo rendimiento P2/P3/P4
echo   (conexiones BD, DataTables Modalidades, OPcache)
echo ============================================================
echo.
echo Este proceso revierte los archivos al estado guardado
echo ANTES de aplicar las optimizaciones de rendimiento.
echo.
echo IMPORTANTE: Tras restaurar, reinicie Apache en XAMPP.
echo.

cd /d "%~dp0.."

powershell -NoProfile -ExecutionPolicy Bypass -File ".\scripts\restore-rendimiento-p234.ps1" -Latest

echo.
pause
