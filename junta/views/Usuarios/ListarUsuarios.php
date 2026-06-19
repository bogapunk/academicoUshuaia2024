<?php
require_once __DIR__ . '/../seguridad_requiere_admin.php';

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
.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:#666;
}

.usuarios-page .container {
  max-width: 1200px;
  margin-left: auto !important;
  margin-right: auto !important;
}

.usuarios-page .container-fluid {
  max-width: 1120px;
  margin-left: auto !important;
  margin-right: auto !important;
  padding-left: 12px;
  padding-right: 12px;
}

.usuarios-page .input-group {
  margin-left: auto;
  margin-right: auto;
}

.usuarios-page p {
  text-align: center;
}

.usuarios-page #dtBasicExample th,
.usuarios-page #dtBasicExample td {
  vertical-align: middle !important;
}

.usuarios-page #dtBasicExample th {
  text-align: center !important;
}

.usuarios-page tr.usuario-inactivo td {
  opacity: 0.72;
  background-color: #f9fafb !important;
}

.btn-flotante {
  font-size: 11px;
  text-transform: uppercase;
  font-weight: bold;
  color: #FFFFFF;
  border-radius: 6px;
  letter-spacing: 1px;
  background-color: #2698f3;
  padding: 10px 16px;
  position: fixed;
  bottom: 24px;
  right: 20px;
  transition: all 250ms ease 0ms;
  box-shadow: 0px 6px 14px rgba(0, 0, 0, 0.16);
  z-index: 1200;
  border: none;
  display: none;
}

.btn-flotante:hover,
.btn-flotante:focus {
  background-color: #e55916;
  color: #fff;
}

.modal-content {
  border-radius: 8px;
}

.modal-dialog {
  margin-top: 8vh;
}

<?php readfile(__DIR__ . '/../css/junta-panel-polish.css'); ?>
<?php readfile(__DIR__ . '/../css/usuarios-list-polish.css'); ?>

</style>

<script type="text/javascript">
  <?php if (isset($_REQUEST['message']) && !empty($_REQUEST['message'])): ?>
    document.addEventListener("DOMContentLoaded", function() {
      var message = "<?php echo addslashes($_REQUEST['message']); ?>";
      var isSuccess = (message.includes("activado") || message.includes("desactivado") || message.includes("actualizado") || message.includes("eliminado") || message.includes("éxito"));
      if (isSuccess) {
        juntaSuccess('Operación exitosa', message);
      } else {
        juntaError('Atención', message);
      }
    });
    <?php unset($_REQUEST['message']); ?>
  <?php endif; ?>
</script>
  <button class="btn-flotante" type="button" onclick="topFunction()">Subir</button>
  <div id="message-container" class="page-content bg-light cfg-listados-polish usuarios-page">
  <div class="container">
    <h1 class="cfg-page-title">Usuarios</h1>

<?php
// Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
//$link = new PDO('mysql:host=localhost;dbname=junta', 'root', ''); //conexion mysql

require_once __DIR__ . '/../../junta_config.php';
require_once __DIR__ . '/../seguridad_password.php';

$filtroEstado = isset($_GET['filtro']) ? preg_replace('/[^a-z]/', '', (string) $_GET['filtro']) : 'activos';
if (!in_array($filtroEstado, array('activos', 'inactivos', 'todos'), true)) {
    $filtroEstado = 'activos';
}

