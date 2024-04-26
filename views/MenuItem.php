<?php
class MenuItem {
    public $page;
    public $text;
    public $text2;

    public function __construct($page, $text, $text2=NULL) {
        $this->page = $page;
        $this->text = $text;
        $this->text2 = $text2;
    }
}