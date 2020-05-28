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
    <?php require_once 'navH.php'; ?>
    <div id="layoutSidenav">
        <?php require_once 'navV.php'; ?>
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
                                <th scope="col">Chef de projet</th>
                                <th scope="col">Date de début</th>
                                <th scope="col">Date de fin</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Domaine</th>
                                <th scope="col">Souhait Experts</th>
                                <th scope="col">Choisir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //id of expert 277 261 281 278
                            $nbExpert = 0;
                            foreach (getTPIsWOExpert() as $value) {
                                echo '<tr><th scope="row">' . $value['tpiID'] . '</th>';
                                echo '<td>' . $value['candidateLastName'] . '</td>';
                                echo '<td>' . $value['candidateFirstName'] . '</td>';
                                echo '<td>' . $value['companyName'] . '</td>';
                                echo '<td>' . $value['managerLastName'] . ' ' . $value['managerFirstName'] . '</td>';
                                echo '<td>' . $value['sessionStart'] . '</td>';
                                echo '<td>' . $value['sessionEnd'] . '</td>';
                                echo '<td><a href="pdf/Enonce_TPI_'. $value['year'] .'_'. $value['tpiID'] .'_'. $value['candidateLastName'] .'_'. $value['candidateFirstName'] .'.pdf">' . $value['title'] . '</a></td>';
                                echo '<td>' . $value['cfcDomain'] . '</td>';
                                echo '<td>';
                                $names = getWishesByIdExpert($value['tpiID']);
                                $nbExpert = count($names);
                                foreach ($names as $name) {
                                    echo $name['expertLastName'] . ' ' . $name['expertFirstName'] . '<br>';
                                }
                                echo '</td>';
                                if ($nbExpert < 4) {
                                    echo '<td><a href="?action=selectTPI&pdf=false&by=277&idTPI=' . $value['tpiID'] . '"><button class="btn btn-success">Choisir</button></a></td>';
                                }else{
                                    echo '<td><button class="btn btn-secondary" disabled>Choisir</button></td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- fin du contenu de la page-->
            </main>
            <?php require_once 'footer.php' ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/tabOrder.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</body>

</html>
