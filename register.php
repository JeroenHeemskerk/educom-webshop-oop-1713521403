<?php 

function getRegisterTitle() {
    return "Registration";
}

function validateRegister() {
    $valid = false;
    $errors = array("user"=>"", "email"=>"", "pswd"=>"", 
    "pswd2"=>"", "general"=>"");

    $values = array("user"=>"", "email"=>"", "pswd"=>"", "pswd2"=>"");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $values["user"] = getPostVar("user");
        $values["email"] =  getPostVar("email", FILTER_SANITIZE_EMAIL);
        $values["pswd"] =  getPostVar("pswd");
        $values["pswd2"] =  getPostVar("pswd2");

        $errors = checkRegisterEmpty($values, $errors);
        include_once('communication.php');

        try {
            if (doesEmailExist($values["email"])) {
                $errors["email"] = "Dit emailadres heeft al een account op deze website.";
            }
        }
        catch (Exception $e) {
            $errors["general"] = "Er is een technische storing, u kunt niet inloggen. Probeer het later nogmaals.";
            logError('Email lookup failed for ' . $values['email'] . ', SQLError: ' . $e -> getMessage());
        }


        if (!filter_var($values["email"], FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Vul alsjeblieft een geldig emailadres in.";
        }

        if ($values["pswd"] != $values["pswd2"]) {
            $errors["pswd2"] = "Wachtwoorden komen niet overeen.";
        }
        
        foreach($errors as $err_msg) {
            if (!empty($err_msg)) {
                $valid = false;
                return ['valid' => $valid, 'values' => $values, 'errors' => $errors];
            }
        }

        $valid = true;
    }

    return ['valid' => $valid, 'values' => $values, 'errors' => $errors];
}

function checkRegisterEmpty($values, $errors) {
    if (empty($values["user"])) {
        $errors["user"] = "Vul alsjeblieft een gebruikersnaam in.";
    }

    if (empty($values["email"])) {
        $errors["email"] = "Vul alsjeblieft je emailadres in.";
    }

    if (empty($values["pswd"])) {
        $errors["pswd"] = "Vul een wachtwoord in ter registratie.";
    }

    if (empty($values["pswd2"])) {
        $errors["pswd2"] = "Herhaal je gekozen wachtwoord ter verificatie.";
    }

    return $errors;
}

function showRegisterContent($data) {
    include_once('forms.php');
    showFormStart("Registreer door het volgende formulier in te vullen:");
    showFormField('user', 'Gebruikersnaam', 'text', $data, NULL, NULL, false);
    showFormField('email', 'Email', 'text', $data, NULL, NULL, false);
    showFormField('pswd', 'Wachtwoord', 'password', $data, NULL, NULL, false);
    showFormField('pswd2', 'Herhaal wachtwoord', 'password', $data, NULL, NULL, false);
    showFormEnd("register", "Registreren");
}