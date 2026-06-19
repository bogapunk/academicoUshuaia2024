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
.registro-conf-page {
  padding: 12px 0 32px;
}

.registro-conf-shell {
  max-width: 720px;
  margin: 0 auto;
  padding: 0 12px;
  box-sizing: border-box;
}

.registro-conf-shell .form-container {
  background: #fff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
  padding: 22px 24px 26px;
}

.registro-conf-header {
  text-align: center;
  margin-bottom: 18px;
}

.registro-conf-title {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 24px;
  font-weight: 700;
  color: #1f2937;
  margin: 0 0 6px;
  padding-bottom: 8px;
  border-bottom: 2px solid rgba(38, 152, 243, 0.35);
  letter-spacing: 0.04em;
  text-transform: uppercase;
  line-height: 1.3;
}

.registro-conf-subtitle {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 16px;
  font-weight: 500;
  color: #6b7280;
  margin: 0;
}

.registro-conf-shell .form-group {
  margin-bottom: 16px;
}

.registro-conf-shell .form-group label {
  display: block;
  font-weight: 600;
  font-size: 13px;
  color: #374151;
  margin-bottom: 6px;
}

.registro-conf-shell .form-control,
.registro-conf-shell select.form-control {
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

.registro-conf-shell select.form-control {
  height: auto;
  line-height: 1.35;
  -webkit-appearance: menulist;
  appearance: menulist;
}

.registro-conf-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 12px;
  margin-top: 24px;
  padding-top: 18px;
  border-top: 1px solid #e5e7eb;
}

.registro-conf-actions .btn {
  min-width: 140px;
  border-radius: 6px;
  font-weight: 600;
  padding: 10px 18px;
}

.registro-conf-actions .btn-success {
  text-decoration: none;
}

@media (max-width: 767px) {
  .registro-conf-shell .form-container {
    padding: 16px 12px;
  }
  .registro-conf-title {
    font-size: 18px;
  }
}

p.success { color: #34A853; }
p.error { color: #EA4335; }
</style>

<?php
include 'ConfiguracionListados.php';
$confLis = new ConfiguracionListados();
$conditions['return_type'] = 'single';
$confLisData = $confLis->getRows4($conditions);

$opcionesCiudad = [
    "RG" => "Rio Grande",
    "TOL" => "Tolhuin",
    "USH" => "Ushuaia"
];
$valorPorDefecto = "RG";
$ciudadSeleccionada = isset($confLisData['ciudad']) ? $confLisData['ciudad'] : $valorPorDefecto;
?>

<div class="registro-conf-page">
<div class="registro-conf-shell">
  <div class="registro-conf-header">
    <h1 class="registro-conf-title">Configuración de Listados de Aspirantes a Cubrir Cargos Provinciales</h1>
    <p class="registro-conf-subtitle">Nuevo listado de configuración</p>
  </div>

  <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '">' . $statusMsg . '</p>' : ''; ?>

  <div class="form-container">
    <form action="MiConfiguracionListado.php" method="post">

      <div class="form-group">
        <label for="listado">Listado</label>
        <input type="text" name="listado" id="listado" placeholder="Ingrese el nombre del listado" required class="form-control">
      </div>

      <div class="form-group">
        <label for="ciudad">Ciudad</label>
        <select id="ciudad" class="form-control" name="ciudad">
          <?php foreach ($opcionesCiudad as $valor => $etiqueta): ?>
            <option value="<?= $valor ?>" <?php if ($valor == $ciudadSeleccionada) echo "selected"; ?>>
              <?= $etiqueta ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <input type="hidden" name="trial510" value="<?php echo $valorPorDefecto; ?>">

      <div class="form-group">
        <label for="modalidades">Modalidades</label>
        <input type="text" name="modalidades" id="modalidades" placeholder="Ingrese las modalidades" required class="form-control">
      </div>

      <div class="registro-conf-actions">
        <button name="insertar" type="submit" id="btnGuardarRegConf" class="btn btn-primary">
          <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
        </button>
        <a href="./ListarConfiguracionListados.php" class="btn btn-success">
          <span class="glyphicon glyphicon-arrow-left"></span> Volver
        </a>
      </div>

    </form>
  </div>
</div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('btnGuardarRegConf').addEventListener('click', function(e) {
    e.preventDefault();
    var form = this.closest('form');
    juntaConfirm('¿Desea cargar los datos del nuevo listado?', function() {
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
