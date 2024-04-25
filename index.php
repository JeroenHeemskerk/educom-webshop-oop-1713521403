<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
require_once("controllers/PageController.php");

$controller = new PageController();
$controller -> handleRequest();
