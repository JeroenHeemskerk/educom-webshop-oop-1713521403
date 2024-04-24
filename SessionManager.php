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
        return getSessionVar('userName');
    }
}