<?php
/* conexion anterior mysql
class Dependencia{
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "junta";
    private $dependenciasTbl    = "_junta_dependencias";
    
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
    

    public function getRows3($conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$this->dependenciasTbl;
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
            $query = "INSERT INTO ".$this->dependenciasTbl." (".$columns.") VALUES (".$values.")";
            $insert = $this->db->query($query);
            return $insert?$this->db->insert_id:false;
        }else{
            return false;
        }
    }
    
  
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
            $query = "UPDATE ".$this->dependenciasTbl." SET ".$cols_vals." WHERE ".$whereSql;

            //update data
            $update = $this->db->query($query);
            return $update?true:false;
        }else{
            return false;
        }
    }

}

*/
class Dependencia {
    private $serverName = "localhost";
    private $username = "boga"; // Reemplaza con tu usuario de SQL Server
    private $password = "30153846"; // Reemplaza con tu contraseña de SQL Server
    private $dbName = "junta";
    private $dependenciasTbl = "_junta_dependencias";
    private $conn;

    public function __construct() {
        try {
            $connectionOptions = array(
                "Database" => $this->dbName,
                "Uid" => $this->username,
                "PWD" => $this->password
            );
            $this->conn = sqlsrv_connect($this->serverName, $connectionOptions);
            if ($this->conn === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        } catch (Exception $e) {
            die("Falló la conexión con SQL Server: " . $e->getMessage());
        }
    }

    public function getRows3($conditions = array()) {
        $sql = 'SELECT ';
        $sql .= array_key_exists("select", $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $this->dependenciasTbl;
    
        if (array_key_exists("where", $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                $sql .= $pre . $key . " = ?";
                $i++;
            }
        }
    
        if (array_key_exists("order_by", $conditions)) {
            $sql .= ' ORDER BY ' . $conditions['order_by'];
        }
    
        if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' OFFSET ' . $conditions['start'] . ' ROWS FETCH NEXT ' . $conditions['limit'] . ' ROWS ONLY';
        } elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' FETCH FIRST ' . $conditions['limit'] . ' ROWS ONLY';
        }
    
        $params = array();
        if (array_key_exists("where", $conditions)) {
            $params = array_values($conditions['where']);
        }
    
        $stmt = sqlsrv_query($this->conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        $data = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
    
        return !empty($data) ? $data : false;
    }


    public function insert($data) {
        if (!empty($data) && is_array($data)) {
            if (!array_key_exists('creado', $data)) {
                $data['creado'] = date("Y-m-d H:i:s");
            }
            if (!array_key_exists('modificado', $data)) {
                $data['modificado'] = date("Y-m-d H:i:s");
            }
    
            $columns = implode(', ', array_keys($data));
            $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
    
            $query = "INSERT INTO " . $this->dependenciasTbl . " (" . $columns . ") VALUES (" . $placeholders . ")";
            
            $params = array_values($data);
            $stmt = sqlsrv_query($this->conn, $query, $params);
    
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
    
            $id = $this->getLastInsertedId();
            return $id;
        } else {
            return false;
        }
    }






    public function update($data, $conditions) {
        if (!empty($data) && is_array($data) && !empty($conditions)) {
            if (!array_key_exists('modificado', $data)) {
                $data['modificado'] = date("Y-m-d H:i:s");
            }

            $cols_vals = '';
            $i = 0;
            foreach ($data as $key => $val) {
                $pre = ($i > 0) ? ', ' : '';
                $cols_vals .= $pre . $key . " = '" . $val . "'";
                $i++;
            }

            $whereSql = '';
            $ci = 0;
            foreach ($conditions as $key => $value) {
                $pre = ($ci > 0) ? ' AND ' : '';
                $whereSql .= $pre . $key . " = '" . $value . "'";
                $ci++;
            }

            $query = "UPDATE " . $this->dependenciasTbl . " SET " . $cols_vals . " WHERE " . $whereSql;
            $update = sqlsrv_query($this->conn, $query);
            if ($update === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            return true;
        } else {
            return false;
        }
    }

    private function getLastInsertedId() {
        $query = "SELECT SCOPE_IDENTITY() AS last_id";
        $result = sqlsrv_query($this->conn, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        return $row['last_id'];
    }

    public function __destruct() {
        sqlsrv_close($this->conn);
    }
}