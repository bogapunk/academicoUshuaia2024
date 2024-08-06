 <?php

 public function buscarConfiguracionListado()
    {
        $dni = $_POST['id'];
        $data = $this->model->buscarConfiguracionListado($id);
        echo json_encode($data);
    }

 public function eliminar()
    {
        $id = $_GET['Id'];
        $this->model->eliminarConfiguracionListado($id);
        header("location:views/ConfiguracionListados/ListarConfiguracionListados.php ");
        die();
    }



    ?>