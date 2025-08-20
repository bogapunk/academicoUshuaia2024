<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agencia de Innovación</title>

  <!-- Google Fonts -->
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" type="text/css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../../imagenes/favicon.svg" type="image/x-icon"/>  

  <style>
    /* Preload styles */
    #preload {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      font-size: 2em;
      color: #337ab7;
    }

    /* General styles */
    body {
      font-family: 'Lucida Sans', Geneva, Verdana, sans-serif;
    }

    .main {
      margin: 20px;
    }

    .btn-success {
      margin: 10px;
    }

    /* Dropdown styles */
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

    /* Menu styles */
    #menu_gral {
      font-family: Verdana, sans-serif;
      width: 80%;
      margin: 1.5rem auto;
    }

    #menu_gral ul {
      list-style-type: none;
      text-align: center;
      font-size: 0;
      padding: 0;
    }

    #menu_gral > ul > li {
      display: inline-block;
      width: 25%;
      background: #337ab7;
    }

    #menu_gral li a {
      display: block;
      text-decoration: none;
      font-size: 18px;
      font-family: 'Roboto', sans-serif;
      background-color: #2698f3;
      line-height: 4rem;
      color: #fff;
    }

    #menu_gral li:hover a, #menu_gral li a:focus {
      background: #e55916;
    }

    #menu_gral li ul {
      position: absolute;
      width: 0;
      overflow: hidden;
    }

    #menu_gral li:hover ul {
      width: 100%;
      margin: 0 -4rem -4rem -4rem;
      padding: 0 4rem 4rem 4rem;
      z-index: 5;
    }

    #menu_gral li li {
      display: block;
      width: 130%;
    }

    #menu_gral li:hover li a {
      font-family: monospace;
      font-size: 0.9rem;
      line-height: 1.7rem;
      border-top: 1px solid #e5e5e5;
      background: #e55916;
    }

    #menu_gral li li a:hover {
      background: #8AA9B8;
    }
  </style>
</head>

<body>

  <!-- PRELOAD -->
  <div id="preload">Cargando...</div>

  <!-- Logo -->
  <center><img src="../../imagenes/aif-logo.png" width="400" height="100" alt="Agencia de Innovación"></center>

  <div class="main">
    <div class="panel panel-default">
      <div class="panel-heading">
        <ul class="nav nav-pills">
          <li role="group">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown"></div>
          </li>
          <nav id="menu_gral">
            <ul>
              <li>
                <div class="card-body d-flex justify-content-between align-items-center">
                  <a href="../panel2.php" class="btn btn-primary">Inicio</a>
                </div>
              </li>
              <li>
                <div class="card-body d-flex justify-content-between align-items-center">
                  <a href="#" class="btn btn-primary">Legajos</a>
                </div>
                <ul>
                  <li><a href="#"><font size="4">Listado de Docentes</font></a></li>
                  <li><a href="../Docentes/ListarDocentes.php"><font size="4">Editar Docentes</font></a></li>
                  <li><a href="../../controller/exportar_docentes_especiales.php"><font size="3">Listado Docentes Especial (Temp)</font></a></li>
                  <li><a href="../../controller/exportar_docentes_especiales_SinTitulares.php"><font size="3">Docentes Esp. SIN TITULARES</font></a></li>
                  <li><a href="../../controller/exportar_docentes_especiales_completos.php"><font size="3">Docentes Esp. Interino, Supl. y Titulares</font></a></li>
                </ul>
              </li>
              <li>
                <div class="card-body d-flex justify-content-between align-items-center">
                  <a href="#" class="btn btn-primary">Administración</a>
                </div>
                <ul>
                  <li><a href="../Modalidades/ListarModalidades.php"><font size="4">Modalidades</font></a></li>
                  <li><a href="../Dependencias/ListarDependencias.php"><font size="4">Dependencia</font></a></li>
                  <li><a href="../ConfiguracionListados/ListarConfiguracionListados.php"><font size="4">Configuración Listados</font></a></li>
                </ul>
              </li>
              <li>
                <div class="card-body d-flex justify-content-between align-items-center">
                  <a href="../Usuarios/ListarUsuarios.php" class="btn btn-primary">Usuarios</a>
                </div>
              </li>
            </ul>
          </nav>
        </ul>
      </div>
      <div class="panel-body">
        <div class="row">
          <!-- Aquí va el contenido -->
        </div>
      </div>
    </div>
  </div>

  <script>
    // Ocultar el preload cuando la página termine de cargar
    $(window).on('load', function () {
      $('#preload').fadeOut('slow');
    });
  </script>

</body>
</html>
