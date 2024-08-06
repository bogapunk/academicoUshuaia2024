<?php
include 'Usuarios_Conexion_Sqlserver2.php';

class UsuariosModel extends Mysql {
    public $id, $password, $nombres, $apellidos, $rol;

    public function __construct() {
        parent::__construct();
    }

    public function selectUsuarios() {
        $sql = "SELECT * FROM usuarios WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }

    public function selectInactivos() {
        $sql = "SELECT * FROM usuarios WHERE permiso = 0";
        $res = $this->select_all($sql);
        return $res;
    }

    public function insertarUsuarios(string $nombres, string $apellidos, string $password, string $rol, string $telefono) {
        $return = "";
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->password = $password;
        $this->rol = $rol;
        $this->telefono = $telefono;

        $sql = "SELECT * FROM usuarios WHERE apellidos = '{$this->apellidos}'";
        $result = $this->select_all($sql);

        if (empty($result)) {
            $query = "INSERT INTO usuarios (nombres, apellidos, password, rol, telefono) VALUES (?, ?, ?, ?, ?)";
            $data = array($this->nombres, $this->apellidos, $this->password, $this->rol, $this->telefono);
            $resul = $this->insert($query, $data);
            $return = $resul;
        } else {
            $return = "existe";
        }
        
        return $return;
    }

    public function editarUsuarios(int $id) {
        $this->id = $id;
        $sql = "SELECT * FROM usuarios WHERE id = '{$this->id}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }

    public function verUsuarios(int $id) {
        $this->id = $id;
        $sql = "SELECT * FROM usuarios WHERE id = '{$this->id}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }

    public function actualizarUsuarios(string $nombres, string $apellidos, string $rol, string $telefono, int $id) {
        $return = "";
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->rol = $rol;
        $this->telefono = $telefono;
        $this->id = $id;

        $query = "UPDATE usuarios SET nombres = ?, apellidos = ?, rol = ?, telefono = ? WHERE id = ?";
        $data = array($this->nombres, $this->apellidos, $this->rol, $this->telefono, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        
        return $return;
    }

    public function eliminarUsuarios(int $id) {
        $return = "";
        $this->id = $id;
        $query = "UPDATE usuarios SET estado = 0 WHERE id = ?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        
        return $return;
    }

    public function selectUsuario(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
        $sql = "SELECT * FROM usuarios WHERE email = '{$this->email}' AND password = '{$this->password}'";
        $res = $this->select($sql);
        
        return $res;
    }

    public function reingresarUsuarios(int $id) {
        $return = "";
        $this->id = $id;
        $query = "UPDATE usuarios SET estado = 1 WHERE id = ?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        
        return $return;
    }

    public function cambiarPass(string $password) {
        $this->password = $password;
        $query = "SELECT * FROM usuarios WHERE password = '$password'";
        $resul = $this->select($query);
        
        return $resul;
    }

    public function cambiarContra(string $password, int $id) {
        $this->password = $password;
        $this->id = $id;
        $query = "UPDATE usuarios SET password = ? WHERE id = ?";
        $data = array($this->password, $this->id);
        $resul = $this->update($query, $data);
        
        return $resul;
    }
}
?>
