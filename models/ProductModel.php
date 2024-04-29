<?php
require_once("PageModel.php");
class ProductModel extends PageModel {
    public $products = array();
    public $cart;
    public $cartTotal;
    public $loggedIn;
    public $k;
    public $crud;

    public function __construct($pageModel, ProductCRUD $crud) {
        PARENT::__construct($pageModel);
        $this->crud = $crud;
    }

    public function getProducts() {
        try {
            $this->products = $this->crud->readAllProducts();
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
                        $this->crud->createOrder($this->cart);
                        $this->sessionManager->emptyCart();
                        $this->cart = $this->sessionManager->getCart();
                        $this->products = array();
                        $this->cartTotal = 0;
                    }
                    catch (Exception $e) {
                        $this->errors["general"] = "Er is een technische storing, u kunt momenteel niet afrekenen. Probeer het later nogmaals.";
                        $this->logError('Purchase failed for ' . $this->sessionManager->getLoggedInEmail() . ', SQLError: ' . $e -> getMessage());
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
        try {
            $this->products = $this->crud->readProductsByIDs([$productId]);
        }
        catch (Exception $e) {
            $this->errors["general"] = "Er is een technische storing. Probeer het later nogmaals.";
            $this->logError("Shop load failed. MySQL err:" . $e->getMessage());
        }
        $this->loggedIn = $this->sessionManager->isUserLoggedIn();
    }

    public function getCartProducts() {
        $this->cart = $this->sessionManager->getCart();

        if (!empty($this->cart)) {
            try {
                $this->products = $this->crud->readProductsByIDs(array_keys($this->cart));
                foreach($this->products as $cartProduct) {
                    $cartProduct->count = $this->cart[$cartProduct->id];
                    $cartProduct->subtotal = $cartProduct->count * $cartProduct->price;
                    $this->cartTotal += $cartProduct->subtotal;
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
        try {
            $this->products = $this->crud->readTopKProducts($this->k);
        }
        catch (Exception $e) {
            $this->errors["general"] = "Er is een technische storing. Probeer het later nogmaals.";
            $this->logError("Shop load failed. MySQL err:" . $e->getMessage());
        }
        $this->loggedIn = $this->sessionManager->isUserLoggedIn();
    }

}