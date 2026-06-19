<?php
/**
 * Encabezado mínimo para pantalla de inicio de sesión (sin menú ni panel Bootstrap).
 * REVERTIR diseño moderno: en index.php usar include('header.php') en lugar de este archivo.
 */
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Iniciar sesión — Sistema de Juntas</title>
<link rel="stylesheet" href="style.css" type="text/css" media="all">
<link rel="stylesheet" href="aesthetic-polish.css" type="text/css" media="all">
<link rel="stylesheet" href="views/css/login-polish.css" type="text/css" media="all">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,600,700&amp;display=swap" type="text/css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="shortcut icon" href="imagenes/favicon.svg" type="image/x-icon">
</head>
<body class="junta-login-page">
<?php
$JUNTA_CABECERA_IMG = '';
include __DIR__ . '/cabecera_institucional.php';
?>
<main class="junta-login-main" id="contenido-principal">
