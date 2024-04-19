<?php
  include_once "../views/HomeDoc.php";

  $data = array ('page'=>'home', "title"=>"Home", 'menu' => ["home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT"] );

  $view = new HomeDoc($data);
  $view  -> show();
?>