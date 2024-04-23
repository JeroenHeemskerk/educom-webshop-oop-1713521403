<?php
require "ProductDoc.php";
class DetailDoc extends ProductDoc {
    protected function showContent() {
        $id = $this->data["productId"];
        $product = $this->data["products"][$id];
    
        echo '<div class="detail">';
        echo '<h2>' . $product["name"] . '</h2>';
        echo '<img src="Images/' . $product["fname"] . '" alt="' . $product["description"] . '">';
        echo '<div class="detail-info">';
        echo '<h4>' . $product["name"] . '</h4>';
        echo '<p>' . $product["description"] . '<br><b>Prijs</b>: &euro;' . $product["price"] / 100 . '</p>';
    
        if ($this->data["loggedIn"]) {
            $this->showActionButton("addToCart", "cart", "cartAddButton", "Voeg toe aan CART", $id);
        }
        echo '</div>';
        echo '</div>';
    }
}