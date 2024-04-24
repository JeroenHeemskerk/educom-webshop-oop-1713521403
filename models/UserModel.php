<?php
require_once("PageModel.php");
class UserModel extends PageModel {
    public $values = array("email"=>"", "pswd"=>"");
    public $valid = false;
    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
    }

    public function validateLogin() {
        if ($this->isPost) {
            $this->values["email"] =  $this->getPostVar("email", FILTER_SANITIZE_EMAIL);
            $this->values["pswd"] =  $this->getPostVar("pswd");

            require_once(__DIR__ . '/../communication.php');
            try {
                $authResult = authenticateUser($this->values["email"], $this->values["pswd"]);
                switch ($authResult['result']) {
                    case RESULT_EMPTY_EMAIL:
                        $this->errors["email"] = "Vul alsjeblieft je emailadres in.";
                        break;
    
                    case RESULT_UNKNOWN_USER: 
                        $this->errors["email"] = "Er is geen account bekend op deze website met dit emailadres."; 
                        break;
    
                    case RESULT_EMPTY_PSWD:
                        $this->errors["pswd"] = "Vul alsjeblieft je wachtwoord in."; 
                        break;
               
                    case RESULT_WRONG_PSWD:
                        $this->errors["pswd"] = "Wachtwoord onjuist."; 
                        break; 
               
                    case RESULT_OK:
                        $this->values["userName"] = $authResult["user"]["name"];
                        $this->values["userId"] = $authResult["user"]["id"];
                        $this->valid = true;
                        break;
                }
            }
            catch (Exception $e) {
                $this->errors["general"] = "Wij ondervinden momenteel een technische storing. Probeer later nogmaals in te loggen.";
                $this->logError("Login failed: " . $e);
            }  
        }
    }

    public function doLoginUser() {
        $this->sessionManager->doLoginUser($this->values);
    }
}