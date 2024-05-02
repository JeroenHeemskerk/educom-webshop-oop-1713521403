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

    protected function showScripts() {
        $product = $this->model->products[0];
        echo '<script>
        $(document).ready(function() {
            function changeStars(number) {
                for (var i = 1; i <= number; i++) {
                    $("#star-" + i).html("&starf;");
                }
                $.get("index.php?action=ajax&function=updateRating&rating=number&id=' . $product->id .')
            }

            for (var i = 1; i <= 5; i++) {
                (function(index) {
                    $("#star-" + index).click(function() {
                        changeStars(index);
                    });
                })(i);
            }
  
        })
      </script>';
    }

    protected function showStyleLinks() {
        // dit werkt nu niet meer als ik het test vanuit tests/
        echo '<link rel="stylesheet" type="text/css" href="css/styles.css">';
        echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather|Open+Sans">';
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
    }
    
}