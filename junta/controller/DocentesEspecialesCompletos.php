<?php

 public function buscarDocentesEspecialesCompletos()
    {
        $dni = $_POST['id'];
        $data = $this->model->buscarDocentesEspecialesCompletos($id);
        echo json_encode($data);
    }

    ?>