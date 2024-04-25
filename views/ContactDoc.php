<?php 
require "FormsDoc.php";
include_once(__DIR__ . "/../constants.php");
class ContactDoc extends FormsDoc {
    protected function showContent() {
        $this->showFormStart("Neem contact op:", "Contactformulier");
        $this->showFormField('gender', 'Aanhef', 'select', $this->model, NULL, GENDERS);
        $this->showFormField('name', 'Voor- en achternaam', 'text', $this->model, "Marie Jansen", NULL, false);
        $this->showFormField('email', "Email", "text", $this->model, "voorbeeld@mail.com");
        $this->showFormField('phone', "Telefoonnummer", "tel", $this->model, "0612345678");
        $this->showFormField('street', 'Straatnaam', 'text', $this->model, "Lindeweg");
        $this->showFormField("housenumber", "Huisnummer", "number", $this->model, "1");
        $this->showFormField("additive", "Toevoeging", "text", $this->model, "A");
        $this->showFormField("postalcode", "Postcode", "text", $this->model, "1234AB");
        $this->showFormField("municip", "Gemeente", "text", $this->model, "Utrecht");
        $this->showFormField('comm', 'Communicatie, via', 'radio', $this->model, NULL, COMM_PREFS);
        $this->showFormField('msg', "Uw bericht", "textarea", $this->model, "Schrijf hier uw bericht...", ["rows" => 10, "cols" => 60]);
        $this->showFormEnd("contact", "Verzenden");
    }
}