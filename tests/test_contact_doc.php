<?php 

include_once("../views/ContactDoc.php");

$data = [
    "valid" => false,
    "values" => [
        "gender" => "dhr",
        "name" => "",
        "email" => "",
        "phone" => "",
        "street" => "",
        "housenumber" => "",
        "additive" => "",
        "postalcode" => "",
        "municip" => "",
        "msg" => "",
        "comm" => ""
    ],
    "errors" => [
        "gender" => "",
        "name" => "Vul alsjeblieft je volledige naam in.",
        "msg" => "Vul alsjeblieft een bericht in.",
        "comm" => "Vul alsjeblieft je communicatievoorkeur in.",
        "email" => "",
        "phone" => "",
        "street" => "",
        "housenumber" => "",
        "postalcode" => "",
        "municip" => ""
    ],
    "page" => "contact",
    "menu" => [
        "home" => "HOME",
        "about" => "ABOUT",
        "contact" => "CONTACT",
        "shop" => "WEBSHOP"
    ]
];

$view = new ContactDoc($data);

$view->show();