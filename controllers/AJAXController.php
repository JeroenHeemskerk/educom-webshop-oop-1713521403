<?php
class AJAXController {
    public $model;
    public $crud;

    public function __construct(PageModel $model) {
        $this->model = $model;

        // $crudfactory = new CRUDFactory;
        // $this->crud = $crudfactory->createCrud('rating');
    }

    public function processRequest() {
        $function = $this->model->getGetVar("function");
        switch($function) {
            case "getAvgRating":
                $productId = $this->model->getGetVar("id");
                $this->crud->readAvgRating($productId);
                break;
            case "updateRating":
                $productId = $this->model->getGetVar("id");
                $rating = $this->model->getGetVar("rating");
                $userId = $this->model->sessionManager->getLoggedInUserId();
                $this->crud->updateRating($userId, $productId, $rating);

                // etc etc
        }
    }
}