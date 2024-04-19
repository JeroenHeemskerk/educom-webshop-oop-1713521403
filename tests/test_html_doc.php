<?php
  include_once "../views/BasicDoc.php";

  $data = array ( 'page' => 'shop', 'menu' => ["home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT"] );

  $view = new BasicDoc($data);
  $view  -> show();
?>