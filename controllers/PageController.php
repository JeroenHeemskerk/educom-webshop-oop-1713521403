<?php
require("models/PageModel.php");
class PageController {
    private $model;
    public function __construct() {
        $this->model = new PageModel(NULL);
    }

    public function handleRequest() {
        $this->getRequest();
        $this->processRequest();
        $this->showResponse();
    }

    private function getRequest() {
        $this->model->getRequestedPage();
    }

    private function processRequest() {
        // switch ($this->model->page) {
        //     case "home":

        // }
    }

    private function showResponse() {
        $this->model->createMenu();
        $this->model->setTitle();
        $view = NULL;

        switch ($this->model->page) {
            case "home":
                include_once("views/HomeDoc.php");
                $view = new HomeDoc($this->model);
                break;
        }
        $view->show();
    }
}