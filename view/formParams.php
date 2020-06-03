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
                    <form class="mt-4" action="?action=editParam" method="POST">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="dateStart">Date de début</label>
                                <input class="form-control" type="text" id="dateStart" name="dateStart" value="$dateStart">
                                <small id="dateStart" class="form-text text-muted">Format : aaaa-mm-jj hh:mm:ss</small>
                            </div>
                            <div class="form-group col-4">
                                <label for="dateEnd">Date de fin</label>
                                <input class="form-control" type="text" id="dateEnd" name="dateEnd" value="$dateEnd">
                                <small id="dateEnd" class="form-text text-muted">Format : aaaa-mm-jj hh:mm:ss</small>
                            </div>
                            <div class="form-group col-4">
                                <label for="nbExpMax">Nombre d'expert maximum par TPI</label>
                                <input class="form-control" type="number" id="nbExpMax" name="nbExpMax" value="$nbExpMax">
                            </div>
                        </div>
                    <button type="submit" name="send" value="send" class="btn btn-success">Enregistrer</button>
                    </form>
                    <!-- fin du contenu de la page-->
                </main>
                <?php require_once 'footer.php'; ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</body>

</html>
