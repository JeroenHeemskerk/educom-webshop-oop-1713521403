<?php
require("ProductDoc.php");
class CartDoc extends ProductDoc {
    protected function showContent() {
        echo '<h2>Winkelmandje</h2>';

        $products = $this->data["products"];
        foreach($products as $product) {
            echo '<a class="cart-list" href="index.php?page=shop&detail=' . $product["id"] . '">';
            echo '<div>';
            echo '<img src=../Images/' . $product["fname"] . '>';
            echo '<p>Aantal: ' . $product["count"] . '<br>';
            echo 'Prijs: &euro;' . $product["subtotal"] . ',-<br>';
            echo '</p>';
            echo '</div></a>';
        }
        echo '<p id="total-cart">Totaal: &euro;' . $this->data["total"] . ',-</p>';
        include_once('../session_manager.php');
        if (!empty(getCart())) {
            $this->showActionButton("purchase", "cart", "purchaseButton", "Afrekenen");
        }
    }
}