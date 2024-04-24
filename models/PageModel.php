<?php
require("SessionManager.php");
class PageModel {
    protected $isPost = false;
    public $page;
    public $menu;
    public $title;
    public $errors = array();
    private $sessionManager;

    public function __construct($copy) {
        if (empty($copy)) {
            $this->sessionManager = new SessionManager();
        }
        else {
            // copy constructor
        }

    }

    private function getPostVar($key, $default="", $filter=false) { 
        $value = filter_input(INPUT_POST, $key, $filter | FILTER_SANITIZE_SPECIAL_CHARS); 
    
        return isset($value) ? trim($value) : $default;   
    }

    private function getGetVar($key, $default="") {  
        $value = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);  
         
        return isset($value) ? trim($value) : $default;
    }

    public function getRequestedPage() {
        $this->isPost = ($_SERVER["REQUEST_METHOD"] == "POST");
        if ($this->isPost) {
            $this->page = $this->getPostVar("page");
        }
        else {
            $this->page = $this->getGetVar("page");
        }
    }

    public function createMenu() {
        $this->menu = array("home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT", "shop"=>"WEBSHOP", "topK&top=5"=>"TOP 5");

        if ($this->sessionManager->isUserLoggedIn()) {
            $this->menu["cart"] = 'CART';
            $this->menu["account"] = "ACCOUNT";
            $this->menu["logout"] = 'LOGOUT ' . $this->sessionManager->getLoggedInUserName();
        } 
        else {
            $this->menu["register"] = "REGISTER";
            $this->menu["login"] = "LOGIN";
        }
    }

    public function setTitle() {
        switch ($this->page) {
            case "home":
                $this->title = "Home";
                break;
            case "about":
                $this->title = "Over Mij";
                break;

            default:
                $this->title = "Oeps, daar ging iets mis...";
        }
    }

}