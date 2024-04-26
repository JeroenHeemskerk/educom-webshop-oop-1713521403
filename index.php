<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
require_once("controllers/PageController.php");
require_once("CRUDFactory.php");
require_once("CRUD.php");
require_once("ModelFactory.php");

// Ik dacht dat de CRUDFactory de CRUDs moest maken? 
$crud = new CRUD();
$crudFactory = new CRUDFactory($crud);
$modelFactory = new ModelFactory($crudFactory);
$controller = new PageController($modelFactory);
$controller->handleRequest();    
