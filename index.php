<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
$page = getRequestedPage();
$data = processRequest($page);
showPage($data);

function getRequestedPage() {
    $request_type = $_SERVER['REQUEST_METHOD'];
    if ($request_type == "POST") {
        $request_page = getPostVar("page");
    }
    else {
        $request_page = getGetVar("page");
    }
    return $request_page;
}

function getGetVar($key, $default="") {  
    $value = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);  
     
    return isset($value) ? trim($value) : $default;
}

function getPostVar($key, $default="", $filter=false) { 
    $value = filter_input(INPUT_POST, $key, $filter | FILTER_SANITIZE_SPECIAL_CHARS); 

    return isset($value) ? trim($value) : $default;   
}

function processRequest($page) {
    $data = processPage($page);

    // get the corresponding title
    $data["title"] = getTitle($data);

    // Build the dynamic navigation bar
    $data["menu"] = buildMenu();
    return $data;

}

function processPage($page) {
    // returns errors and asked values + applies rerouting
    switch ($page) {
        case "contact":
            include_once('contact.php');
            $data = validateContact();
            if ($data["valid"]) {
                $data["page"] = "thanks";
            }
            else {
                $data["page"] = $page;
                
            }
            return $data;

        case "login":
            include_once('login.php');
            $data = validateLogin();
            if ($data["valid"]) {
                include_once('session_manager.php');
                doLoginUser($data["values"]);
                $data["page"] = "home";
            }
            else {
                $data["page"] = $page;
            }
            return $data;

        case "logout":
            include_once('session_manager.php');
            doLogoutUser();
            return ["page"=>"home"];

        case "account":
            include_once('changepswd.php');
            try {
                $data = validateChangePswd();
            }
            catch (Exception $e) {
                $data = ["valid"=>false, "errors"=>""];
                $data["errors"]["general"] = "Er is een technische storing, u kunt niet uw wachtwoord wijzigen. Probeer het later nogmaals.";
                logError('Password change failed for user ' . getLoggedInEmail() . ', SQLError: ' . $e -> getMessage());
            }
            if ($data["valid"]) {
                $data["page"] ="home";
            }
            else {
                $data["page"] = $page;
            }
            return $data;

        case "register":
            include_once('register.php');
            $data = validateRegister();
            if ($data["valid"]) {
                try {
                    addAccount($data["values"]);
                    $data["page"] = "home";
                }
                catch (Exception $e) {
                    $data["errors"] = array();
                    $data["errors"]["general"] = "Er is een technische storing, u kunt niet registreren. Probeer het later nogmaals.";
                    logError('Registration failed for user ' . $data["values"]['email'] . ', SQLError: ' . $e -> getMessage());
                    $data["page"] = $page;
                }                
            }
            else {
                $data["page"] = $page;
            }
            return $data;

        case "shop":
            $top = getGetVar("top");
            include_once('communication.php');
            if (empty($top)) {
                try {
                    $data = getProducts();
                    $data["page"] = $page;
                }
                catch (Exception $e) {
                    $errors["general"] = "Er is een technische storing, de webshop kan niet worden geladen. Probeer het later nogmaals.";
                    logError('Shop load failed SQLError: ' . $e -> getMessage());
                    $data = ["errors" => $errors, "products"=>array()];
                }
            }
            else {
                try {
                    $data = getTopKProducts($top);
                }
                catch (Exception $e) {
                    $errors["general"] = "Er is een technische storing, de webshop kan niet worden geladen. Probeer het later nogmaals.";
                    logError('Shop load failed SQLError: ' . $e -> getMessage());
                    $data = ["errors" => $errors, "products"=>array()];
                }
            }

            $data["page"] = $page;
            return $data;

        case "detail":
            $productId = getGetVar("detail", 0);
            include_once "communication.php";
            include_once("session_manager.php");
            try {
                $data = getProductsByIDs([$productId]);
                $data["productId"] = $productId;
                $data["page"] = "detail";
                $data["loggedIn"] = isUserLoggedIn();
                return $data;
            }
            catch (Exception $e) {
                $errors["general"] = "Er is een technische storing, de webshop kan niet worden geladen. Probeer het later nogmaals.";
                logError('Shop item load failed for ' . $productId . ' SQLError: ' . $e -> getMessage());
                $data = ["errors" => $errors];
            }

        case "cart":
            $action = getPostVar('action');
            $id = getPostVar('productId');
            include_once('cart.php');
            // some cart actions don't require an id
            if (empty($action)) {
                try {
                    $data = getCartProducts();
                    $data["page"] = $page;
                }

                catch (Exception $e) {
                    $data["errors"] = array();
                    $data["errors"]["general"] = "Er is een technische storing, u kunt uw winkelmand niet inzien. Probeer het later nogmaals.";
                    logError('Failed cart load SQLError: ' . $e -> getMessage());
                    $data["page"] = "home";
                }
                return $data;
            }

            return handleCartAction($action, $id);

        default:
            return ["page"=>$page];
    }
}

function getTitle($data) {
    $page = $data["page"];
    switch ($page) {
        case "thanks":
            return "Bedankt voor je feedback!";
        case "contact":
            return "Contact";
        case "home":
            return "Home";
        case "about":
            return "Over Mij";
        case "shop":
            return "Florian's Webshop";
        case "cart":
            return "Winkelmandje";
        case "register":
            return "Registratie";
        case "login":
            return "Login";
        case "account":
            include_once("session_manager.php");
            return "Account van " . getLoggedInUserName();
        case "detail":
            return $data["products"][$data["productId"]]["name"];
        default:
            return "Oeps, daar ging iets mis...";
    }
    
    
}

function buildMenu() {
    $menu = array("home"=>"HOME", "about"=>"ABOUT", "contact"=>"CONTACT", "shop"=>"WEBSHOP", "shop&top=5"=>"TOP 5");
    include_once('session_manager.php');
    if (isUserLoggedIn()) {
        $menu["cart"] = 'CART';
        $menu["account"] = "ACCOUNT";
        $menu["logout"] = 'LOGOUT ' . getLoggedInUserName();
    } 
    else {
        $menu["register"] = "REGISTER";
        $menu["login"] = "LOGIN";
    }
    return $menu;
}


function logError($msg) {
    echo "LOGGING TO THE SERVER: " . $msg;
}

function showPage($data) {
    $page = $data["page"];
    $view = NULL;
    switch($page) {
        default:
            include_once("views/Error404Doc.php");
            $view = new Error404Doc($data);
            break;

        case "home":
            include_once("views/HomeDoc.php");
            $view = new HomeDoc($data);
            break;

        case "about":
            include_once("views/AboutDoc.php");
            $view = new AboutDoc($data);
            break;

        case "contact":
            include_once("views/ContactDoc.php");
            $view = new ContactDoc($data);
            break;

        case "thanks":
            include_once("views/ThanksDoc.php");
            $view = new ThanksDoc($data);
            break;

        case "login":
            include_once("views/LoginDoc.php");
            $view = new LoginDoc($data);
            break;

        case "register":
            include_once("views/RegisterDoc.php");
            $view = new RegisterDoc($data);
            break;

        case "account":
            include_once("views/AccountDoc.php");
            $view = new AccountDoc($data);
            break;

        case "shop":
            include_once("views/ShopDoc.php");
            $view = new ShopDoc($data);
            break;

        case "detail":
            include_once("views/DetailDoc.php");
            $view = new DetailDoc($data);
            break;

        case "cart":
            include_once("views/CartDoc.php");
            $view = new CartDoc($data);
            break;
    }

    $view->show();
}
