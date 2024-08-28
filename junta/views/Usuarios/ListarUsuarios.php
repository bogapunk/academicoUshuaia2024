<?php 


include('header2.php');

?>


<!-- Begin Page Content -->

<style type="text/css">
.nav>li>a {
    position: relative;
    display: block;
    padding: 7px 15px;
}

thead{

    display: table-header-group;
    vertical-align: middle;
    border-color: inherit;
}
table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
* {
    margin: 0;
    padding: 0;
    border: none;
    position: relative;
}
#menu_gral {
    font-family: verdana, sans sherif;
    width: 80%;
    margin: 1.5rem auto;
}
#menu_gral ul {
    list-style-type: none; 
    text-align: left;
    font-size: 0;
}
#menu_gral > ul li {
    display: inline-block;
    width: 25%;
    position: relative;
    background: #ffffff;
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
    width: 110%;
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
.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:#ccc;
}



</style>
<link rel="icon" type="./image/png" href="./imagenes/escudo-32x32.png">
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Agencia de innovacion</title>


  <meta charset="utf-8">
<!--  esto son los archivos de exportacion -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <!-- Latest compiled and minified CSS -->
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>


  <script type="text/javascript">
  
if (<?php echo isset($_REQUEST['message']) ? 'true' : 'false'; ?>) {
  // Get the message from the session
  var message = "<?php echo $_REQUEST['message']; ?>";

  // Create a Bootstrap alert element based on the message type (success or error)
  var alertType = (message.includes("eliminado") || message.includes("éxito")) ? "success" : "danger";
  var alertHtml = '<div class="alert alert-' + alertType + '">' + message + '</div>';

  // Insert the alert HTML into the page (e.g., before or after a specific element)
  $("#message-container").prepend(alertHtml);

  // Clear the message from the session
  <?php unset($_REQUEST['message']); ?>
}
  
</script>
  <div class="page-content bg-light">
  <div class="container" > <center><h1><u><font face="
    font-family: 'Roboto', sans-serif;" COLOR="black">Usuarios</font></u></h1></center>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 

<?php
// Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
//$link = new PDO('mysql:host=localhost;dbname=junta', 'root', ''); //conexion mysql

// Conexión a SQL Server
$serverName = "10.1.9.113"; // o la dirección IP del servidor
$database = "junta";
$username = "SA"; // Reemplaza con tu usuario
$password = 'Davinci2024#'; // Reemplaza con tu contraseña

try {
    $link = new PDO("sqlsrv:server=$serverName;Database=$database;TrustServerCertificate=true", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}



?>

<div class="container-fluid">
<div class="input-group">
  <b>Buscar:&nbsp</b> <div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="¿Que Desea Buscar?">
</div>
</div>
<a href="../Registro.php" class="btn btn-primary" > <span class="glyphicon glyphicon-plus"></span> Nuevo Registro</a>&nbsp&nbsp
 <a href="../../controller/exportar_usuarios.php" class="btn btn-info btn-sm" >
          <span class="glyphicon glyphicon-download-alt"></span>  Descargar
        </a>
</div>
<?php 

  if(isset($_SESSION['message'])){
    ?>
    <div class="alert alert-info text-center" style="margin-top:20px;">
      <?php echo $_SESSION['message']; ?>
    </div>
    <?php

    unset($_SESSION['message']);
  }
?>
<div class="container-fluid">
<table class="table table-hover table-bordered results" id="dtBasicExample">

    <thead class="thead-dark" >
        <thead class="buscar">
        <tr>
            <th><center style="font-size:2.0em"; onclick="sortTable(0)">ID</center></th>
            <th><center style="font-size:2.0em";onclick="sortTable(1)">NOMBRES</center></th>
            <th><center style="font-size:2.0em";onclick="sortTable(3)">APELLIDOS</center></th>
            <th><center style="font-size:2.0em";>EMAIL</center></th>
            <th><center style="font-size:2.0em";>TELEFONO</center></th>
            <th><center style="font-size:2.0em";>ROL</center></th>
            <th><center style="font-size:2.3em";>ACCIONES</center></th>
            
        </tr>

    </thead>
  </thead>

<tbody>
<?php foreach ($link->query('SELECT * FROM usuarios WHERE estado = 1') as $row){ // aca puedes hacer la consulta e iterarla con each. ?> 
<tr>
    <td><center><?php echo $row['id'] // aca te faltaba poner los echo para que se muestre el valor de la variable.  ?></center></td>
    <td><center style="font-size:1.3em"><?php echo $row['nombres'] ?></center></td>
    <td><center style="font-size:1.3em"><?php echo $row['apellidos'] ?></center></td>
    <td><center style="font-size:1.3em"><?php echo $row['email'] ?></center></td>
    <td><center style="font-size:1.3em"><?php echo $row['telefono'] ?></center></td>
    <td><center style="font-size:1.3em"><?php echo $row['rol'] ?></center></td>
    <td>
        <center>
        <a href="#edit_<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Editar</a>
        <a href="#delete_<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
         </center>                                                            
    </td>

    <?php include('BorrarEditarModal.php'); ?>




 </tr>
<?php
    }
?>

</tbody>
</div>
</div>
</table>

<script>
  
$(document).ready(function() {
$('#developers').pageMe({
pagerSelector: '#developer_page',
showPrevNext: true,
hidePageNumbers: false,
perPage: 3
});
});
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
      });
});
$(document).ready(function () {
  $('#dtBasicExample').DataTable({
    "pagingType": "simple" // "simple" option for 'Previous' and 'Next' buttons only
  });
  $('.dataTables_length').addClass('bs-select');
});


</script>






</body>
<?php include('footer2.php');?>
</html>
<?php include('AgregarModal.php'); ?>
<script src="../js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>


<!--modale ver usuario -->
