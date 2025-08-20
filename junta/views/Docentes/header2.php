<!DOCTYPE html>
<html>
<head>
<title>Agencia de innovacion</title>

<!-- Preload de la fuente Roboto -->
<link rel="preload" href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" as="style" onload="this.rel='stylesheet'">
<noscript>
  <link href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet" type="text/css" media="all">
</noscript>

<!-- Preload Bootstrap CSS -->
<link rel="preload" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" as="style" onload="this.rel='stylesheet'">
<noscript>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</noscript>

<!-- jQuery normal (no preload) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- Bootstrap JS normal (no preload) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
/* ... tu CSS personalizado ... */
.btn-success {
  margin: 10px;
}
.main {
  margin: 20px;
}

body{
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

.hide {
    max-height: 0 !important;
}

.dropdown{
  border: 0.1em solid black;
  width: 10em;
  margin-bottom: 1em;
}

.dropdown .title{
  margin: .3em .3em .3em .3em;  
  width: 100%;
}

.dropdown .title .fa-angle-right{
  float: right;
  margin-right: .7em;
  transition: transform .3s;
}

.dropdown .menu{
  transition: max-height .5s ease-out;
  max-height: 20em;
  overflow: hidden;
}

.dropdown .menu .option{
  margin: .3em .3em .3em .3em;
  margin-top: 0.3em;
}

.dropdown .menu .option:hover{
  background: rgba(0,0,0,0.2);
}

.pointerCursor:hover{
  cursor: pointer;
}

.rotate-90{
  transform: rotate(90deg);
}

* {
    margin: 0;
    padding: 0;
    border: o none;
    position: relative;
}
#menu_gral {
    font-family: verdana, sans sherif;
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
    font-size: 2rem;
    font-family: 'Roboto', sans-serif;
    background-color: #2698f3;
    font-size: 18px;
    line-height: 4rem;
    color: #fff;
}
#menu_gral li:hover a, #menu_gral li a:focus {
    background: #e55916;
    color: #fff;
}

#menu_gral li ul {
    position: absolute;
    width: 0;
    overflow: hidden;
}
#menu_gral li:hover ul, #menu_gral li:focus ul {
    width: 100%;
    margin: 0 -4rem -4rem -4rem;
    padding: 0 4rem 4rem 4rem;
   
    z-index: 5;
}
#menu_gral li li {
    display: block;
    width: 130%;
}
#menu_gral li:hover li a, #menu_gral li:focus li a {
    font-family: monospace;
    font-size: .9rem;
    line-height: 1.7rem;
    border-top: 1px solid #e5e5e5;
    background: #e55916;
}
#menu_gral li li a:hover, #menu_gral li li a:focus {
    background: #8AA9B8; 
}
</style>

<!--<link rel="icon" type="image/png" href="./imagenes/escudo-32x32.png">-->
<link rel="shortcut icon" href="../../imagenes/favicon.svg" type="image/x-icon"/>  

</head>

<!--<center><img src="../../imagenes/fondoCabecera.jpg"></center>-->
<center><img src="../../imagenes/aif-logo.png" width="400" height="100"></center>

<body>
   <!-- PRELOAD -->
<div id="preload">Cargando...</div>
<div class="main">
<div class="panel panel-default">

<div class="panel-heading">
  <ul class="nav nav-pills">
   
    <li role="group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

      </div>
  </li>

  <nav id="menu_gral">
  <ul>
    <li>
     <div class="card-body d-flex justify-content-between align-items-center">
      <a href="../panel2.php"  class="btn btn-primary">Inicio</a>
      </div>
    </li>
    <li>
      <div class="card-body d-flex justify-content-between align-items-center">
      <a href="#" class="btn btn-primary">Legajos</a></div>
          <ul>
           <li><a href="../ListadoDeDocentes/ListarListadosDeDocentes.php"><font size="4">Listado de Docentes</font></a></li>
          <li><a href="../Docentes/ListarDocentes.php"><font size="4">Editar Docentes</font></a></li>
          <li><a href="../../controller/exportar_docentes_especiales.php"><font size="3">Listado Docentes Especial(Temp)</font></a></li>
          <li><a href="../../controller/exportar_docentes_especiales_SinTitulares.php"><font size="3">Listado Docentes de Esp. SIN TITULARES(Temporal)</font></a></li>
           <li><a href="../../controller/exportar_docentes_especiales_completos.php"><font size="3">Listado Docentes de Esp.(Interino,supl.y Titulares)</font></a></li>
        </ul>
    </li>
         <li>
          <div class="card-body d-flex justify-content-between align-items-center">
          <a href="#"  class="btn btn-primary">Administracion</a></div>
        <ul>
          <li><a href="../Modalidades/ListarModalidades.php"><font size="4">Modalidades</font></a></li>
          <li><a href="../Dependencias/ListarDependencias.php"><font size="4">Dependencia</font></a></li>
          <li><a href="../ConfiguracionListados/ListarConfiguracionListados.php"><font size="4">Configuracion Listados</font></a></li>
        </ul>
    </li>
     <li>
       <div class="card-body d-flex justify-content-between align-items-center">
    <a href="../Usuarios/ListarUsuarios.php"   class="btn btn-primary" class="logout">Usuarios</a>
</div>

  </li>
  </ul>

</nav>

</ul>

</div>
<div class="panel-body">
<div class="row">

<!-- CONTENIDO AQUÍ -->

</div>
</div>
</div>
</div>

</body>
<script>
    // Ocultar el preload cuando la página termine de cargar
    $(window).on('load', function () {
      $('#preload').fadeOut('slow');
    });
  </script>
</html>
