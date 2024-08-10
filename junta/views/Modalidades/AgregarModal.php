<?php

$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['estado']['msg'])){
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

?>

<!-- Agregar Nuevos Registros -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" aria-label="Close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Agregar Nuevo Registro</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="MiCuenta.php">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">CODIGO MODALIDAD:</label>
					</div>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="codmod">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombre  Modalidad:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nommod">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Titulo:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="titulo">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Tope:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tope">
					</div>
				</div>
				<div class="row form-group">
				
					<div class="col-sm-10">
						<input type="text"   class="form-control" name="comp" placeholder="comp" required="">
					</div>
				</div>
				
          
                  <?php 

                    include 'ModalidadCon.php';
						$modalidad = new Modalidad();
						
						$conditions['return_type'] = 'single';

                        $modalidadData = $modalidad->getRows2($conditions); ?>

				
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <button type="submit" name="agregar" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Registro</button>
			</form>
            </div>

        </div>
    </div>
</div>