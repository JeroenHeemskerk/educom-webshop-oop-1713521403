<?php 
require "ProductDoc.php";
class TopKDoc extends ProductDoc {
    protected function showContent() {
        $products = $this->model->products;
        echo '<div class="product-list">';
        foreach($products as $id=>$product) {
            echo '<div class="product">';
            echo '<a class="product" href="index.php?page=detail&detail=' . $id . '"><div class="product">' . PHP_EOL;
            echo '<h3>' . $product["name"] . '</h3>' . PHP_EOL;
            echo '<img src="Images/' . $product["fname"] . '" alt="' . $product["description"] . '">';
            echo '<p>Prijs: &euro;' . $product["price"] / 100  . ',-</p>';
            echo '</div></a>' . PHP_EOL;
            
            if ($this->model->loggedIn) {
                $this->showActionButton("addToCart", "topK", "cartAddButton", "Voeg toe aan CART", $id, $this->model->k);
            }
            echo "</div>";
        }

        echo '</div>';
        
    }
}