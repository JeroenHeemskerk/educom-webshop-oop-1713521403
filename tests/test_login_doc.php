<?php 

include_once("../views/LoginDoc.php");

$data = array("valid"=>false, "values"=> array("email"=>"ok@ok.nl", "pswd"=>"adflkj"), "errors"=> array("user"=> "", "email"=>"", "pswd"=>"Wachtwoord onjuist", "general"=>""), "page"=>"register",  "menu"=>array("home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT"));

$view = new LoginDoc($data);

$view->show();