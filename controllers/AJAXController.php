<?php
class AJAXController {
    public $model;
    public $crudFactory;
    private $crud;
    private $response;

    public function __construct(PageModel $model, ModelFactory $modelFactory) {
        $this->model = $model;
        $this->crudFactory = $modelFactory->crudFactory;
    }

    public function handleRequest() {
        $this->processRequest();
        $this->showResponse();
    }

    public function processRequest() {
        $function = $this->model->getGetVar("function");
        switch($function) {
            case "getAvgRating":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $productId = $this->model->getGetVar("id");
                $this->response = $this->crud->readAvgRating($productId);
                $this->response->id = $productId;
                break;
            case "updateRating":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $productId = $this->model->getGetVar("id");
                $rating = $this->model->getGetVar("rating");
                $userId = $this->model->sessionManager->getLoggedInUserId();
                $this->response = $this->crud->updateRating($userId, $productId, $rating);
                break;
            case "makeRating":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $productId = $this->model->getGetVar("id");
                $rating = $this->model->getGetVar("rating");
                $userId = $this->model->sessionManager->getLoggedInUserId();
                $this->response = $this->crud->createRating($userId, $productId, $rating);
                break;
            case "getAvgRatings":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $this->response = $this->crud->readMultipleAvgRatings();
                break;

        }
    }

    public function showResponse() {
        echo json_encode($this->response);
    }
}