 <?php

 public function buscarModalidades()
    {
        $dni = $_POST['id'];
        $data = $this->model->buscarModalidades($id);
        echo json_encode($data);
    }

 public function eliminar()
    {
        $id = $_GET['Id'];
        $this->model->eliminarModalidades($id);
        header("location:views/Modalidades/ListarModalidades ");
        die();
    }



    ?>