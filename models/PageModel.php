<?php
require_once("SessionManager.php");
require_once("views/MenuItem.php");
class PageModel {
    protected $isPost = false;
    public $page;
    public $menu;
    public $title;
    public $errors = array();
    protected $sessionManager;

    public function __construct($copy) {
        if (empty($copy)) {
            $this->sessionManager = new SessionManager();
        }
        else {
            // copy constructor
            $this->isPost = $copy->isPost;
            $this->page = $copy->page;
            $this->menu = $copy->menu;
            $this->title = $copy->title;
            $this->errors = $copy->errors;
            $this->sessionManager = $copy->sessionManager;
        }

    }

    protected function getPostVar($key, $default="", $filter=false) { 
        $value = filter_input(INPUT_POST, $key, $filter | FILTER_SANITIZE_SPECIAL_CHARS); 
    
        return isset($value) ? trim($value) : $default;   
    }

    protected function getGetVar($key, $default="") {  
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
        // $this->menu = array("home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT", "shop"=>"WEBSHOP", "topK&top=5"=>"TOP 5");
        $this->menu["home"] = new MenuItem("home", "HOME");
        $this->menu["about"] = new MenuItem("about", "ABOUT");
        $this->menu["contact"] = new MenuItem("contact", "CONTACT");
        $this->menu["shop"] = new MenuItem("shop", "WEBSHOP");
        $this->menu["topK"] = new MenuItem("topK&top=5", "TOP 5");

        if ($this->sessionManager->isUserLoggedIn()) {
            $this->menu["cart"] = new MenuItem("cart", "CART");
            $this->menu["account"] = new MenuItem("account", "ACCOUNT");
            $this->menu["logout"] = new MenuItem("logout", "LOGOUT ",  $this->sessionManager->getLoggedInUserName());
        } 
        else {
            $this->menu["register"] = new MenuItem("register", "REGISTER");
            $this->menu["login"] = new MenuItem("login", "LOGIN");
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
            case "login":
                $this->title = "Login";
                break;
            case "register":
                $this->title = "Registreren";
                break;
            case "account":
                $this->title = "Account";
                break;
            case "contact":
                $this->title = "Contact";
                break;
            case "thanks":
                $this->title = "Bedankt voor het invullen!";
                break;
            case "shop":
                $this->title = "Florian's Rariteitenkabinet";
                break;
            case "cart":
                $this->title = "Winkelmand";
                break;
            case "detail":
                $this->title = "Productpagina";
                break;
            case "topK":
                $this->title = "Populairse Rariteiten";
                break;

            default:
                $this->title = "Oeps, daar ging iets mis...";
        }
    }

    protected function LogError($e) {
        echo $e;
    }

}