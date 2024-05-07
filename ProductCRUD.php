<?php
class ProductCRUD {
    private $crud;

    public function __construct(CRUD $crud) {
        $this->crud = $crud;
    }

    public function readAllProducts() {
        $sql = "SELECT * FROM products";
        $params = array();
        $rows = $this->crud->readMultipleRows($sql, $params);
        return $rows;
    }

    public function readProductsByIDs($ids) {
        $namedParams = "";
        $params = array();
        for($i=0; $i < count($ids); $i++) {
            $namedParams .= ":id" . $i . ",";
            $params[":id" . $i] = $ids[$i];
        }
        // replace trailing comma with closing bracket
        $namedParams[-1] = ")";
        $sql = 'SELECT * FROM products WHERE id IN (' . $namedParams . ';';
        $rows = $this->crud->readMultipleRows($sql, $params);
        return $rows;
    }
    public function readTopKProducts($k) {
        $sql = "SELECT p.*, SUM(op.quantity) as total_sold FROM orders_products as op
        RIGHT JOIN products as p ON op.product_id = p.id
        LEFT JOIN orders as o ON op.order_id = o.id
        WHERE o.order_date > DATE_SUB(date(CURRENT_DATE), INTERVAL 7 DAY) OR o.order_date IS NULL
        GROUP BY p.id
        ORDER BY total_sold DESC
        LIMIT :K;";
    
        $params = array(":K"=>intval($k));
        $rows = $this->crud->readMultipleRows($sql, $params);
        return $rows;
    }

    function createOrder($cart) {
        // meesturen of zelf opvragen?
        include_once('SessionManager.php');
        $sessionManager = new SessionManager();

        // default of date col is current date
        $sql = "INSERT INTO orders (user_id) VALUES (:userId);";
        $params = array(":userId"=>$sessionManager->getLoggedInUserId());
        $insertId = $this->crud->createRow($sql, $params);

        $sql = "INSERT INTO orders_products (order_id, product_id, quantity) VALUES ";
        $params = array(":insertId"=>$insertId);
        foreach($cart as $productId=>$qty) {
            $sql .= "(:insertId, :productId" . $productId . ", :qty" . $productId . "),";
            $params[":productId" . $productId] = $productId;
            $params[":qty" . $productId] = $qty;
        }
        // replace trailing comma with semicolon
        $sql[-1] = ";";
        $this->crud->createRow($sql, $params);
    }
}