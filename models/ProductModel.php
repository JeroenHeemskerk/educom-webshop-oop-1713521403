<?php
require_once("PageModel.php");
class ProductModel extends PageModel {
    public $products;
    public $cart;
    public $cartTotal;
    public $loggedIn;

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
            $this->logError("Shop load failed. MySQL err:" . $e);
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
            }
        }
    }

}