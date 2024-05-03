<?php
require "ProductDoc.php";
class ShopDoc extends ProductDoc {
    protected function showContent() {
        $products = $this->model->products;
        echo '<div class="product-list">';
        foreach($products as $product) {
            echo '<div class="product">';
            echo '<a class="product" href="index.php?page=detail&detail=' . $product->id . '"><div class="product">' . PHP_EOL;
            echo '<h3>' . $product->name . '</h3>' . PHP_EOL;
            echo '<img src="Images/' . $product->fname . '" alt="' . $product->description . '">';
            echo '<p>Prijs: &euro;' . $product->price / 100  . ',-</p>';
            echo '</div></a>' . PHP_EOL;
            
            // code for ratings
            echo '<div class="ratingStars">';
            for ($i = 1; $i <= 5; $i++) {
                echo '<span id="p' . $product->id .'-star-' . $i . '" class="fa">&#xf006;</span>'; 
            }
            echo '</div>';

            if ($this->model->isUserLoggedIn()) {
                $this->showActionButton("addToCart", "shop", "cartAddButton", "Voeg toe aan CART", $product->id);
            }
            echo "</div>";
        }

        echo '</div>';
    }

    protected function showScripts() {
        echo '<script language="JavaScript" type="text/javascript" src="/../jquery-3.7.1.min.js"></script>';
        $products = $this->model->products;
        echo '<script>
        $(document).ready(function() {';
            foreach($products as $product) {
                    echo '$.get("index.php?action=ajax&function=getAvgRating&id=' .  $product->id . '", function(json) {
                        var data = JSON.parse(json);
                        var avgRating = Math.round(data.avg_rating * 2) / 2;
                        showStars(avgRating, ' . $product->id . ');
                    })
                    .fail(function() {
                        // Error callback function
                        console.error("Error occurred while sending the request.");
                    });';
                    echo 'for (var i = 1; i <= 5; i++) {
                        (function(index) {
                            $("#p' . $product->id . '-star-" + index).click(function() {
                                changeStars(index, ' . $product->id .')
                            })
                        })(i)
                    }';
            }
            
            echo 'function showStars(avgRating, productId) {
                for (var i = 1; i <= 5; i++) {
                    var diff = avgRating - i
                    // half a star
                    if (diff == 0.5) {
                        $("#p" + productId + "-star-" + i).addClass("fa").html("&#xf123;")
                    } 
                    // full star
                    else if (diff == 0 || diff >= 1) {
                        $("#p" + productId + "-star-" + i).addClass("fa").html("&#xf005;")
                    }
                    // empty star 
                    else {
                        $("#p" + productId + "-star-" + i).addClass("fa").html("&#xf006;")
                    }
                }
            }
                    
            function changeStars(number, productId) {
                $.get("index.php?action=ajax&function=updateRating&rating=" + number + "&id=" + productId, function(json) {})
                .fail(function() {
                    // Error callback function
                    console.error("Error occurred while sending the request.")
                })
                $.get("index.php?action=ajax&function=getAvgRating&id=" + productId, function(json) {
                    const data = JSON.parse(json)
                    var avgRating = Math.round(data.avg_rating*2)/2
                    showStars(avgRating, productId)
                })
                .fail(function() {
                    // Error callback function
                    console.error("Error occurred while sending the request.")
                })
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
