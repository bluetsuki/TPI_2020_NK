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
                                <th scope="col">Statut</th>
                                <th scope="col">Expert 1</th>
                                <th scope="col">Expert 2</th>
                                <th scope="col">Validation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $tab ?>
                        </tbody>
                    </table>
                    <div class="mx-auto" style="width: 400px;">
                        <?= !$assigned ? '<h3 class="text-danger">Vous n\'êtes assigné à aucun TPI</h3>' : ''?>
                    </div>
                </div>
                <!-- fin du contenu de la page-->
            </main>
            <?php require_once 'footer.php'; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</body>

</html>
