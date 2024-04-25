<?php
class SessionManager {
    private function getSessionVar($key, $default="") {
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        
        return $default;
    }

    public function isUserLoggedIn() {
        return !empty($this->getSessionVar('email')); 
    }

    public function getLoggedInUserName() { 
        return $this->getSessionVar('userName');
    }

    public function doLoginUser($values) {
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        $_SESSION["email"] = $values["email"];
        $_SESSION["userName"] = $values["userName"];
        $_SESSION["userId"] = $values["userId"]; 
        $_SESSION["cart"] = array();
    }

    public function doLogoutUser() {
        session_unset();
        session_destroy();
    }

    public function getLoggedInEmail() {
        return getSessionVar('email');
    }
    
    public function addToCart($id) {
        if (!array_key_exists($id, $_SESSION["cart"])) {
            $_SESSION["cart"][$id] = 1;
        }
        else {
            $_SESSION["cart"][$id]++;
        }
    }

}