<?php

class Modalidad{
    private $dbHost     = "db";
    private $dbUsername = "SA";
    private $dbPassword = '"asd123"';
    private $dbName     = "junta";
    private $modalidadTbl    = "_junta_modalidades";
    
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
        $sql .= array_key_exists("select", $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $this->modalidadTbl;

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

            $query = "INSERT INTO " . $this->modalidadTbl . " (" . $columns . ") VALUES (" . $placeholders . ")";

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
                $cols_vals .= $pre . $key . " = ?";
                $i++;
            }

            $whereSql = '';
            $ci = 0;
            foreach ($conditions as $key => $value) {
                $pre = ($ci > 0) ? ' AND ' : '';
                $whereSql .= $pre . $key . " = ?";
                $ci++;
            }

            $query = "UPDATE " . $this->modalidadTbl . " SET " . $cols_vals . " WHERE " . $whereSql;
            $params = array_merge(array_values($data), array_values($conditions));

            $stmt = sqlsrv_query($this->conn, $query, $params);
            if ($stmt === false) {
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
