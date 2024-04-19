<?php
  include_once "../views/BasicDoc.php";

  $data = array ( 'page' => 'shop', "title"=>"Titelpagina", 'menu' => ["home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT"] );

  $view = new BasicDoc($data);
  $view  -> show();
?>