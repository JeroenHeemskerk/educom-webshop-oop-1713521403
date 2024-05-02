<?php
require "ProductDoc.php";
class DetailDoc extends ProductDoc {
    protected function showContent() {
        $product = $this->model->products[0];
    
        echo '<div class="detail">';
        echo '<h2>' . $product->name . '</h2>';
        echo '<img src="Images/' . $product->fname . '" alt="' . $product->description . '">';
        echo '<div class="detail-info">';
        echo '<h4>' . $product->name . '</h4>';
        echo '<p>' . $product->description . '<br><b>Prijs</b>: &euro;' . $product->price / 100 . '<br> Gemiddelde rating: </p>';
    
        // code for ratings
        echo '<div class="ratingStars">';
        for ($i = 1; $i <= 5; $i++) {
            echo '<span id="star-' . $i . '">&star;</span>'; 
        }
        echo '</div>';
    
        if ($this->model->isUserLoggedIn()) {
            $this->showActionButton("addToCart", "detail", "cartAddButton", "Voeg toe aan CART", $product->id);
        }
        echo '</div>';
        echo '</div>';
    }
    
}