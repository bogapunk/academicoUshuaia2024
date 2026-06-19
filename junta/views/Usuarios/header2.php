<?php
require_once __DIR__ . '/../seguridad_rol.php';
require_once __DIR__ . '/../seguridad_requiere_login.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agencia de Innovación</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../../style.css" type="text/css" />
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <link rel="shortcut icon" href="../../imagenes/favicon.svg" type="image/x-icon" />  

  <!-- JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

  <style>
    /* Estilos generales */
    body {
      font-family: 'Lucida Sans', Geneva, Verdana, sans-serif;
    }

    .btn-success {
      margin: 10px;
    }

    .main {
      margin: 20px;
    }

    .hide {
      max-height: 0 !important;
    }

    .dropdown {
      border: 0.1em solid black;
      width: 10em;
      margin-bottom: 1em;
    }

    .dropdown .title {
      margin: 0.3em;
      width: 100%;
    }

    .dropdown .title .fa-angle-right {
      float: right;
      margin-right: 0.7em;
      transition: transform 0.3s;
    }

    .dropdown .menu {
      transition: max-height 0.5s ease-out;
      max-height: 20em;
      overflow: hidden;
    }

    .dropdown .menu .option {
      margin: 0.3em;
    }

    .dropdown .menu .option:hover {
      background: rgba(0, 0, 0, 0.2);
    }

    .pointerCursor:hover {
      cursor: pointer;
    }

    .rotate-90 {
      transform: rotate(90deg);
    }

    * {
      margin: 0;
      padding: 0;
      border: none;
      position: relative;
    }

    #menu_gral {
      font-family: verdana, sans-serif;
      width: 80%;
      margin: 1.5rem auto;
    }

    #menu_gral ul {
      list-style-type: none;
      text-align: center;
      font-size: 0;
    }

    #menu_gral > ul li {
      display: inline-block;
      width: 25%;
      position: relative;
      background: #337ab7;
    }

    #menu_gral li a {
      display: block;
      text-decoration: none;
      font-size: 18px;
      line-height: 2.5rem;
      color: #fff;
      background-color: #2698f3;
    }

    #menu_gral li:hover a,
    #menu_gral li a:focus {
      background: #e55916;
      color: #fff;
    }

    #menu_gral li ul {
      position: absolute;
      width: 0;
      overflow: hidden;
    }

    #menu_gral li:hover ul,
    #menu_gral li:focus ul {
      width: 100%;
      margin: 0 -4rem;
      padding: 0 4rem 4rem 4rem;
      z-index: 5;
    }

    #menu_gral li li {
      display: block;
      width: 130%;
    }

    #menu_gral li:hover li a,
    #menu_gral li:focus li a {
      font-family: monospace;
      font-size: 0.9rem;
      line-height: 1.7rem;
      border-top: 1px solid #e5e5e5;
      background: #e55916;
    }

    #menu_gral li li a:hover,
    #menu_gral li li a:focus {
      background: #8AA9B8;
    }

  </style>
  <link rel="stylesheet" href="../../aesthetic-polish.css" type="text/css" media="all" />
</head>

<body>
<?php include __DIR__ . '/../../spinner-global-include.php'; ?>
<?php include __DIR__ . '/../../swal-global-include.php'; ?>

  <div id="contenido">

    <?php
    $JUNTA_CABECERA_IMG = '../../';
    include __DIR__ . '/../../cabecera_institucional.php';
    ?>

    <!-- Menú -->
    <div class="main">
      <div class="panel panel-default">
        <div class="panel-heading">
          <ul class="nav nav-pills">
            <li role="group">
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              </div>
            </li>
          </ul>
        </div>

        <nav id="menu_gral">
          <ul>
            <li><a href="../panel2.php" class="btn btn-primary">Inicio</a></li>
            <li>
              <a href="#" class="btn btn-primary">Legajos</a>
              <ul>
                <li><a href="../ListadoDeDocentes/ListarListadosDeDocentes.php">Listado de Docentes</a></li>
                <li><a href="../Docentes/ListarDocentes.php">Docentes</a></li>
                <li><a href="../../controller/exportar_docentes_especiales.php">Listado Docentes Especial (Temporal)</a></li>
                <li><a href="../../controller/exportar_docentes_especiales_SinTitulares.php">Listado Especial SIN Titulares</a></li>
                <li><a href="../../controller/exportar_docentes_especiales_completos.php">Listado Esp. Interinos, Supl. y Titulares</a></li>
              </ul>
            </li>
            <li>
              <a href="#" class="btn btn-primary">Administración</a>
              <ul>
                <li><a href="../Modalidades/ListarModalidades.php">Modalidades</a></li>
                <li><a href="../Dependencias/listarDependencias.php">Dependencias</a></li>
                <li><a href="../configuracionListados/listarConfiguracionListados.php">Configuración Listados</a></li>
              </ul>
            </li>
            <?php
            $juntaNavRel = '../';
            $juntaNavUsuariosHref = 'ListarUsuarios.php';
            require __DIR__ . '/../inc/menu_usuario_nav.php';
            ?>
          </ul>
        </nav>
      </div>
    </div>

  <!-- El cierre de #contenido y el pie están en footer2.php (contenido de la página entre el menú y el pie) -->


  <!-- Script para inactividad -->
  <script>
    var base_url = '../../MiCuenta.php?logoutSubmit=1';
    var tiempoInactividad = 900000;
    var timeoutInactividad;

    function iniciarContadorInactividad() {
      clearTimeout(timeoutInactividad);
      timeoutInactividad = setTimeout(function () {
        mostrarAlertaInactividad();
      }, tiempoInactividad);
    }

    function mostrarAlertaInactividad() {
      $.confirm({
        title: 'Alerta de Inactividad!',
        content: 'La sesión está a punto de expirar.',
        autoClose: 'expirar|10000',
        type: 'red',
        icon: 'fa fa-spinner fa-spin',
        buttons: {
          expirar: {
            text: 'Cerrar Sesión',
            btnClass: 'btn-red',
            action: function () {
              salir();
            }
          },
          permanecer: {
            text: 'Seguir Activo',
            btnClass: 'btn-blue',
            action: function () {
              iniciarContadorInactividad();
              $.alert('La sesión ha sido reiniciada.');
            }
          }
        }
      });
    }

    function salir() {
      window.location.href = base_url;
    }

    document.addEventListener('mousemove', iniciarContadorInactividad);
    document.addEventListener('keypress', iniciarContadorInactividad);
    document.addEventListener('click', iniciarContadorInactividad);

    iniciarContadorInactividad();
  </script>