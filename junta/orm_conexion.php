<?php

class Database {
    private $pdo;
    private $dbType;

    public function __construct($dbType, $host, $dbname, $username, $password) {
        $this->dbType = $dbType;
        try {
            if ($dbType == 'mysql') {
                $dsn = "mysql:host=$host;dbname=$dbname";
            } elseif ($dbType == 'sqlsrv') {
                $dsn = "sqlsrv:Server=$host;Database=$dbname;TrustServerCertificate=True";
            }
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}

//uso de orm conexion

class ORM {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function select($table, $conditions = []) {
        $sql = 'SELECT ';
        $sql .= array_key_exists("select", $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $table;
        if (array_key_exists("where", $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                $sql .= $pre . $key . " = :" . $key;
                $i++;
            }
        }
        if (array_key_exists("order_by", $conditions)) {
            $sql .= ' ORDER BY ' . $conditions['order_by'];
        }
        if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['start'] . ',' . $conditions['limit'];
        } elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['limit'];
        }
        
        $stmt = $this->db->prepare($sql);
        if (array_key_exists("where", $conditions)) {
            foreach ($conditions['where'] as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
        }
        $stmt->execute();
        
        if (array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all') {
            switch ($conditions['return_type']) {
                case 'count':
                    return $stmt->rowCount();
                case 'single':
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                default:
                    return '';
            }
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function insert($table, $data) {
        if (!empty($data) && is_array($data)) {
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));
            $sql = "INSERT INTO $table ($columns) VALUES ($values)";
            $stmt = $this->db->prepare($sql);
            foreach ($data as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
            return $stmt->execute() ? $this->db->lastInsertId() : false;
        }
        return false;
    }

    public function update($table, $data, $conditions) {
        if (!empty($data) && is_array($data) && !empty($conditions)) {
            $cols_vals = '';
            $i = 0;
            foreach ($data as $key => $val) {
                $pre = ($i > 0) ? ', ' : '';
                $cols_vals .= $pre . $key . " = :" . $key;
                $i++;
            }
            $whereSql = '';
            $ci = 0;
            foreach ($conditions as $key => $value) {
                $pre = ($ci > 0) ? ' AND ' : '';
                $whereSql .= $pre . $key . " = :" . $key;
                $ci++;
            }
            $sql = "UPDATE $table SET $cols_vals WHERE $whereSql";
            $stmt = $this->db->prepare($sql);
            foreach ($data as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
            foreach ($conditions as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            return $stmt->execute();
        }
        return false;
    }

    public function delete($table, $conditions) {
        if (!empty($conditions)) {
            $whereSql = '';
            $ci = 0;
            foreach ($conditions as $key => $value) {
                $pre = ($ci > 0) ? ' AND ' : '';
                $whereSql .= $pre . $key . " = :" . $key;
                $ci++;
            }
            $sql = "DELETE FROM $table WHERE $whereSql";
            $stmt = $this->db->prepare($sql);
            foreach ($conditions as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            return $stmt->execute();
        }
        return false;
    }
}
 // ejemplo de uso 



// MySQL Database Connection
$mysqlDb = new Database('mysql', 'db', 'junta', 'root', '');
$mysqlOrm = new ORM($mysqlDb->getConnection());

// SQL Server Database Connection
$sqlsrvDb = new Database('sqlsrv', 'db', 'junta', 'root', '');
$sqlsrvOrm = new ORM($sqlsrvDb->getConnection());

// Insert Example
$data = [
    'nombre' => 'John Doe',
    'email' => 'john.doe@example.com',
    'creado' => date("Y-m-d H:i:s"),
    'modificado' => date("Y-m-d H:i:s")
];
$mysqlOrm->insert('usuarios', $data);
$sqlsrvOrm->insert('usuarios', $data);

// Select Example
$conditions = [
    'select' => '*',
    'where' => ['nombre' => 'John Doe'],
    'return_type' => 'single'
];
$user = $mysqlOrm->select('usuarios', $conditions);
print_r($user);

// Update Example
$updateData = ['email' => 'john.doe@newdomain.com'];
$updateConditions = ['nombre' => 'John Doe'];
$mysqlOrm->update('usuarios', $updateData, $updateConditions);
$sqlsrvOrm->update('usuarios', $updateData, $updateConditions);

// Delete Example
$deleteConditions = ['nombre' => 'John Doe'];
$mysqlOrm->delete('usuarios', $deleteConditions);
$sqlsrvOrm->delete('usuarios', $deleteConditions);

?>
