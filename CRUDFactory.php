<?php
include_once("CRUD.php");
include_once("UserCRUD.php");
class CRUDFactory {
    public $crud;

    public function __construct(CRUD $crud) {
        $this->crud = $crud;
    }

    public function createCrud($name) {
        if ($name == "user") {
            $this->crud = new UserCRUD($this->crud);
        }
    }
}