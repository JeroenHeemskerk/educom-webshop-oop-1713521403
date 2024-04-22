<?php

include_once "../views/ShopDoc.php";
$data = [
    "products" => [
        1 => [
            "id" => "1",
            "name" => "Origami Dwergspaniël",
            "description" => "Een Dwergspaniël gevouwen van 15x15cm origami papier. Ontwerp door Jun Maekawa.",
            "price" => "20",
            "fname" => "origamihond.jpg"
        ],
        2 => [
            "id" => "2",
            "name" => "Origami Wild Zwijn",
            "description" => "Een Wild Zwijn gevouwen van 24x24cm origami papier. Ontwerp door Jun Maekawa.",
            "price" => "15",
            "fname" => "origamizwijn.jpg"
        ],
        3 => [
            "id" => "3",
            "name" => "Fidgetspinner",
            "description" => "Oranje fidgetspinner met kogellagers.",
            "price" => "2",
            "fname" => "fidgetspinner.jpg"
        ],
        4 => [
            "id" => "4",
            "name" => "Stuiterei",
            "description" => "Stuiterei gemaakt van rubber.",
            "price" => "2.5",
            "fname" => "stuiterei.jpg"
        ],
        5 => [
            "id" => "5",
            "name" => "Mini Kendama",
            "description" => "Een Japanse kendama ter grootte van een fietsventiel.",
            "price" => "3.75",
            "fname" => "minikendama.jpg"
        ]
    ],
    "page" => "shop",
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

$view = new ShopDoc($data);
$view->show();
