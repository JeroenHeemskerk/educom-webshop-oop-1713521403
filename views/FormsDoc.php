<?php
require("BasicDoc.php");
abstract class FormsDoc extends BasicDoc {
    protected function showFormStart($introText, $formTitle=NULL) {
        if (!empty($formTitle)) { 
            echo '<h2>' . $formTitle . '</h2>';
        }
        echo '<form method="POST" action="'; echo htmlspecialchars($_SERVER['PHP_SELF']); echo '">
            <p>' . $introText . '</p>';
    }
    
    protected function showFormEnd($page, $buttonText) {
        // doen we dit dan nog met een hidden page of passen we de data property aan?
        echo '<input type="hidden" id="page" name="page" value="' . $page . '">'; 
        echo '<input type="submit" value="' . $buttonText . '">'; 
        echo '</form>';
    }

    protected function showFormField($fieldName, $label, $type, $model, $placeholder=NULL, $options=NULL, $optional=true) {
        $errors = $model->errors;
        $value = ($type == 'password') ? '' : $model->values[$fieldName];
    
        echo '<div>';
        echo '<label for="' . $fieldName . '">' . $label . ': </label>';
        switch ($type) {
            case "textarea":
                echo '<' . $type . ' id="' . $fieldName . '" name="' . $fieldName . '" ';
                foreach($options as $key => $option) {
                    // bit hacky, used for cols and rows
                    echo $key . '="' . $option . '" ';
                }
                echo 'placeholder="' . $placeholder . '">' . $value . '</' . $type . '>';
                break;
    
            case "radio":
                foreach($options as $key => $option) {
                    echo '<input type="' . $type . '"';
                    echo 'id="' . $fieldName . '-' . $key . '" name="' . $fieldName . '" value="' . $key . '" ';
                    if (!empty($value) && $value == $key) { echo "checked";}
                    echo '><label class="' . $type . '" for="' . $key . '">' . $option . '</label>';
                }
                break;
    
            case "select":
                echo '<' . $type . ' id="' . $fieldName . '" name="' . $fieldName . '" value="' . $value . '">';
                foreach($options as $key => $option) {
                    echo '<option value="' . $key . '"';
                    if ($value == $key) {echo "selected";}
                    echo '>' . $option . '</option>';
                }
                echo '</select>';
                break;
    
            default:
                echo '<input type="' . $type . '" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $value . '" placeholder="' . $placeholder . '">';
                break;
        }
    
        $this->showFormError($optional, $fieldName, $errors);
        echo '</div>';
    }

    protected function showFormError($optional, $fieldName, $errors) {
        echo '<span class="error">';
        if (!$optional) {echo " * ";}
        if (!empty($errors[$fieldName])) {
            if ($optional) {echo " * ";} 
            echo  $errors[$fieldName];
        }
        echo '</span>';
    }
}