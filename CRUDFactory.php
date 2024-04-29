<?php
include_once("CRUD.php");
include_once("UserCRUD.php");
include_once("ProductCRUD.php");
class CRUDFactory {
    public $crud;

    public function __construct(CRUD $crud) {
        $this->crud = $crud;
    }

    public function createCrud($name) {
        if ($name == "user") {
            $this->crud = new UserCRUD($this->crud);
        }
        else if ($name == "product") {
            $this->crud = new ProductCRUD($this->crud);
        }
    }
}