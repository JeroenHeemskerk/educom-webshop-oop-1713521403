<?php
class ModelFactory {
    public $crudFactory;
    public $pageModel;
    public function __construct(CRUDFactory $CRUDFactory) {
        $this->crudFactory = $CRUDFactory;
        $this->pageModel = new PageModel(NULL);
    }
    public function createModel($name) {
        if ($name == "page") {
            return $this->pageModel;
        }
        else if ($name == "user") {
            $this->crudFactory->createCrud($name);
            // Intelephense klaagt hierover. Blijkbaar is t mogelijk dat \/ dit een CRUD object is ipv UserCRUD?
            return new UserModel($this->pageModel, $this->crudFactory->crud); 
        }
        else if ($name == "product") {
            $this->crudFactory->createCrud($name);
            return new ProductModel($this->pageModel, $this->crudFactory->crud);
        }
    }
}