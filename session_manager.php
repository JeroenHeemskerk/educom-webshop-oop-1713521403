<?php 

function getSessionVar($key, $default="") {
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }
    
    return $default;
}

function isUserLoggedIn() {
    return !empty(getSessionVar('email')); 
}

function doLoginUser($values) {
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    $_SESSION["email"] = $values["email"];
    $_SESSION["userName"] = $values["userName"];
    $_SESSION["userId"] = $values["userId"]; 
    $_SESSION["cart"] = array();
}

function doLogoutUser() {
    session_unset();
    session_destroy();
}
 
function getLoggedInEmail() {
    return getSessionVar('email');
}

function getLoggedInUserName() { 
    return getSessionVar('userName');
}

function getLoggedInUserId() {
    return getSessionVar('userId');
}

function getCart() {
    return getSessionVar("cart", array());
}

function emptyCart() {
    $_SESSION["cart"] = array();
}

function addToCart($id) {
    if (!array_key_exists($id, $_SESSION["cart"])) {
        $_SESSION["cart"][$id] = 1;
    }
    else {
        $_SESSION["cart"][$id]++;
    }
}
