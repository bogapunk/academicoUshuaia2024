<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['estado']['msg'])){
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}
include('header2.php');
?>
<style type="text/css">
.registro-dep-page {
  padding: 12px 0 32px;
}

.registro-dep-shell {
  max-width: 720px;
  margin: 0 auto;
  padding: 0 12px;
  box-sizing: border-box;
}

.registro-dep-shell .form-container {
  background: #fff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
  padding: 22px 24px 26px;
}

.registro-dep-header {
  text-align: center;
  margin-bottom: 18px;
}

.registro-dep-title {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 28px;
  font-weight: 700;
  color: #1f2937;
  margin: 0 0 6px;
  padding-bottom: 8px;
  border-bottom: 2px solid rgba(38, 152, 243, 0.35);
  letter-spacing: 0.04em;
  text-transform: uppercase;
}

.registro-dep-subtitle {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 16px;
  font-weight: 500;
  color: #6b7280;
  margin: 0;
}

.registro-dep-shell .form-group {
  margin-bottom: 16px;
}

.registro-dep-shell .form-group label {
  display: block;
  font-weight: 600;
  font-size: 13px;
  color: #374151;
  margin-bottom: 6px;
}

.registro-dep-shell .form-control,
.registro-dep-shell select.form-control {
  width: 100%;
  max-width: 100%;
  min-height: 40px;
  border-radius: 6px;
  border: 1px solid #ced4da;
  box-shadow: none;
  font-size: 14px;
  padding: 8px 12px;
  box-sizing: border-box;
}

.registro-dep-shell select.form-control {
  height: auto;
  line-height: 1.35;
  -webkit-appearance: menulist;
  appearance: menulist;
}

.registro-dep-shell .form-text {
  font-size: 12px;
  color: #6b7280;
  margin-top: 4px;
}

.registro-dep-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 12px;
  margin-top: 24px;
  padding-top: 18px;
  border-top: 1px solid #e5e7eb;
}

.registro-dep-actions .btn {
  min-width: 140px;
  border-radius: 6px;
  font-weight: 600;
  padding: 10px 18px;
}

.registro-dep-actions .btn-success {
  text-decoration: none;
}

@media (max-width: 767px) {
  .registro-dep-shell .form-container {
    padding: 16px 12px;
  }
  .registro-dep-title {
    font-size: 22px;
  }
}

p.success { color: #34A853; }
p.error { color: #EA4335; }
</style>

<?php
include 'Dependencias.php';
$dependencia = new Dependencia();
$ultimoCoddep = $dependencia->obtenerUltimoCoddep();
$proximoCoddep = $ultimoCoddep + 1;
?>

<div class="registro-dep-page">
<div class="registro-dep-shell">
  <div class="registro-dep-header">
    <h1 class="registro-dep-title">Crear Dependencia</h1>
    <p class="registro-dep-subtitle">Complete los datos de la nueva dependencia</p>
  </div>

  <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '">' . $statusMsg . '</p>' : ''; ?>

  <div class="form-container">
    <form action="MiDepedencia.php" method="post">

      <div class="form-group">
        <label for="nomdep">Nombre de Dependencia</label>
        <input type="text" name="nomdep" id="nomdep" placeholder="Ingrese el nombre de la dependencia" required class="form-control">
      </div>

      <div class="form-group">
        <label for="coddep">Código de Dependencia</label>
        <input type="number" name="coddep" id="coddep" value="<?php echo $proximoCoddep; ?>" class="form-control" readonly>
        <small class="form-text text-muted">Código asignado automáticamente por el sistema</small>
      </div>

      <div class="form-group">
        <label for="domicilio">Domicilio</label>
        <input type="text" name="domicilio" id="domicilio" placeholder="Ingrese el domicilio" required class="form-control">
      </div>

      <div class="form-group">
        <label for="codloc">Localidad</label>
        <select name="codloc" id="codloc" class="form-control">
          <option value="">Seleccione localidad</option>
          <option value="USH">Ushuaia</option>
          <option value="RGD">Rio Grande</option>
          <option value="TOL">Tolhuin</option>
          <option value="ANT1">Antártida</option>
        </select>
      </div>

      <div class="form-group">
        <label for="directo">Directo</label>
        <input type="text" name="directo" id="directo" placeholder="Ingrese teléfono directo" class="form-control">
      </div>

      <div class="form-group">
        <label for="interno">Interno</label>
        <input type="text" name="interno" id="interno" placeholder="Ingrese número interno" class="form-control">
      </div>

      <?php
      $dependencia2 = new Dependencia();
      $conditions = array('return_type' => 'single');
      $dependenciaData = $dependencia2->getRows3($conditions);
      $codnivActivo = '';
      $codnivInactivo = '';
      if (isset($dependenciaData['codniv'])) {
          if ($dependenciaData['codniv'] == "activo") {
              $codnivActivo = "selected";
          } elseif ($dependenciaData['codniv'] == "inactivo") {
              $codnivInactivo = "selected";
          }
      }
      ?>

      <div class="form-group">
        <label for="codniv">Estado</label>
        <select id="codniv" class="form-control" name="codniv">
          <option value="1" <?php echo $codnivActivo; ?>>Activo</option>
          <option value="0" <?php echo $codnivInactivo; ?>>Inactivo</option>
        </select>
      </div>

      <div class="registro-dep-actions">
        <button name="insertar" type="submit" id="btnGuardarRegDep" class="btn btn-primary">
          <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
        </button>
        <a href="./ListarDependencias.php" class="btn btn-success">
          <span class="glyphicon glyphicon-arrow-left"></span> Volver
        </a>
      </div>

    </form>
  </div>
</div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('btnGuardarRegDep').addEventListener('click', function(e) {
    e.preventDefault();
    var form = this.closest('form');
    juntaConfirm('¿Desea cargar los datos de la nueva dependencia?', function() {
      if (!form.querySelector('input[name="insertar"]')) {
        var h = document.createElement('input');
        h.type = 'hidden'; h.name = 'insertar'; h.value = '1';
        form.appendChild(h);
      }
      form.submit();
    });
  });
});
</script>
<?php include('footer2.php');?>
