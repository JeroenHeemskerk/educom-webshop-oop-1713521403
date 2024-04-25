<?php
require "BasicDoc.php";
include_once(__DIR__ . "/../constants.php");
class ThanksDoc extends BasicDoc {
    protected function showContent() {
        $values = $this->model->values;

        echo '<p>Bedankt, ' . $values["name"] . ', voor je reactie:</p>
        <div>Aanhef: ' . GENDERS[$values["gender"]] . '</div>
        <div>Naam: ' . $values["name"] . '</div>';
        if (!empty($values["phone"])) { 
            echo '<div>Tel: ' . $values["phone"] . '</div>';
        } 
        if (!empty($values["email"])) { 
            echo '<div>Email:  '. $values["email"] . '</div>';
        } 
        
        // At this point, either all are filled in, or none. So only one check required.
        if (!empty($values["street"])) { 
            echo '<div>Adres: ' . $values["street"] . ' ' . $values["housenumber"] . $values["additive"] . '</div>
            <div>Woonplaats: ' . $values["postalcode"] . ', ' . $values["municip"] . '</div>
            <div>Communicatievoorkeur: ' . COMM_PREFS[$values["comm"]] . '</div>';
        }
    }
}