<?php 

include_once("../views/RegisterDoc.php");

// $data =  array('page'=>'register', "title"=>"Registreren", 'menu'=>["home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT"], );

$data = array("valid"=>false, "values"=> array("user"=> "niet", "email"=>"niet@niet.nl", "pswd"=>"adflkj", "pswd2"=>"aosfgioafiojaoif"), "errors"=> array("user"=> "", "email"=>"", "pswd"=>"", "pswd2"=>"Wachtwoorden komen niet overeen.", "general"=>""), "page"=>"register",  "menu"=>array("home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT"));

$view = new RegisterDoc($data);

$view->show();