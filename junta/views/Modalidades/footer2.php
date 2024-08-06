
<style>
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
#menu_gral2 {
    font-family: verdana, sans sherif;
    width: 80%;
    margin: 1.5rem auto;
}
#menu_gral2 ul {
    list-style-type: none; 
    text-align: center;
    font-size: 0;
}
#menu_gral2 > ul li {
    display: inline-block;
    width: 25%;
    position: relative;
    background: #337ab7;
}
#menu_gral2 li a {
    display: block;
    text-decoration: none;
    font-size: 2rem;
    width: 18%;
    font-family: 'Roboto', sans-serif;
    background-color: #2698f3;
    font-size: 18px;
    line-height: 2.5rem;
    color: #fff;
}
#menu_gral2 li:hover a, #menu_gral li a:focus {
    background: #e55916;
    color: #fff;
}

#menu_gral2 li ul {
    position: absolute;
    width: 0;
    overflow: hidden;
}
#menu_gral2 li:hover ul, #menu_gral li:focus ul {
    width: 100%;
    margin: 0 -4rem -4rem -4rem;
    padding: 0 4rem 4rem 4rem;
   
    z-index: 5;
}
#menu_gral2 li li {
    display: block;
    width: 100%;
}
#menu_gral2 li:hover li a, #menu_gral li:focus li a {
    font-family: monospace;
    font-size: .9rem;
    line-height: 1.7rem;
    border-top: 1px solid #e5e5e5;
    background: #e55916;
}
#menu_gral2 li li a:hover, #menu_gral li li a:focus {
    background: #8AA9B8; 
}


</style>
</div><!--Cierra row-->
</div>
<body>
  <div class="main">
<div class="panel panel-default">
<div class="panel-heading">
  <ul class="nav nav-pills">
<center><div class="panel-footer"><a href="https://www.aif.gob.ar/" target="_blank">Agencia de Innovacion</a>
<center><img src="../../imagenes/pie_footer.png" width="50" height="50"></center>
</div>
 <nav id="menu_gral2">
 
  <li>
  <div class="card-body d-flex justify-content-between align-items-left">
    <!--
  <a href="../MiCuenta.php?logoutSubmit=1"   class="btn btn-primary">Cerrar Sesion</a>-->

<!-- Button trigger modal -->

<a   href="../../MiCuenta.php?logoutSubmit=1"    type="button" class="btn btn-primary" >Cerra Session</a> 
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">SALIR DEL SISTEMA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Desea Salir del Sistema de Junta?
      </div>
    
      <div class="modal-footer">
        <a class="btn pull-right" href="../../MiCuenta.php?logoutSubmit=1" >salir</a>
          <a  class="btn pull-left" data-dismiss="modal" >Cerrar</a>
      
      </div>
    </div>
  </div>
</div>
</div>
</li>
</nav>
  </div>
</li> 
</nav>
</center>
</div><!--Panel cierra-->
  
</div>


</body>
<center>
 <div class="elementor-element elementor-element-79dab63d elementor-widget elementor-widget-heading" data-id="79dab63d" data-element_type="widget" data-widget_type="heading.default">
                <div class="elementor-widget-container">
            <p class="elementor-heading-title elementor-size-default">© 2024 - Todos los derechos reservados | Las Islas Malvinas son argentinas.</p>       </div>
</div>


</center>
</html>