<?php 

include_once("../views/AccountDoc.php");

$data = array("valid"=>false, "values"=> array("email"=>"niet@niet.nl", "pswdOld"=>"adflkj", "pswdNew"=>"aosfgioafiojaoif", "pswdNew2"=>""), "errors"=> array("pswdOld"=>"Wachtwoord onjuist.", "pswdNew"=>"Herhaal alsjeblieft je nieuwe wachtwoord tweemaal.", "general"=>""), "page"=>"changepswd",  "menu"=>array("home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT"));

$view = new AccountDoc($data);

$view->show();