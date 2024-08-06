<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo">
            </div>
            <div class="form-group">
                <label for="tipocarga">Tipo de Carga:</label>
                <input type="text" class="form-control" id="tipocarga" name="tipocarga">
            </div>
            <!-- Aquí añadirías los demás campos de formulario -->
            <input type="hidden" id="id2" name="id2" value="<?php echo $_GET['id2']; ?>">
            <!-- Este campo oculto contiene el valor de id2 -->
            <button type="button" class="btn btn-success" onclick="actualizarDatos()">Actualizar Datos</button>
        </div>
    </div>
</div>