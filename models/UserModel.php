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
                $this->logError("Login failed: " . $e->getMessage());
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
            $this->values["user"] = $this->getPostVar("user");
            $this->values["email"] = $this->getPostVar("email", FILTER_SANITIZE_EMAIL);
            $this->values["pswd"] = $this->getPostVar("pswd");
            $this->values["pswd2"] = $this->getPostVar("pswd2");

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

    public function validateChangePassword() {
        if ($this->isPost) {
            $this->values["pswd"] = $this->getPostVar("pswd");
            $this->values["pswdNew"] =  $this->getPostVar("pswdNew");
            $this->values["pswdNew2"] =  $this->getPostVar("pswdNew2");
            $this->values["email"] = $this->sessionManager->getLoggedInEmail();

            try {
                include_once(__DIR__ . '/../communication.php');
                $authResult = authenticateNewPswd($this->values);
                switch ($authResult['result']) {
                    case RESULT_EMPTY_PSWD:
                        $this->errors["pswd"] = "Vul alsjeblieft je huidige wachtwoord in."; 
                        break;
    
                    case RESULT_EMPTY_NEWPSWD:
                        $this->errors["pswdNew"] = "Herhaal alsjeblieft je nieuwe wachtwoord tweemaal."; 
                            break;
               
                    case RESULT_WRONG_PSWD:
                        $this->errors["pswd"] = "Wachtwoord onjuist."; 
                        break;
    
                    case RESULT_WRONG_NEWPSWD:
                        $this->errors["pswdNew"] = "Wachtwoorden komen niet overeen.";
                        break;
    
                    case RESULT_NO_PSWDCHANGE:
                        $this->errors["pswdNew"] = "Vul alsjeblieft een <b>nieuw</b> wachtwoord in.";
                        break;
               
                    case RESULT_OK:
                        $this->values['userName'] = $authResult['user']['name'];
                        $this->values['userId'] = $authResult['user']['id'];
                        break;
                 }
            } 
            catch (Exception $e) {
                $this->errors["general"] = "Er is een technische storing, u kunt uw wachtwoord niet updaten. Probeer het later nogmaals.";
                $this->logError('Authentication failed for user ' . $this->values['email'] . ', SQLError: ' . $e -> getMessage());
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

    public function changePassword() {
        include_once(__DIR__ . "/../communication.php");
        changePassword($this->values);
    }

    public function validateContact() {
        $this->initialiseContactVars();
        include_once(__DIR__ . "/../constants.php");
        if ($this->isPost) {
            $this->validateGender();
            $this->validateName();
            $this->validateComm();
            $this->validateAddress();

            if (empty($this->values["msg"])) {
                $this->errors["msg"] = "Vul alsjeblieft een bericht in.";
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

    private function initialiseContactVars() {
        $this->values["gender"] = $this->getPostVar("gender");
        $this->values["name"] = $this->getPostVar("name");
        $this->values["email"] = $this->getPostVar("email", NULL, FILTER_SANITIZE_EMAIL);
        $this->values["phone"] = $this->getPostVar("phone");
        $this->values["street"] = $this->getPostVar("street");
        $this->values["housenumber"] = $this->getPostVar("housenumber");
        $this->values["additive"] = $this->getPostVar("additive");
        $this->values["postalcode"] = $this->getPostVar("postalcode");
        $this->values["municip"] = $this->getPostVar("municip");
        $this->values["msg"] = $this->getPostVar("msg");
        $this->values["comm"] = $this->getPostVar("comm");
    }

    private function validateName() {
        if (empty($this->values["name"])) {
            $this->errors["name"] = "Vul alsjeblieft je volledige naam in.";
        } else if (!preg_match('/[a-zA-Z]/', $this->values["name"])) {
            $this->errors["name"] = "Vul alsjeblieft een naam in met minstens 1 letter.";
        }
    }

    private function validateGender() {
        if (empty($this->values["gender"])) {
            $this->errors["gender"] = "Vul alsjeblieft je aanhefvoorkeur in of geef aan dat je dit liever niet laat weten.";
        } else if (!array_key_exists($this->values['gender'], GENDERS)) {
            $this->errors["gender"] = "Selecteer alsjeblieft een van de aanhefvoorkeuren.";
        }
    }

    private function validateComm() {
        if (empty($this->values["comm"])) {
            $this->errors["comm"] = "Vul alsjeblieft je communicatievoorkeur in.";
        }

        if ($this->values["comm"] == "email" && !filter_var($this->values["email"], FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] = "Vul alsjeblieft een geldig emailadres in.";
        }

        if ($this->values["comm"] == "phone" && empty($this->values["phone"])) {
            $this->errors["phone"] = "Vul alsjeblieft een telefoonnummer in. ";
        } else if (!empty($this->values["phone"]) && !ctype_digit($this->values["phone"])) {
            $this->errors["phone"] = "Vul alsjeblieft een telefoonnummer in met alleen cijfers.";
        }
    }

    private function validateAddress() {
        $street_flag = empty($this->values["street"]);
        $housenumber_flag = empty($this->values["housenumber"]);
        $postalcode_flag = empty($this->values["postalcode"]);
        $municip_flag = empty($this->values["municip"]);
        
        if ($this->values["comm"] == "post" || !$street_flag || !$housenumber_flag || !$postalcode_flag  || !$municip_flag) {
            if ($street_flag) {
                $this->errors["street"] = "Vul alsjeblieft je straatnaam in.";
            }

            if ($housenumber_flag) {
                $this->errors["housenumber"] = "Vul alsjeblieft je huisnummer in.";
            }

            if ($postalcode_flag) {
                $this->errors["postalcode"] = "Vul alsjeblieft je postcode in.";
            } else if (!preg_match('/^[0-9]{4}[A-Z]{2}$/', $this->values["postalcode"])) {
                $this->errors["postalcode"] = "Vul alsjeblieft een geldige Nederlands postcode in."; 
            }

            if ($municip_flag) {
                $this->errors["municip"] = "Vul alsjeblieft je gemeente in.";
            }
        }
}
}