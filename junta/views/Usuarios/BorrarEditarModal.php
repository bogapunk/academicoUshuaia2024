<?php
$modalId = (int) $row['id'];
$estadoActivo = ($row['estado'] == 1 || $row['estado'] === '1');
$filtroRetorno = isset($filtroEstado) ? $filtroEstado : 'activos';
?>
<!-- Ventana Editar  -->
<div class="modal fade" id="edit_<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Editar Usuario</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="EditarRegistro.php?id=<?php echo $modalId; ?>" class="form-editar-usuario" data-user-id="<?php echo $modalId; ?>">
                <input type="hidden" name="filtro_retorno" value="<?php echo htmlspecialchars($filtroRetorno, ENT_QUOTES, 'UTF-8'); ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombres:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nombres" value="<?php echo htmlspecialchars($row['nombres'], ENT_QUOTES, 'UTF-8'); ?>" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Apellidos:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="apellidos" value="<?php echo htmlspecialchars($row['apellidos'], ENT_QUOTES, 'UTF-8'); ?>" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Email:</label>
					</div>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Telefono:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="telefono" value="<?php echo htmlspecialchars($row['telefono'], ENT_QUOTES, 'UTF-8'); ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Rol:</label>
					</div>
					<div class="col-sm-10">
						<select class="form-control" name="rol">
                            <option value="admin" <?php if ($row['rol'] == "admin") echo "selected"; ?>>Administrador</option>
                            <option value="comun" <?php if ($row['rol'] == "comun") echo "selected"; ?>>Comun</option>
                            <option value="otro" <?php if ($row['rol'] == "otro") echo "selected"; ?>>Otro</option>
                        </select>
					</div>
				</div>
                <div class="row form-group">
                    <div class="col-sm-2">
                        <label class="control-label" style="position:relative; top:7px;">Estado:</label>
                    </div>
                    <div class="col-sm-10">
                        <select class="form-control" name="estado">
                            <option value="1" <?php echo $estadoActivo ? 'selected' : ''; ?>>Activo</option>
                            <option value="0" <?php echo !$estadoActivo ? 'selected' : ''; ?>>Inactivo</option>
                        </select>
                    </div>
                </div>
				<div class="row form-group">
				    <div class="col-sm-2">
				        <label class="control-label" style="position:relative; top:7px;">Password:</label>
				    </div>
				    <div class="col-sm-10">
				        <input type="password" class="form-control password-edit-input" name="password" autocomplete="new-password" placeholder="Dejar vacío para no cambiar">
                        <p class="text-muted" style="font-size:12px;margin-top:6px;">
                            Si cambia la contraseña: <?php echo htmlspecialchars(junta_password_requisitos_texto(), ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <div class="password-edit-checklist"></div>
                        <div class="password-edit-error text-danger" style="font-size:12px;margin-top:4px;"></div>
				    </div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <button type="submit" name="editar" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Actualizar Ahora</button>
			</form>
            </div>
        </div>
    </div>
</div>

<!-- Desactivar -->
<div class="modal fade" id="delete_<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Desactivar usuario</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">¿Está seguro de desactivar este usuario?</p>
				<h2 class="text-center"><?php echo htmlspecialchars($row['nombres'] . ' ' . $row['apellidos'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p class="text-center text-muted" style="font-size:13px;">El usuario no se elimina de la base de datos; solo dejará de poder iniciar sesión hasta que lo reactive.</p>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="CambiarEstadoUsuario.php?id=<?php echo $modalId; ?>&amp;estado=0&amp;filtro=<?php echo urlencode($filtroRetorno); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-ban-circle"></span> Desactivar</a>
            </div>
        </div>
    </div>
</div>

<!-- Activar -->
<div class="modal fade" id="activate_<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Activar usuario</h4></center>
            </div>
            <div class="modal-body">
                <p class="text-center">¿Desea reactivar este usuario?</p>
                <h2 class="text-center"><?php echo htmlspecialchars($row['nombres'] . ' ' . $row['apellidos'], ENT_QUOTES, 'UTF-8'); ?></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="CambiarEstadoUsuario.php?id=<?php echo $modalId; ?>&amp;estado=1&amp;filtro=<?php echo urlencode($filtroRetorno); ?>" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> Activar</a>
            </div>
        </div>
    </div>
</div>
