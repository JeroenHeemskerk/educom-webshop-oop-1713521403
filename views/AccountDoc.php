<?php
require "FormsDoc.php";
class AccountDoc extends FormsDoc {
    protected function showContent() {
        $this->showFormStart("Wijzig hier je wachtwoord:", "Wachtwoord Wijziging");
        $this->showFormField("pswdOld", "Huidige wachtwoord", "password", $this->data, NULL, NULL, false);
        $this->showFormField("pswdNew", "Nieuwe wachtwoord", "password", $this->data, NULL, NULL, false);
        $this->showFormField("pswdNew2", "Herhaal wachtwoord", "password", $this->data, NULL, NULL, false);
        $this->showFormEnd("account", "Wijzig wachtwoord");
    }
}
