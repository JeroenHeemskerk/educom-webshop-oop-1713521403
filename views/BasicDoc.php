<?php 

require('HtmlDoc.php');
abstract class BasicDoc extends HtmlDoc {
    protected $data;

    public function __construct($pageData) {
        $this->data = $pageData;
    }

    protected function showHeadContent() {
        $this->showTitle();
        $this->showFavIcon();
        $this->showStyleLinks();
    }

    private function showFavIcon() {
        echo '<link rel="icon" type="svg" href="../Images/online-form-icon.svg">';

    }

    private function showStyleLinks() {
        echo '<link rel="stylesheet" type="text/css" href="../css/styles.css">';
        echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather|Open+Sans">';
    }
    
    private function showTitle() {
        echo "<title>";
        echo $this->data["title"];
        echo "</title>";  
    }

    protected function showBodyContent() {
        $this->showLogo();
        $this->showMenu();
        $this->showGeneralError();
        $this->showContent();
        $this->showFooter();
    }

    private function showLogo() {
        echo "<h1>Florian&apos;s Rariteitenkabinet</h1>";
    }

    private function showMenu() {
        $menu = $this->data["menu"];
        echo '<ul class="navbar">';
        foreach($menu as $page=>$label) {
            echo '<li><a href="index.php?page=' . $page . '">' . $label . '</a></li>';
        }
        echo '</ul>';
    }

    private function showGeneralError() {
        if (!empty($this->data['errors']['general'])) {
            echo '<div class="error">' . $this->data['errors']['general'] . '</div>';
        }
    }

    abstract protected function showContent();

    private function showFooter() {
        echo '<footer>
        <p>&copy; Florian van der Steen 2024<br></p>
        </footer>';
    }
}
