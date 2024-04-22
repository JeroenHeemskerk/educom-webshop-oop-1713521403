<?php
abstract class HtmlDoc {
    private function showHtmlStart() {
        echo "<!DOCTYPE html><html>";
    }

    private function showHeadStart() {
        echo "<head>";
    }

    // ik vermoed dat deze class abstract moet worden
    protected function showHeadContent() {
        echo "";
    } 

    private function showHeadEnd() {
        echo "</head>";
    }

    private function showBodyStart() {
        echo "<body>";
    }

    abstract protected function showBodyContent();

    private function showBodyEnd() {
        echo "</body>";
    }

    private function showHtmlEnd() {
        echo "</html>";
    }

    public function show() {
        $this->showHtmlStart();
        $this->showHeadStart();
        $this->showHeadContent();
        $this->showHeadEnd();
        $this->showBodyStart();
        $this->showBodyContent();
        $this->showBodyEnd();
        $this->showHtmlEnd();
    }
}