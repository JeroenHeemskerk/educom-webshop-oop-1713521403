<?php
require "FormsDoc.php";
class AccountDoc extends FormsDoc {
    protected function showContent() {
        $this->showFormStart("Wijzig hier je wachtwoord:", "Wachtwoord Wijziging");
        $this->showFormField("pswd", "Huidige wachtwoord", "password", $this->model, NULL, NULL, false);
        $this->showFormField("pswdNew", "Nieuwe wachtwoord", "password", $this->model, NULL, NULL, false);
        $this->showFormField("pswdNew2", "Herhaal wachtwoord", "password", $this->model, NULL, NULL, false);
        $this->showFormEnd("account", "Wijzig wachtwoord");
    }
}
