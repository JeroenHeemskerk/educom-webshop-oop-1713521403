<?php
require_once("PageModel.php");
class ProductModel extends PageModel {
    public $products = array();
    public $cart;
    public $cartTotal;
    public $loggedIn;
    public $k;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
    }

    public function getProducts() {
        include_once(__DIR__ . "/../communication.php");
        try {
            $this->products = getProducts();
        }
        catch (Exception $e) {
            $this->errors["general"] = "Er is een technische storing. Probeer het later nogmaals.";
            $this->logError("Shop load failed. MySQL err:" . $e->getMessage());
        }
        $this->loggedIn = $this->sessionManager->isUserLoggedIn();
    }

    public function handleCartAction() {
        if ($this->isPost) {
            $action = $this->getPostVar("action");
            $id = $this->getPostVar("productId");
            switch ($action) {
                case "addToCart":
                    $this->sessionManager->addToCart($id);
                    break;
                case "purchase":
                    try {
                        include_once(__DIR__ . "/../communication.php");
                        addOrder($this->cart);
                        $this->sessionManager->emptyCart();
                        $this->cart = $this->sessionManager->getCart();
                        $this->products = array();
                        $this->cartTotal = 0;
                    }
                    catch (Exception $e) {
                        $this->errors["general"] = "Er is een technische storing, u kunt momenteel niet afrekenen. Probeer het later nogmaals.";
                        logError('Purchase failed for ' . $this->sessionManager->getLoggedInEmail() . ', SQLError: ' . $e -> getMessage());
                    }
                    break;
            }
        }
    }

    public function getDetailProduct() {
        if ($this->isPost) {
            $productId = $this->getPostVar("productId");
        }
        else {
           $productId = $this->getGetVar("detail");
        }
        include_once(__DIR__ . "/../communication.php");
        try {
            $this->products = getProductsByIDs([$productId]);
        }
        catch (Exception $e) {
            $this->errors["general"] = "Er is een technische storing. Probeer het later nogmaals.";
            $this->logError("Shop load failed. MySQL err:" . $e->getMessage());
        }
        $this->loggedIn = $this->sessionManager->isUserLoggedIn();
    }

    public function getCartProducts() {
        $this->cart = $this->sessionManager->getCart();

        include_once(__DIR__ . "\..\communication.php");
        if (!empty($this->cart)) {
            try {
                $cartProducts = getProductsByIDs(array_keys($this->cart));
                
                foreach($this->cart as $productId => $count) {
                    // second filter on id, but looping simultaneously is too much of a hassle
                    $cartProduct = $cartProducts[$productId];
                    $this->products[$productId] = array("id"=>$productId, "count"=>$count, "name"=>$cartProduct['name'], "description"=>$cartProduct['description'], "fname"=>$cartProduct['fname'], "price"=>$cartProduct['price']);
                    
                    $subtotal = $cartProduct["price"] * $count;
                    $this->products[$productId]["subtotal"] = $subtotal;
                    $this->cartTotal += $subtotal;
                }
            }
            catch (Exception $e) {
                $this->errors["general"] = "Er is een technische storing. Probeer later nogmaals uw winkelmand in te zien.";
                $this->LogError("Product load failed" . $e);
            }    
        }
    }

    public function getTopKProducts() {
        if ($this->isPost) {
            $this->k = $this->getPostVar("k");
        }
        else {
            $this->k = $this->getGetVar("top");
        }
        include_once(__DIR__ . "/../communication.php");
        try {
            $this->products = getTopKProducts($this->k);
        }
        catch (Exception $e) {
            $this->errors["general"] = "Er is een technische storing. Probeer het later nogmaals.";
            $this->logError("Shop load failed. MySQL err:" . $e->getMessage());
        }
        $this->loggedIn = $this->sessionManager->isUserLoggedIn();
    }

}