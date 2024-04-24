<?php
require_once("PageModel.php");
class UserModel extends PageModel {
    public $values = array("email"=>"", "pswd"=>"", "user"=>"");
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

    public function doLogoutUser() {
        $this->sessionManager->doLogoutUser();
    }

    public function validateRegister() {
        if ($this->isPost) {
            $this->values["user"] = getPostVar("user");
            $this->values["email"] =  getPostVar("email", FILTER_SANITIZE_EMAIL);
            $this->values["pswd"] =  getPostVar("pswd");
            $this->values["pswd2"] =  getPostVar("pswd2");

            $this->checkRegisterEmpty();

            if (!filter_var($this->values["email"], FILTER_VALIDATE_EMAIL)) {
                $this->errors["email"] = "Vul alsjeblieft een geldig emailadres in.";
            }

            try {
                include_once(__DIR__ . '/../communication.php');
                if (doesEmailExist($this->values["email"])) {
                    $this->errors["email"] = "Dit emailadres heeft al een account op deze website.";
                }
            }
            catch (Exception $e) {
                $this->errors["general"] = "Er is een technische storing, u kunt niet inloggen. Probeer het later nogmaals.";
                $this->logError('Email lookup failed for ' . $this->values['email'] . ', SQLError: ' . $e -> getMessage());
            }

            if ($this->values["pswd"] != $this->values["pswd2"]) {
                $this->errors["pswd2"] = "Wachtwoorden komen niet overeen.";
            }

            $this->valid = true;
            foreach($this->errors as $err_msg) {
                if (!empty($err_msg)) {
                    $this->valid = false;
                    break;
                }
            }
        }

    }

    private function checkRegisterEmpty() {
        if (empty($this->values["user"])) {
            $this->errors["user"] = "Vul alsjeblieft een gebruikersnaam in.";
        }
    
        else if (empty($this->values["email"])) {
            $this->errors["email"] = "Vul alsjeblieft je emailadres in.";
        }
    
        else if (empty($this->values["pswd"])) {
            $this->errors["pswd"] = "Vul een wachtwoord in ter registratie.";
        }
    
        else if (empty($this->values["pswd2"])) {
            $this->errors["pswd2"] = "Herhaal je gekozen wachtwoord ter verificatie.";
        }
    }

    public function addAccount() {
        include_once(__DIR__ . '/../communication.php');
        try {
            addAccount($this->values);
        }
        catch (Exception $e) {
            $this->errors["general"] = "Er is een technische storing, u kunt niet registreren. Probeer het later nogmaals.";
            $this->logError('Registration failed for user ' . $this->values['email'] . ', SQLError: ' . $e -> getMessage());
        }
    }
}