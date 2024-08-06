<div class="modal fade" id="ver_<?php echo $doc->__GET('legajo'); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" aria-label="Close" data-dismiss="modal" aria-hidden="true">×</button>
        <center><h4 class="modal-title" id="myModalLabel">Listado de Inscripciones</h4></center>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="ModalDocentes.php?legajo=<?php echo $doc->__GET('legajo'); ?>">
            <table style="width:100%;">
              <tr>
                <th>Opción</th>
                <th>Año</th>
                <th>Cod. Mod.</th>
                <th>Descripción</th>
                <th>Establecimiento</th>
                <th>Puntaje</th>
                <th>Tipo Insc.</th>
                <th>Fecha</th>
              </tr>
              </table>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" name="editar" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Actualizar Ahora</a>
      </div>
    </div>
  </div>
</div>