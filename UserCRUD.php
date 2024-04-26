<?php
class UserCRUD {
    private $crud;

    public function __construct(CRUD $crud) {
        $this->crud = $crud;
    }

    public function readUserDataByEmail($email) {
        $sql = "SELECT * FROM users WHERE email=:email;";
        $params = array(":email"=>$email);

        $row = $this->crud->readOneRow($sql, $params);
        return $row;
    }

    public function readUserByEmail($email) {
        $user = $this->readUserDataByEmail($email);
         
        if (empty($user)) {
            return NULL; 
        } 
     
        return $user->name; 
    }

    public function readEmailExist($email) {
        // If the returned instance is not empty, then the user/email exists in the db
        return !empty($this->readUserDataByEmail($email));
    }

    public function createUser($credentials) { 
        $sql = "INSERT INTO users (email, name, pswd) VALUES (:email, :name, :pswd);"; 
        $params = array(":email"=>$credentials["email"], ":name"=>$credentials["user"], ":pswd"=>password_hash($credentials["pswd"], PASSWORD_DEFAULT, [14]));

        return $this->crud->createRow($sql, $params);
    } 

    public function updatePassword($values) {        
        $sql = "UPDATE users SET pswd = :pswd WHERE id=:id;";
        $params =  array(":pswd"=>password_hash($values["pswdNew"], PASSWORD_DEFAULT, [14]), ":id"=>$values["userId"]);

        return $this->crud->updateRow($sql, $params);
    }


}