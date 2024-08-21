<?php

class User{
    private $dbHost     = "10.1.9.113";
    private $dbUsername = "SA";
    private $dbPassword = 'Davinci2024#';
    private $dbName     = "junta";
    private $userTbl    = "usuarios";
   
    
    public function __construct(){
        if(!isset($this->db)){
            // Connection to the database
            $connectionInfo = array("Database"=>$this->dbName, "UID"=>$this->dbUsername, "PWD"=>$this->dbPassword,"TrustServerCertificate"=>true);
            $conn = sqlsrv_connect($this->dbHost, $connectionInfo);
            if($conn === false){
                die(print_r(sqlsrv_errors(), true));
            }else{
                $this->db = $conn;
            }
        }
    }
    
    public function getRows($conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$this->userTbl;
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
            $sql .= ' OFFSET '.$conditions['start'].' ROWS FETCH NEXT '.$conditions['limit'].' ROWS ONLY'; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' OFFSET 0 ROWS FETCH NEXT '.$conditions['limit'].' ROWS ONLY'; 
        }
        
        $result = sqlsrv_query($this->db, $sql);
        
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = sqlsrv_num_rows($result);
                    break;
                case 'single':
                    $data = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        }else{
            if(sqlsrv_has_rows($result)){
                $data = array();
                while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    $data[] = $row;
                }
            }
        }
        return !empty($data)?$data:false;
    }
    
    /*
     * Insertar datos a la database
     */
    public function insert($data) {
        if (!empty($data) && is_array($data)) {
            $columns = '';
            $values = '';
            $params = array();
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
                $values .= $pre . '?';
                $params[] = $val;
                $i++;
            }
            $query = "INSERT INTO " . $this->userTbl . " (" . $columns . ") VALUES (" . $values . ")";
            $stmt = sqlsrv_query($this->db, $query, $params);
            if ($stmt === false) {
                // Manejar el error
                die(print_r(sqlsrv_errors(), true));
                return false;
            } else {
                // Retorna el último id insertado
                return sqlsrv_get_field($stmt, 0);
            }
        } else {
            return false;
        }
    }
    
    /*
     * Actualizar datos de la base de datos
     */
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
            $query = "UPDATE ".$this->userTbl." SET ".$cols_vals." WHERE ".$whereSql;

            //update data
            $update = sqlsrv_query($this->db, $query);
            return $update?true:false;
        }else{
            return false;
        }
    }
}