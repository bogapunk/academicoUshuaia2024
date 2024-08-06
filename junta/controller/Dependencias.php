 <?php

 public function buscarDependencias()
    {
        $dni = $_POST['id'];
        $data = $this->model->buscarDependencias($id);
        echo json_encode($data);
    }

 public function eliminar()
    {
        $id = $_GET['Id'];
        $this->model->eliminarDependencias($id);
        header("location:views/Depenedencias/ListarDepenedencias ");
        die();
    }



    ?>