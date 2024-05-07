<?php
class CRUD {
    private $pdo;

    public function __construct() {
        $servername = getenv("MYSQL_FLORIAN_WEBSHOP_HOST"); 
        $dbname = getenv("MYSQL_FLORIAN_WEBSHOP_DATABASE"); 
        $username = getenv("MYSQL_FLORIAN_WEBSHOP_USER"); 
        $password = getenv("MYSQL_FLORIAN_WEBSHOP_PASSWORD");
        $port = getenv('MYSQL_SERVER_PORT');
        $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);

        // set the PDO error mode to exception
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        $stmt = $this->pdo->prepare($sql);

        $this->bindParams($stmt, $params);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function readOneRow($sql, $params) {
        $stmt = $this->pdo->prepare($sql);

        $this->bindParams($stmt, $params);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $row = $stmt->fetch();
        return $row;
    }

    public function readMultipleRows($sql, $params) {
        $stmt = $this->pdo->prepare($sql);

        $this->bindParams($stmt, $params);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public function updateRow($sql, $params) {
        $stmt = $this->pdo->prepare($sql);

        $this->bindParams($stmt, $params);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}