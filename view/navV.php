<?php

$pagesName_byRight = [
    "selectTPI" => "Tableau TPI",
    "validateTPIs" => "Valider des TPI",
    "editValidation" => "Formulaire Admin",
    "editParam" => "Tableau TPI",
    "displayValidationTPI" => "Afficher les TPI",
    "displayValidationTPIManager" => "Afficher les TPI",
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
                foreach ($pagesName_byRight as $key => $value) {
                    if (in_array($key, $_SESSION['rights'][0])) {
                        echo '<a class="nav-link" href="?action=' . $key . '">' . $value . '</a>';
                    }
                }
                ?>
                <div class="sb-sidenav-menu-heading">Module 2</div>
                <a class="nav-link" href="home.php">Page/Action 1</a>
                <a class="nav-link" href="home.php">Page/Action 2</a>
                <a class="nav-link" href="home.php">Page/Action 3</a>
                <a class="nav-link" href="home.php">Page/Action 4</a>
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
            <?= strtoupper($_SESSION['name']) ?> <br>
            <?php foreach($_SESSION["roles"][0] as $r) echo strtoupper($r) . ' '; ?>
        </div>
    </nav>
</div>
