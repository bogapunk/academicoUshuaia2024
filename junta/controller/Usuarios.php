<?php
class Usuarios extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url());
        }
        parent::__construct();
    }
    public function Listar()
    {
        $data = $this->model->selectUsuarios();
        $this->views->getView($this, "Listar", $data, "");
    }
    public function insertar()
    {

        $nombres = $_POST['nombres'];
       // $legajo = $_POST['legajo'];
        //$leghistorico = $_POST['leghistorico'];
        $apellidos = $_POST['apellidos'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];
        $telefono = $_POST['telefono'];
        $confirmar = $_POST['confirmar'];
        $hash = hash("SHA256", $clave);
        if ($clave != $confirmar) {
            $alert = array('mensaje' => 'no');
        } else {
            $insert = $this->model->insertarUsuarios($nombres,$apellidos, $hash, $rol,$telefono);
            if ($insert > 0) {
                $alert = 'registrado';
            } else if ($insert == 'existe') {
                $alert = 'existe';
            } else {
                $alert = 'error';
            }
        }

        $data = $this->model->selectUsuarios();
        header("location: " . base_url() . "Usuarios/Listar?msg=$alert");
        die();
    }
    public function editar()
    {
        $idusuario = $_GET['id'];
        $data = $this->model->editarUsuarios($id);
        if ($data == 0) {
            $this->Listar();
        } else {
            $this->views->getView($this, "Editar", $data);
        }
    }
       public function ver()
    {
        $id = $_GET['id'];
        $data = $this->model->verUsuarios($id);
        if ($data == 0) {
            $this->Listar();
        } else {
            $this->views->getView($this, "Ver", $data);
        }
    }
    
    public function actualizar()
    {
        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        //$clave = $_POST['clave'];
        
        $telefono = $_POST['telefono'];
        $rol = $_POST['rol'];
        $actualizar = $this->model->actualizarUsuarios($nombres,$apellidos, $rol, $telefono, $id);
        if ($actualizar == 1) {
            $alert = 'modificado';
        } else {
            $alert =  'error';
        }
        $data = $this->model->selectUsuarios();
        header("location: " . base_url() . "Usuarios/Listar?msg=$alert");
        die();
    }
    public function vista()
    {
        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $rol = $_POST['rol'];
        $vista = $this->model->vistaUsuarios($nombres, $apellidos, $rol, $id);
        if ($vista == 1) {
            $alert = 'modificado';
        } else {
            $alert =  'error';
        }
        $data = $this->model->selectUsuarios();
        header("location: " . base_url() . "Usuarios/Listar?msg=$alert");
        die();
    }
    public function eliminar()
    {
        $id = $_GET['id'];
        $eliminar = $this->model->eliminarUsuarios($id);
        $data = $this->model->selectUsuarios();
        header("location: " . base_url() . "Usuarios/Listar");
        die();
    }
    public function eliminados()
    {
        $data = $this->model->selectInactivos();
        $this->views->getView($this, "Eliminados", $data, "");
        
    }
    public function reingresar()
    {
        $id = $_GET['id'];
        $this->model->reingresarUsuarios($id);
        $this->model->selectUsuarios();
        header('location: ' . base_url() . 'Usuarios/Listar');
        //$this->views->getView($this, "Listar", $data);
        die();
    }
    public function login()
    {
        if (!empty($_POST['email']) || !empty($_POST['password'])) {
            $usuario = $_POST['email'];
            $clave = $_POST['password'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->selectUsuario($email, $hash);
            if (!empty($data)) {
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['nombres'] = $data['nombres'];
                    $_SESSION['apellidos'] = $data['apellidos'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['rol'] = $data['rol'];
                    $_SESSION['activo'] = true;
                    header('location: '.base_url(). 'Admin/Listar');
            } else {
                $error = 0;
                header("location: ".base_url()."?msg=$error");
            }
        }
    }
    public function cambiar()
    {
        $actual = $_POST['password'];
        $hash = hash("SHA256", $actual['actual']);
        $nueva = hash("SHA256", $actual['nueva']);
        $data = $this->model->cambiarPass($hash);
        if ($data != null) {
            echo 1;
            $this->model->cambiarContra($nueva, $data['id']);
        }  
    }
    public function salir()
    {
        session_destroy();
        header("Location: ".base_url());
    }
      public function buscarUsuarios()
    {
        $dni = $_POST['id'];
        $data = $this->model->buscarUsuario($id);
        echo json_encode($data);
    }

  case 'ObtenerUsuariosPorId':

  if (isset($_POST["id"])) 

  {
      $usuario = $usu->ObtenerUsuariosPorId($_POST["id"]);
      $data[] = $ = array(

        'nombres' => $usuario[0]['nombres'],
        'apellidos' => $usuario[0]['nombres'],
        'email' => $usuario[0]['email'],
        'telefono' => $usuario[0]['telefono'],
        'rol' => $usuario[0]['rol']


    );

      echo json_encode($data);
  }
     break;
}