<?php
class RatingCRUD {
    private $crud;

    public function __construct(CRUD $crud) {
        $this->crud = $crud;
    }

    public function updateRating($userId, $productId, $rating) {
        $sql = "INSERT INTO users_products (product_id, user_id, rating) VALUES (:product, :user, :rating) ON DUPLICATE KEY UPDATE rating = VALUES(rating);";
        $params = array(":user"=>$userId, ":product"=>$productId, ":rating"=>$rating);
        $this->crud->updateRow($sql, $params);
    }

    public function readAvgRating($product) {
        $sql = "SELECT AVG(rating) as avg_rating FROM users_products WHERE product_id=:product;";
        $params = array(":product"=>$product);
        return $this->crud->readOneRow($sql, $params);
    }

    public function readMultipleAvgRatings() {
        $sql = "SELECT product_id, AVG(rating) as avg_rating FROM users_products GROUP BY product_id;";
        return $this->crud->readMultipleRows($sql, array());
    }
}