<?php 

include_once("../views/AboutDoc.php");

$data =  array('page'=>'about', "title"=>"About", 'menu'=>["home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT"]);

$view = new AboutDoc($data);

$view->show();