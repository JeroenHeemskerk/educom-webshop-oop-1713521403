<?php 
require "FormsDoc.php";
class ContactDoc extends FormsDoc {
    // dit staat nu op twee plekken (ook in contact.php), daar ben ik niet zo blij mee
    private $genders = array(""=> "--", "mevr"=>"Mevr.", "dhr"=>"Dhr.", "dhr_mevr" => "Dhr. / Mevr.", "mevr_dhr" => "Mevr. / Dhr.", "unspecified" => "Zeg ik liever niet.");
    private $comm_prefs =  array("email" => "Email", "phone" => "Telefoon", "post" => "Post");

    protected function showContent() {
        $this->showFormStart("Neem contact op:", "Contactformulier");
        $this->showFormField('gender', 'Aanhef', 'select', $this->data, NULL, $this->genders);
        $this->showFormField('name', 'Voor- en achternaam', 'text', $this->data, "Marie Jansen", NULL, false);
        $this->showFormField('email', "Email", "text", $this->data, "voorbeeld@mail.com");
        $this->showFormField('phone', "Telefoonnummer", "tel", $this->data, "0612345678");
        $this->showFormField('street', 'Straatnaam', 'text', $this->data, "Lindeweg");
        $this->showFormField("housenumber", "Huisnummer", "number", $this->data, "1");
        $this->showFormField("additive", "Toevoeging", "text", $this->data, "A");
        $this->showFormField("postalcode", "Postcode", "text", $this->data, "1234AB");
        $this->showFormField("municip", "Gemeente", "text", $this->data, "Utrecht");
        $this->showFormField('comm', 'Communicatie, via', 'radio', $this->data, NULL, $this->comm_prefs);
        $this->showFormField('msg', "Uw bericht", "textarea", $this->data, "Schrijf hier uw bericht...", ["rows" => 10, "cols" => 60]);
        $this->showFormEnd("contact", "Verzenden");
    }
}