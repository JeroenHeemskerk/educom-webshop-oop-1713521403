<?php 
include("../views/CartDoc.php");

$data = [
    "products" => [
        4 => [
            "id" => 4,
            "count" => 1,
            "name" => "Stuiterei",
            "description" => "Stuiterei gemaakt van rubber.",
            "fname" => "stuiterei.jpg",
            "price" => "2.5",
            "subtotal" => 2.5
        ]
    ],
    "total" => 2.5,
    "page" => "cart",
    "menu" => [
        "home" => "HOME",
        "about" => "ABOUT",
        "contact" => "CONTACT",
        "shop" => "WEBSHOP",
        "shop&top=5" => "TOP 5",
        "cart" => "CART",
        "changepswd" => "ACCOUNT",
        "logout" => "LOGOUT ok"
    ]
];

$view = new CartDoc($data);
$view->show();
