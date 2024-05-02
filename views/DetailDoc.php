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
        echo '<script language="JavaScript" type="text/javascript" src="/../jquery-3.7.1.min.js"></script>';
        $product = $this->model->products[0];
        echo '<script>
        $(document).ready(function() {
            $.get("index.php?action=ajax&function=getAvgRating&id=' . $product->id .'", function(json) {
                const data = JSON.parse(json)
                var avgRating = Math.round(data.avg_rating*2)/2
                showStars(avgRating)
                
            })
            .fail(function() {
                // Error callback function
                console.error("Error occurred while sending the request.")
            })

            function showStars(avgRating) {
                for (var i = 1; i <= 5; i++) {
                    const diff = avgRating - i
                    if (diff == 0.5) {
                        $("#star-" + i).addClass("fa").html("&#xf123;")
                    } else if (diff == 0 || diff >= 1) {
                        $("#star-" + i).addClass("fa").html("&#xf005;")
                    } else {
                        $("#star-" + i).addClass("fa").html("&#xf006;")
                    }
                }
            }
                    
            function changeStars(number) {
                $.get("index.php?action=ajax&function=updateRating&rating=" + number + "&id=' . $product->id .'", function(json) {})
                .fail(function() {
                    // Error callback function
                    console.error("Error occurred while sending the request.")
                })
                $.get("index.php?action=ajax&function=getAvgRating&id=' . $product->id .'", function(json) {
                    const data = JSON.parse(json)
                    var avgRating = Math.round(data.avg_rating*2)/2
                    showStars(avgRating)
                    
                })
                .fail(function() {
                    // Error callback function
                    console.error("Error occurred while sending the request.")
                })
            }
        
            for (var i = 1; i <= 5; i++) {
                (function(index) {
                    $("#star-" + index).click(function() {
                        changeStars(index)
                    })
                })(i)
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