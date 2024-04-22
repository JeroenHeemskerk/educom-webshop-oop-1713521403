<?php
require "ProductDoc.php";
class ShopDoc extends ProductDoc {
    protected function showContent() {
        if (empty($this->data["products"])) {
            echo "";
        }
        else if (empty($this->data["productId"])) {
            $this->showWebshopProducts();
        }
        else {
            $this->showProductContent();
        }
    }

    private function showWebshopProducts() {
        $products = $this->data["products"];
        echo '<div class="product-list">';
        foreach($products as $id=>$product) {
            echo '<a class="product" href="index.php?page=shop&detail=' . $id . '"><div class="product">' . PHP_EOL;
            echo '<h3>' . $product["name"] . '</h3>' . PHP_EOL;
            echo '<img src="../Images/' . $product["fname"] . '" alt="' . $product["description"] . '">';
            echo '<p>Prijs: &euro;' . $product["price"]  . ',-</p>';
            echo '</div></a>' . PHP_EOL;
        }
        echo '</div>';
    }

    private function showProductContent() {
        $id = $this->data["productId"];
        $product = $this->data["products"][$id];
    
        echo '<div class="detail">';
        echo '<h2>' . $product["name"] . '</h2>';
        echo '<img src="../Images/' . $product["fname"] . '" alt="' . $product["description"] . '">';
        echo '<div class="detail-info">';
        echo '<h4>' . $product["name"] . '</h4>';
        echo '<p>' . $product["description"] . '<br><b>Prijs</b>: &euro;' . $product["price"] . '</p>';
    
        // dit misschien verplaatsen naar $data
        include_once("../session_manager.php");
        if (isUserLoggedIn()) {
            $this->showActionButton("addToCart", "cart", "cartAddButton", "Voeg toe aan CART", $id);
        }
        echo '</div>';
        echo '</div>';
    }
}