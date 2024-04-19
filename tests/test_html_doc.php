<?php
  include_once "../views/HtmlDoc.php";

  $data = array ( 'page' => 'shop', "title"=>"Shop", 'menu' => ["home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT"] );

  $view = new HtmlDoc();
  $view  -> show();
?>