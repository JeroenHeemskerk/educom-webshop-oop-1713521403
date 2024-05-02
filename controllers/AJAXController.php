<?php
class AJAXController {
    public $model;
    public $crudFactory;
    private $crud;

    public function __construct(PageModel $model, CRUDFactory $crudFactory) {
        $this->model = $model;
        $this->crudFactory = $crudFactory;
    }

    public function processRequest() {
        $function = $this->model->getGetVar("function");
        switch($function) {
            case "getAvgRating":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $productId = $this->model->getGetVar("id");
                $this->crud->readAvgRating($productId);
                break;
            case "updateRating":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $productId = $this->model->getGetVar("id");
                $rating = $this->model->getGetVar("rating");
                $userId = $this->model->sessionManager->getLoggedInUserId();
                $this->crud->updateRating($userId, $productId, $rating);
                break;
            case "makeRating":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $productId = $this->model->getGetVar("id");
                $rating = $this->model->getGetVar("rating");
                $userId = $this->model->sessionManager->getLoggedInUserId();
                $this->crud->createRating($userId, $productId, $rating);
                break;
            case "getAvgRatings":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $this->crud->readMultipleAvgRatings();
                break;

        }
    }
}