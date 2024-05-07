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
                try {
                    $this->response = $this->crud->readAvgRating($productId);
                    $this->response->id = $productId;
                    break;
                }
                catch (Exception $e) {
                    $this->model->errors["general"] = "Er is een technische storing. U kunt momenteel geen rating geven. Probeer het later nogmaals.";
                    $this->model->LogError("Rating failed. MySQL error: ". $e);
                }

            case "updateRating":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $productId = $this->model->getGetVar("id");
                $rating = $this->model->getGetVar("rating");
                $userId = $this->model->sessionManager->getLoggedInUserId();
                try {
                    $this->response = $this->crud->updateRating($userId, $productId, $rating);
                }
                catch (Exception $e) {
                    $this->model->errors["general"] = "Er is een technische storing. U kunt momenteel geen rating geven. Probeer het later nogmaals.";
                    $this->model->LogError("Rating failed. MySQL error: ". $e);
                }
                break;
            case "makeRating":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                $productId = $this->model->getGetVar("id");
                $rating = $this->model->getGetVar("rating");
                $userId = $this->model->sessionManager->getLoggedInUserId();

                try {
                    $this->response = $this->crud->createRating($userId, $productId, $rating);
                }
                catch (Exception $e) {
                    $this->model->errors["general"] = "Er is een technische storing. U kunt momenteel geen rating geven. Probeer het later nogmaals.";
                    $this->model->LogError("Rating failed. MySQL error: ". $e);
                }
                break;
            case "getAvgRatings":
                $this->crudFactory->createCrud("rating");
                $this->crud = $this->crudFactory->crud;
                try {
                    $this->response = $this->crud->readMultipleAvgRatings();
                }
                catch (Exception $e) {
                    $this->model->errors["general"] = "Er is een technische storing. U kunt momenteel geen rating geven. Probeer het later nogmaals.";
                    $this->model->LogError("Rating failed. MySQL error: ". $e);
                }
                break;

        }
    }

    public function showResponse() {
        echo json_encode($this->response);
    }
}