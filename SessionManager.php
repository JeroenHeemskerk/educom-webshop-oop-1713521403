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
}