try {
    $link = new PDO(
        "sqlsrv:server=" . JUNTA_DB_HOST . ";Database=" . JUNTA_DB_NAME . ";TrustServerCertificate=true;ConnectionPooling=1;LoginTimeout=5",
        JUNTA_DB_USER,
        JUNTA_DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    error_log("Error en la conexión: " . $e->getMessage());
    die("Error en la conexión a la base de datos.");
}

?>

<div class="container-fluid cfg-card">
<div class="cfg-toolbar usuarios-toolbar">
  <div class="cfg-search-wrap">
    <b>Buscar:</b>
    <input type="text" class="search form-control" placeholder="¿Qué desea buscar?" aria-label="Filtrar usuarios">
  </div>
  <div class="usuarios-toolbar-actions">
    <a href="../Registro.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo Registro</a>
    <a href="../../controller/exportar_usuarios.php" class="btn btn-info btn-sm">
      <span class="glyphicon glyphicon-download-alt"></span> Descargar
    </a>
  </div>
</div>
<div class="container-fluid cfg-card" style="margin-top:12px;">
  <div class="btn-group" role="group" aria-label="Filtrar por estado">
    <a href="ListarUsuarios.php?filtro=activos" class="btn btn-sm <?php echo $filtroEstado === 'activos' ? 'btn-primary' : 'btn-default'; ?>">Activos</a>
    <a href="ListarUsuarios.php?filtro=inactivos" class="btn btn-sm <?php echo $filtroEstado === 'inactivos' ? 'btn-primary' : 'btn-default'; ?>">Inactivos</a>
    <a href="ListarUsuarios.php?filtro=todos" class="btn btn-sm <?php echo $filtroEstado === 'todos' ? 'btn-primary' : 'btn-default'; ?>">Todos</a>
  </div>
</div>
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

  if(isset($_SESSION['usuario_creado'])){
    $uc = $_SESSION['usuario_creado'];
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: '¡Usuario creado exitosamente!',
        html: '<div style="text-align:left;font-size:15px;line-height:1.8;">' +
              '<p><strong>ID de Usuario:</strong> <span style="font-size:18px;color:#2698f3;font-weight:700;"><?php echo htmlspecialchars($uc['id']); ?></span></p>' +
              '<p><strong>Nombre:</strong> <?php echo htmlspecialchars($uc['nombres'] . ' ' . $uc['apellidos']); ?></p>' +
              '<p><strong>Email:</strong> <?php echo htmlspecialchars($uc['email']); ?></p>' +
              '<p><strong>Rol:</strong> <?php echo htmlspecialchars($uc['rol']); ?></p>' +
              '</div>' +
              '<p style="margin-top:12px;font-size:13px;color:#6b7280;">Puede copiar esta información antes de continuar.</p>',
        icon: 'success',
        confirmButtonText: 'Continuar',
        confirmButtonColor: '#2698f3',
        allowOutsideClick: false,
        allowEscapeKey: false
      });
    });
    </script>
    <?php
    unset($_SESSION['usuario_creado']);
  }
?>
<div class="container-fluid cfg-card cfg-table-wrap" style="overflow-x:auto;">
<table class="table table-hover table-bordered results" id="dtBasicExample">

<thead>
        <tr>
            <th onclick="sortTable(0)">ID</th>
            <th onclick="sortTable(1)">NOMBRES</th>
            <th onclick="sortTable(2)">APELLIDOS</th>
            <th>EMAIL</th>
            <th>TELÉFONO</th>
            <th>ROL</th>
            <th>ESTADO</th>
            <th>ACCIONES</th>
        </tr>
</thead>

<tbody>
<?php
$sqlUsuarios = 'SELECT id, nombres, apellidos, email, telefono, rol, estado FROM usuarios';
if ($filtroEstado === 'inactivos') {
    $sqlUsuarios .= " WHERE (estado = 0 OR estado = '0')";
} elseif ($filtroEstado === 'activos') {
    $sqlUsuarios .= " WHERE (estado = 1 OR estado = '1')";
}
$sqlUsuarios .= ' ORDER BY id DESC';
$stmtUsuarios = $link->query($sqlUsuarios);
while ($row = $stmtUsuarios->fetch(PDO::FETCH_ASSOC)) {
    $estadoActivo = ($row['estado'] == 1 || $row['estado'] === '1');
?>
<tr class="<?php echo $estadoActivo ? '' : 'usuario-inactivo'; ?>">
    <td><center><?php echo (int) $row['id']; ?></center></td>
    <td><center><?php echo htmlspecialchars($row['nombres'], ENT_QUOTES, 'UTF-8'); ?></center></td>
    <td><center><?php echo htmlspecialchars($row['apellidos'], ENT_QUOTES, 'UTF-8'); ?></center></td>
    <td><center><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></center></td>
    <td><center><?php echo htmlspecialchars($row['telefono'], ENT_QUOTES, 'UTF-8'); ?></center></td>
    <td><center><?php echo htmlspecialchars($row['rol'], ENT_QUOTES, 'UTF-8'); ?></center></td>
    <td><center>
      <?php if ($estadoActivo) : ?>
        <span class="label label-success">Activo</span>
      <?php else : ?>
        <span class="label label-default">Inactivo</span>
      <?php endif; ?>
    </center></td>
    <td class="text-center">
      <div class="junta-acciones usuarios-acciones">
        <a href="#edit_<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Editar</a>
        <?php if ($estadoActivo) : ?>
        <a href="#delete_<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" data-toggle="modal" title="Desactivar"><span class="glyphicon glyphicon-ban-circle"></span> Desactivar</a>
        <?php else : ?>
        <a href="#activate_<?php echo $row['id']; ?>" class="btn btn-info btn-sm" data-toggle="modal" title="Activar"><span class="glyphicon glyphicon-ok-circle"></span> Activar</a>
        <?php endif; ?>
      </div>
    </td>

    <?php include('BorrarEditarModal.php'); ?>

 </tr>
<?php
}
?>
<tr class="no-result" style="display:none;">
  <td colspan="8" class="text-center text-muted">Ningún resultado coincide con la búsqueda.</td>
