 <?php

 public function buscarDocentesEspeciales()
    {
        $dni = $_POST['id'];
        $data = $this->model->buscarDocentesEspeciales($id);
        echo json_encode($data);
    }

    ?>