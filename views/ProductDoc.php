<?php 
require "BasicDoc.php";
abstract class ProductDoc extends BasicDoc {
    protected function showActionButton ($action, $processPage, $buttonId, $buttonText, $productId=NULL, $k=NULL) {
            echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="POST">';
            if ($productId) {echo '<input type="hidden" name="productId" value="' . $productId . '">';}
            if ($k) {echo '<input type="hidden" name="k" value="' . $k . '">';}
            echo '<input type="hidden" name="action" value="' . $action . '">';
            echo '<input type="hidden" name="page" value="' . $processPage . '">';
            echo '<input id="' . $buttonId . '" type="submit" value="' . $buttonText . '">
        </form>';
    }
}