</tr>
</tbody>
</table>
</div>
<!-- fin container-fluid tabla -->
  </div><!-- /container page -->
  </div><!-- /message-container id -->

<script src="../inc/junta-password-policy.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (!window.JuntaPasswordPolicy) {
        return;
    }

    document.querySelectorAll('.form-editar-usuario').forEach(function (form) {
        var passwordInput = form.querySelector('.password-edit-input');
        var checklist = form.querySelector('.password-edit-checklist');
        var errorBox = form.querySelector('.password-edit-error');
        var validarPolitica = JuntaPasswordPolicy.bindPolicy(passwordInput, checklist, true);

        form.addEventListener('submit', function (event) {
            errorBox.innerHTML = '';
            if (!passwordInput.value) {
                return;
            }
            var resultado = validarPolitica();
            if (!resultado.ok) {
                event.preventDefault();
                errorBox.innerHTML = resultado.errores.map(function (e) { return '• ' + e; }).join('<br>');
            }
        });
    });
});
</script>
<script>
function sortTable(n) {
  var table = document.getElementById("dtBasicExample");
  if (!table) return;
  var tbody = table.tBodies[0];
  if (!tbody) return;
  var noResult = tbody.querySelector("tr.no-result");
  if (noResult) noResult.parentNode.removeChild(noResult);

  var switching, i, x, y, shouldSwitch, dir, switchcount, rows;
  switchcount = 0;
  dir = "asc";
  switching = true;
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < rows.length - 1; i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (!x || !y) {
        break;
      }
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
  if (noResult) tbody.appendChild(noResult);
}

jQuery(function ($) {
  var $table = $("#dtBasicExample");
  var total = $table.find("tbody tr").not(".no-result").length;
  if ($(".counter").length) {
    $(".counter").text(total + " ítems");
  }

  $.expr[':'].containsi = function (elem, i, match) {
    return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
  };

  $(".search").on("keyup", function () {
    var searchTerm = $.trim($(this).val());
    if (!searchTerm) {
      $table.find("tbody tr").not(".no-result").attr("visible", "true");
      $table.find("tr.no-result").hide();
      var n = $table.find("tbody tr").not(".no-result").length;
      if ($(".counter").length) {
        $(".counter").text(n + " ítems");
      }
      return;
    }
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('");

    $table.find("tbody tr").not(".no-result").not(":containsi('" + searchSplit + "')").attr("visible", "false");
    $table.find("tbody tr").not(".no-result").filter(":containsi('" + searchSplit + "')").attr("visible", "true");

    var jobCount = $table.find('tbody tr[visible="true"]').not(".no-result").length;
    if ($(".counter").length) {
      $(".counter").text(jobCount + " ítems");
    }
    if (jobCount === 0) {
      $table.find("tr.no-result").show();
    } else {
      $table.find("tr.no-result").hide();
    }
  });

  // Evita problemas de posicionamiento al abrir modales dentro de tablas
  $('#dtBasicExample').on('click', '[data-toggle="modal"]', function () {
    var target = $(this).attr('href');
    if (target && target.charAt(0) === '#') {
      $(target).appendTo('body');
    }
  });
});

var scrollButton = document.querySelector(".btn-flotante");
window.addEventListener("scroll", function () {
  if (!scrollButton) return;
  var scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;
  scrollButton.style.display = scrollPosition > 220 ? "block" : "none";
});

function topFunction() {
  window.scrollTo({ top: 0, behavior: "smooth" });
}
</script>






<?php include('AgregarModal.php'); ?>
<?php include('footer2.php'); ?>
