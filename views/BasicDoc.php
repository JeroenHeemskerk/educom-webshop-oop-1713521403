<?php 

require('HtmlDoc.php');
abstract class BasicDoc extends HtmlDoc {
    protected $model;

    public function __construct($pageModel) {
        $this->model = $pageModel;
    }

    protected function showHeadContent() {
        $this->showTitle();
        $this->showFavIcon();
        $this->showStyleLinks();
    }

    private function showFavIcon() {
        // dit werkt nu niet meer als ik het test vanuit tests/
        echo '<link rel="icon" type="svg" href="Images/online-form-icon.svg">';

    }

    private function showStyleLinks() {
        // dit werkt nu niet meer als ik het test vanuit tests/
        echo '<link rel="stylesheet" type="text/css" href="css/styles.css">';
        echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather|Open+Sans">';
    }
    
    private function showTitle() {
        echo "<title>";
        echo $this->model->title;
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
        $menu = $this->model->menu;
        echo '<ul class="navbar">';
        foreach($menu as $menuButton=>$menuItem) {
            if ($menuButton == "logout") {
                echo '<li><a href="index.php?page=' . $menuItem->page . '">' . $menuItem->text . ' <span id="logoutUser">' . $menuItem->text2 . '</span></a></li>';
            }
            else {
                echo '<li><a href="index.php?page=' . $menuItem->page . '">' . $menuItem->text . ' <span>' . $menuItem->text2 . '</span></a></li>';
            }

        }
        echo '</ul>';
    }

    private function showGeneralError() {
        if (array_key_exists("general", $this->model->errors)) {
            echo '<div class="error">' . $this->model->errors['general'] . '</div>';
        }
    }

    abstract protected function showContent();

    private function showFooter() {
        echo '<footer>
        <p>&copy; Florian van der Steen 2024<br></p>
        </footer>';
    }
}
