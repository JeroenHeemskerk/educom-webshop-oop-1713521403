<?php
require("FormsDoc.php");
class RegisterDoc extends FormsDoc {
    protected function showContent() {
        $this->showFormStart("Registreer door het volgende formulier in te vullen:");
        $this->showFormField('user', 'Gebruikersnaam', 'text', $this->model, NULL, NULL, false);
        $this->showFormField('email', 'Email', 'text', $this->model, NULL, NULL, false);
        $this->showFormField('pswd', 'Wachtwoord', 'password', $this->model, NULL, NULL, false);
        $this->showFormField('pswd2', 'Herhaal wachtwoord', 'password', $this->model, NULL, NULL, false);
        $this->showFormEnd("register", "Registreren");
    }
}