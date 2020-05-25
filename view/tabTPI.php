<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Collège d'Experts Informatique de Genève</title>
    <!-- Mise en page basée sur le template Start Bootstrap - Admin (https://startbootstrap.com/templates/sb-admin/) -->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light" style="background-color:lightgray">
        <a class="navbar-brand" href="#">
            <img src="./img/LogoExpertsDev.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            CdEIG
        </a>

        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <ul class="navbar-nav mr-auto">
                <!-- Menu principal quand l'utilisateur est identifié -->
                <li class="nav-item active">
                    <a class="nav-link" href="#">A propos <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Module 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Module 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Module 3</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Module 4</a>
                </li>
                <!-- fin du menu principal -->
            </ul>

        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Paramètres</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Déconnexion</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Menu secondaire (qui reprend le menu principal...) -->
                        <a class="nav-link" href="home.php">A propos</a>

                        <div class="sb-sidenav-menu-heading">Module 1</div>
                        <a class="nav-link" href="home.php">Page/Action 1</a>
                        <a class="nav-link" href="home.php">Page/Action 2</a>
                        <a class="nav-link" href="home.php">Page/Action 3</a>
                        <a class="nav-link" href="home.php">Page/Action 4</a>
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
                    NOM PRENOM <br>
                    (ROLES)
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <!-- Début du contenu de la page -->
                <div class="container-fluid">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Entreprise</th>
                                <th scope="col">Enseignant / Chef de projet</th>
                                <th scope="col">Date de début</th>
                                <th scope="col">Date de fin</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Domaine</th>
                                <th scope="col">Expert 1</th>
                                <th scope="col">Expert 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach (getTpi() as $key => $value) {
                                echo '<tr><th scope="row">' . $key . '</th>';
                                echo '<td>' . $value['Name'] . '</td>';
                                echo '<td>' . $value['firstName'] . '</td>';
                                echo '<td>' . $value['companyName'] . '</td>';
                                echo '<td>' . $value['projectManager'] . '</td>';
                                echo '<td>' . $value['sessionStart'] . '</td>';
                                echo '<td>' . $value['sessionEnd'] . '</td>';
                                echo '<td>' . $value['title'] . '</td>';
                                echo '<td>' . $value['cfcDomain'] . '</td>';
                                echo '<td>' . $value['expert1'] . '</td>';
                                echo '<td>' . $value['expert2'] . '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </div>
                    <!-- fin du contenu de la page-->
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">TPI 2020 - développé par NGUYEN KELLY</div>
                            <div class="text-muted">Application en cours de développement</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    </body>

    </html>
