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
.registro-mod-page {
  padding: 12px 0 32px;
}

.registro-mod-shell {
  max-width: 720px;
  margin: 0 auto;
  padding: 0 12px;
  box-sizing: border-box;
}

.registro-mod-shell .form-container {
  background: #fff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
  padding: 22px 24px 26px;
}

.registro-mod-header {
  text-align: center;
  margin-bottom: 18px;
}

.registro-mod-title {
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

.registro-mod-subtitle {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 16px;
  font-weight: 500;
  color: #6b7280;
  margin: 0;
}

.registro-mod-shell .form-group {
  margin-bottom: 16px;
}

.registro-mod-shell .form-group label {
  display: block;
  font-weight: 600;
  font-size: 13px;
  color: #374151;
  margin-bottom: 6px;
}

.registro-mod-shell .form-control,
.registro-mod-shell select.form-control {
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

.registro-mod-shell select.form-control {
  height: auto;
  line-height: 1.35;
  -webkit-appearance: menulist;
  appearance: menulist;
}

.registro-mod-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 12px;
  margin-top: 24px;
  padding-top: 18px;
  border-top: 1px solid #e5e7eb;
}

.registro-mod-actions .btn {
  min-width: 140px;
  border-radius: 6px;
  font-weight: 600;
  padding: 10px 18px;
}

.registro-mod-actions .btn-success {
  text-decoration: none;
}

@media (max-width: 767px) {
  .registro-mod-shell .form-container {
    padding: 16px 12px;
  }
  .registro-mod-title {
    font-size: 22px;
  }
}

p.success { color: #34A853; }
p.error { color: #EA4335; }
</style>

<?php
include 'Modalidades.php';
$modalidad = new Modalidad();
$conditions['return_type'] = 'single';
$modalidadData = $modalidad->getRows3($conditions);

$opciones = [
    "DOCENTE" => "DOCENTE",
    "HABILITANTE" => "HABILITANTE",
    "SUPLETORIO" => "SUPLETORIO"
];
$tituloSeleccionado = isset($modalidadData['titulo']) ? $modalidadData['titulo'] : null;
?>

<div class="registro-mod-page">
<div class="registro-mod-shell">
  <div class="registro-mod-header">
    <h1 class="registro-mod-title">Crear Modalidad</h1>
    <p class="registro-mod-subtitle">Complete los datos de la nueva modalidad</p>
  </div>

  <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '">' . $statusMsg . '</p>' : ''; ?>

  <div class="form-container">
    <form action="MiModalidad.php" method="post">

      <div class="form-group">
        <label for="codmod">Código de Modalidad</label>
        <input type="text" name="codmod" id="codmod" placeholder="Ingrese el código de modalidad" required class="form-control">
      </div>

      <div class="form-group">
        <label for="nommod">Descripción</label>
        <input type="text" name="nommod" id="nommod" placeholder="Ingrese la descripción" required class="form-control">
      </div>

      <div class="form-group">
        <label for="titulo">Título</label>
        <select id="titulo" class="form-control" name="titulo">
          <?php foreach ($opciones as $valor => $etiqueta): ?>
            <option value="<?= $valor ?>" <?php if ($valor == $tituloSeleccionado) echo "selected"; ?>>
              <?= $etiqueta ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="tope">Tope</label>
        <input type="text" name="tope" id="tope" placeholder="Ingrese el tope" required class="form-control">
      </div>

      <div class="registro-mod-actions">
        <button name="insertar" type="submit" id="btnGuardarRegMod" class="btn btn-primary">
          <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
        </button>
        <a href="./ListarModalidades.php" class="btn btn-success">
          <span class="glyphicon glyphicon-arrow-left"></span> Volver
        </a>
      </div>

    </form>
  </div>
</div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('btnGuardarRegMod').addEventListener('click', function(e) {
    e.preventDefault();
    var form = this.closest('form');
    juntaConfirm('¿Desea cargar los datos de la nueva modalidad?', function() {
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
