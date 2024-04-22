<?php 
require "BasicDoc.php";
abstract class ProductDoc extends BasicDoc {
    protected function showActionButton ($action, $page, $buttonId, $buttonText, $productId=NULL) {
            echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="POST">
            <input type="hidden" name="productId" value="' . $productId . '">
            <input type="hidden" name="action" value="' . $action . '">';
            echo '<input type="hidden" name="page" value="' . $page . '">';
            echo '<input id="' . $buttonId . '" type="submit" value="' . $buttonText . '">
        </form>';
    }
}