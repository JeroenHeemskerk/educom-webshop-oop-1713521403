<?php
require "FormsDoc.php";
class LoginDoc extends FormsDoc {
    protected function showContent() {
        $this->showFormStart("Log hier in met je email en wachtwoord:");
        $this->showFormField('email', 'Email', 'text', $this->data, NULL, NULL, false);
        $this->showFormField('pswd', "Wachtwoord", 'password', $this->data, NULL, NULL, false);
        $this->showFormEnd("login", "Login");
    }
}
