<?php
require "ProductDoc.php";
class DetailDoc extends ProductDoc {
    protected function showContent() {
        $id = array_keys($this->model->products)[0];
        $product = $this->model->products[$id];
        var_dump($this->model->products);
    
        echo '<div class="detail">';
        echo '<h2>' . $product["name"] . '</h2>';
        echo '<img src="Images/' . $product["fname"] . '" alt="' . $product["description"] . '">';
        echo '<div class="detail-info">';
        echo '<h4>' . $product["name"] . '</h4>';
        echo '<p>' . $product["description"] . '<br><b>Prijs</b>: &euro;' . $product["price"] / 100 . '</p>';
    
        if ($this->model->loggedIn) {
            $this->showActionButton("addToCart", "detail", "cartAddButton", "Voeg toe aan CART", $id);
        }
        echo '</div>';
        echo '</div>';
    }
}