<?php
class CRUD {
    private $pdo;

    public function __construct() {
        $servername = getenv("MYSQL_FLORIAN_WEBSHOP_HOST"); 
        $dbname = getenv("MYSQL_FLORIAN_WEBSHOP_DATABASE"); 
        $username = getenv("MYSQL_FLORIAN_WEBSHOP_USER"); 
        $password = getenv("MYSQL_FLORIAN_WEBSHOP_PASSWORD");
        $port = getenv('MYSQL_SERVER_PORT');
        try {
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);

            // set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    
        catch(PDOException $e) {
            echo "Connection failed:" .  $e->getMessage();
        }
    }

    private function bindParams($stmt, $params) {
        foreach($params as $varName=>$value) {
            if (is_int($value)) {
                $stmt->bindValue($varName, $value, PDO::PARAM_INT);
            }
            else {
                $stmt->bindValue($varName, $value);
            }
        }
    }

    public function createRow($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);

            $this->bindParams($stmt, $params);
    
            $stmt->execute();
    
            return $this->pdo->lastInsertId();
        }
        catch (PDOException $e) {
            echo "Insertion failed: " . $e->getMessage();
        }
    }

    public function readOneRow($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);

            $this->bindParams($stmt, $params);

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $row = $stmt->fetch();
            return $row;
        }
        catch (PDOException $e) {
            echo "Retrieval failed: " . $e->getMessage();
        }
    }

    public function readMultipleRows($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);

            $this->bindParams($stmt, $params);

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $rows = $stmt->fetchAll();
            return $rows;
        }
        catch (PDOException $e) {
            echo "Retrieval failed: " . $e->getMessage();
        }
    }

    public function updateRow($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);

            $this->bindParams($stmt, $params);
    
            $stmt->execute();
    
            return $this->pdo->lastInsertId();
        }
        catch (PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }
}