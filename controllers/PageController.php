<?php
require_once("models/PageModel.php");
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
        switch ($this->model->page) {
            case "login":
                require_once("models/UserModel.php");
                $this->model = new UserModel($this->model);
                $this->model->validateLogin();
                if ($this->model->valid) {
                    $this->model->doLoginUser();
                    $this->model->page = "home";
                }
                break;
            case "logout":
                require_once("models/UserModel.php");
                $this->model = new UserModel($this->model);
                $this->model->doLogoutUser();
                $this->model->page = "home";
            case "register":
                require_once("models/UserModel.php");
                $this->model = new UserModel($this->model);
                $this->model->validateRegister();
                if ($this->model->valid) {
                    $this->model->addAccount();
                    $this->model->page = "home";
                }
        }
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

            case "about":
                include_once("views/AboutDoc.php");
                $view = new AboutDoc($this->model);
                break;

            case "login":
                include_once("views/LoginDoc.php");
                $view = new LoginDoc($this->model);
                break;    

            case "register":
                include_once("views/RegisterDoc.php");
                $view = new RegisterDoc($this->model);
                break;

            default:
                include_once("views/Error404Doc.php");
                $view = new Error404Doc($this->model);
                break;
        }
        $view->show();
    }
}