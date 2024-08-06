 <?php

 public function buscarDocentesEspecialesSinTitulares()
    {
        $dni = $_POST['id'];
        $data = $this->model->buscarDocentesEspecialesSinTitulares($id);
        echo json_encode($data);
    }

    ?>