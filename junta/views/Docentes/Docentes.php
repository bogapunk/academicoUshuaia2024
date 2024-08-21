<?php
/*
class Docente{
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "junta";
    private $docentesTbl    = "_junta_docentes";
    
    public function __construct(){
        if(!isset($this->db)){
            // Conexion con la database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Falló la conexion con MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    

    public function getRowsDocente($conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$this->docentesTbl;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }
        
        $result = $this->db->query($sql);
        
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $result->num_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();
                    break;
                default:
                    $data = '';
            }
        }else{
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
            }
        }
        return !empty($data)?$data:false;
    }
    
    /*
     * Insertar datos a la database
     
     
    public function insert($data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
            if(!array_key_exists('creado',$data)){
                $data['creado'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modificado',$data)){
                $data['modificado'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $columns .= $pre.$key;
                $values  .= $pre."'".$val."'";
                $i++;
            }
            $query = "INSERT INTO ".$this->docentesTbl." (".$columns.") VALUES (".$values.")";
            $insert = $this->db->query($query);
            return $insert?$this->db->insert_id:false;
        }else{
            return false;
        }
    }
    
    /*
     * Actualizar datos de la base de datos
     
    public function update($data, $conditions){
        if(!empty($data) && is_array($data) && !empty($conditions)){
            //prepare columns and values sql
            $cols_vals = '';
            $i = 0;
            if(!array_key_exists('modificado',$data)){
                $data['modificado'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $cols_vals .= $pre.$key." = '".$val."'";
                $i++;
            }
            
            //prepare where conditions
            $whereSql = '';
            $ci = 0;
            foreach($conditions as $key => $value){
                $pre = ($ci > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $ci++;
            }
            
            //prepare sql query
            $query = "UPDATE ".$this->docentesTbl." SET ".$cols_vals." WHERE ".$whereSql;

            //update data
            $update = $this->db->query($query);
            return $update?true:false;
        }else{
            return false;
        }
    }

}

*/
class Docente {
    private $dbHost = "10.1.9.113";
    private $dbUsername = "SA"; // Actualiza con tu usuario de SQL Server
    private $dbPassword = 'Davinci2024#'; // Actualiza con tu contraseña de SQL Server
    private $dbName = "junta";
    private $docentesTbl = "_junta_docentes";
    private $conn; // Propiedad para la conexión a la base de datos

    public function __construct() {
        try {
            $connectionInfo = array(
                "Database" => $this->dbName,
                "UID" => $this->dbUsername,
                "PWD" => $this->dbPassword,
                "TrustServerCertificate" => true // Confiar en el certificado del servidor
            );
            $conn = sqlsrv_connect($this->dbHost, $connectionInfo);
            if ($conn === false) {
                throw new Exception("Error de conexión: " . print_r(sqlsrv_errors(), true));
            } else {
                $this->conn = $conn; // Asignar la conexión a la propiedad de la clase
            }
        } catch (Exception $e) {
            exit("Error: " . $e->getMessage());
        }
    }


    public function getNextLegajo() {
        try {
            if (!isset($this->conn)) {
                throw new Exception("No se ha establecido la conexión a la base de datos.");
            }

            $sql = "SELECT MAX(legajo) AS max_legajo FROM " . $this->docentesTbl;
            $stmt = sqlsrv_query($this->conn, $sql);
            if ($stmt === false) {
                throw new Exception("Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $next_legajo = $row['max_legajo'] + 1;
            sqlsrv_free_stmt($stmt);
            return $next_legajo;
        } catch (Exception $e) {
            exit("Error al obtener el próximo legajo: " . $e->getMessage());
        }
    }
    
    
    public function getRowsDocente($conditions = array()) {
        $sql = 'SELECT ';
        $sql .= array_key_exists("select", $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $this->docentesTbl;
        if (array_key_exists("where", $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                $sql .= $pre . $key . " = '" . $value . "'";
                $i++;
            }
        }
        
        if (array_key_exists("order_by", $conditions)) {
            $sql .= ' ORDER BY ' . $conditions['order_by']; 
        }
        
        if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' OFFSET ' . $conditions['start'] . ' ROWS FETCH NEXT ' . $conditions['limit'] . ' ROWS ONLY'; 
        } elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' OFFSET 0 ROWS FETCH NEXT ' . $conditions['limit'] . ' ROWS ONLY'; 
        }
        
        $stmt = sqlsrv_query($this->conn, $sql); // Use $this->conn instead of $this->db
        
        if ($stmt === false) {
            exit("Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true));
        }

        if (array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all') {
            switch ($conditions['return_type']) {
                case 'count':
                    $data = sqlsrv_num_rows($stmt);
                    break;
                case 'single':
                    $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        } else {
            $data = array();
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }
        sqlsrv_free_stmt($stmt);
        return !empty($data) ? $data : false;
    }
    
    public function insert($data) {
        if (!empty($data) && is_array($data)) {
            $columns = '';
            $values = '';
            $i = 0;
            if (!array_key_exists('creado', $data)) {
                $data['creado'] = date("Y-m-d H:i:s");
            }
            if (!array_key_exists('modificado', $data)) {
                $data['modificado'] = date("Y-m-d H:i:s");
            }
            foreach ($data as $key => $val) {
                $pre = ($i > 0) ? ', ' : '';
                $columns .= $pre . $key;
                $values .= $pre . "'" . $val . "'";
                $i++;
            }
            $query = "INSERT INTO " . $this->docentesTbl . " (" . $columns . ") VALUES (" . $values . ")";
            $stmt = sqlsrv_query($this->conn, $query); // Use $this->conn instead of $this->db
            if ($stmt) {
                sqlsrv_next_result($stmt); // Move to the next result
                sqlsrv_fetch($stmt); // Fetch the result
                $insertId = sqlsrv_get_field($stmt, 0);
                return $insertId ? $insertId : false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function update($data, $conditions) {
        if (!empty($data) && is_array($data) && !empty($conditions)) {
            // prepare columns and values sql
            $cols_vals = '';
            $i = 0;
            if (!array_key_exists('modificado', $data)) {
                $data['modificado'] = date("Y-m-d H:i:s");
            }
            foreach ($data as $key => $val) {
                $pre = ($i > 0) ? ', ' : '';
                $cols_vals .= $pre . $key . " = '" . $val . "'";
                $i++;
            }
            
            // prepare where conditions
            $whereSql = '';
            $ci = 0;
            foreach ($conditions as $key => $value) {
                $pre = ($ci > 0) ? ' AND ' : '';
                $whereSql .= $pre . $key . " = '" . $value . "'";
                $ci++;
            }
            
            // prepare sql query
            $query = "UPDATE " . $this->docentesTbl . " SET " . $cols_vals . " WHERE " . $whereSql;

            // update data
            $stmt = sqlsrv_query($this->conn, $query); // Use $this->conn instead of $this->db
            return $stmt ? true : false;
        } else {
            return false;
        }
    }
}
