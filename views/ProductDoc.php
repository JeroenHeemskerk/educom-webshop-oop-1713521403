<?php 
require "BasicDoc.php";
abstract class ProductDoc extends BasicDoc {
    protected function showActionButton ($action, $processPage, $fromPage, $nextPage, $buttonId, $buttonText, $productId=NULL, $k=NULL) {
            echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="POST">
            <input type="hidden" name="productId" value="' . $productId . '">
            <input type="hidden" name="action" value="' . $action . '">';
            echo '<input type="hidden" name="page" value="' . $processPage . '">';
            echo '<input type="hidden" name="nextPage" value="' . $nextPage . '">';
            echo '<input type="hidden" name="fromPage" value="' . $fromPage . '">';
            echo '<input type="hidden" name="k" value="' . $k . '">';
            echo '<input id="' . $buttonId . '" type="submit" value="' . $buttonText . '">
        </form>';
    }
}