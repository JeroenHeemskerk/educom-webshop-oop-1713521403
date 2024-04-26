<?php
include_once("../CRUD.php");

$crud = new CRUD();

$sql =  "SELECT * FROM orders_products WHERE product_id=:product_id;";
$params = array(":product_id"=>2);

var_dump($crud->readMultipleRows($sql, $params));
