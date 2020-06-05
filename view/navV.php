<?php

$pagesName_distribution_byRight = [
    "displayTPI" => "Tableau TPI",
    "editParam" => "Formulaire Admin",
];

$pagesName_validation_byRight = [
    "displayValidationTPI" => "Afficher les validations"
];

?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- Menu secondaire (qui reprend le menu principal...) -->
                <a class="nav-link" href="home.php">A propos</a>

                <div class="sb-sidenav-menu-heading">Répartition TPI</div>
                <?php
                foreach ($pagesName_distribution_byRight as $key => $value) {
                    if (in_array($key, $_SESSION['rights'][0])) {
                        echo '<a class="nav-link" href="?action=' . $key . '">' . $value . '</a>';
                    }
                }
                ?>
                <div class="sb-sidenav-menu-heading">Validation</div>
                <?php
                foreach ($pagesName_validation_byRight as $key => $value) {
                    if (in_array($key, $_SESSION['rights'][0])) {
                        echo '<a class="nav-link" href="?action=' . $key . '">' . $value . '</a>';
                    }
                }
                ?>
                <div class="sb-sidenav-menu-heading">Module 3</div>
                <a class="nav-link" href="home.php">Page/Action 1</a>
                <a class="nav-link" href="home.php">Page/Action 2</a>
                <a class="nav-link" href="home.php">Page/Action 3</a>
                <a class="nav-link" href="home.php">Page/Action 4</a>
                <div class="sb-sidenav-menu-heading">Module 4</div>
                <a class="nav-link" href="home.php">Page/Action 1</a>
                <a class="nav-link" href="home.php">Page/Action 2</a>
                <a class="nav-link" href="home.php">Page/Action 3</a>
                <a class="nav-link" href="home.php">Page/Action 4</a>
                <!-- Fin du menu secondaire -->
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Connecté en tant que:</div>
            <?= $_SESSION['name'] ?> <br>
            <?php foreach($_SESSION["roles"][0] as $r) echo $r . ' '; ?>
        </div>
    </nav>
</div>
