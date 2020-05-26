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
    <style>
    th[onclick] {
        cursor: pointer;
    }

    #model {
        visibility: hidden;
    }

    #colNameModel {
        visibility: hidden;
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php require_once 'navH.php'; ?>
    <div id="layoutSidenav">
        <?php require_once 'navV.php'; ?>
        <div id="layoutSidenav_content">
        <main>
            <!-- Début du contenu de la page -->
            <div class="container-fluid">
                <div class="alert alert-primary mt-2">
                    Info
                    <br>simple clique : tri selon la colonne
                    <br> shift + clique : inverse l'ordre de tri (ou ajoute en ascendant si absent du tri)
                    <br> ctrl + clique : ajoute ou supprime une colonne du tri
                </div>
                <div id="form"></div>
                <button class="btn btn-outline-success mt-2 mb-2" onclick="addFilter()">Ajouter une condition</button>
                <table class="table">
                    <thead>
                        <tr id="colName">
                            <th scope="col">#</th>
                            <th id="candidateLastName" onclick="setOrder(this)" scope="col">Nom</th>
                            <th id="candidateFirstName" onclick="setOrder(this)" scope="col">Prénom</th>
                            <th id="companyName" onclick="setOrder(this)" scope="col">Entreprise</th>
                            <th id="managerLastName" onclick="setOrder(this)" scope="col">Chef de projet</th>
                            <th id="sessionStart" onclick="setOrder(this)" scope="col">Date de début</th>
                            <th id="sessionEnd" onclick="setOrder(this)" scope="col">Date de fin</th>
                            <th id="title" onclick="setOrder(this)" scope="col">Titre</th>
                            <th id="cfcDomain" onclick="setOrder(this)" scope="col">Domaine</th>
                            <th id="expert1LastName" onclick="setOrder(this)" scope="col">Expert 1</th>
                            <th id="expert1LastName" onclick="setOrder(this)" scope="col">Expert 2</th>
                        </tr>
                    </thead>
                    <tbody id="dataContainer">
                        <?php
                        foreach (getTPIs() as $key => $value) {
                            echo '<tr><th scope="row">' . $key . '</th>';
                            echo '<td>' . $value['candidateLastName'] . '</td>';
                            echo '<td>' . $value['candidateFirstName'] . '</td>';
                            echo '<td>' . $value['companyName'] . '</td>';
                            echo '<td>' . $value['managerLastName'] . ' ' . $value['managerFirstName'] . '</td>';
                            echo '<td>' . $value['sessionStart'] . '</td>';
                            echo '<td>' . $value['sessionEnd'] . '</td>';
                            echo '<td>' . $value['title'] . '</td>';
                            echo '<td>' . $value['cfcDomain'] . '</td>';
                            echo '<td>' . $value['expert1LastName'] . ' ' . $value['expert2FirstName'] . '</td>';
                            echo '<td>' . $value['expert1LastName'] . ' ' . $value['expert2FirstName'] . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <table id="colNameModel">
                    <thead>
                        <tr id="colName">
                            <th scope="col">#</th>
                            <th id="candidateLastName" onclick="setOrder(this)" scope="col">Nom</th>
                            <th id="candidateFirstName" onclick="setOrder(this)" scope="col">Prénom</th>
                            <th id="companyName" onclick="setOrder(this)" scope="col">Entreprise</th>
                            <th id="managerLastName" onclick="setOrder(this)" scope="col">Chef de projet</th>
                            <th id="sessionStart" onclick="setOrder(this)" scope="col">Date de début</th>
                            <th id="sessionEnd" onclick="setOrder(this)" scope="col">Date de fin</th>
                            <th id="title" onclick="setOrder(this)" scope="col">Titre</th>
                            <th id="cfcDomain" onclick="setOrder(this)" scope="col">Domaine</th>
                            <th id="expert1LastName" onclick="setOrder(this)" scope="col">Expert 1</th>
                            <th id="expert1LastName" onclick="setOrder(this)" scope="col">Expert 2</th>
                        </tr>
                    </thead>
                </table>
                <div class="form-inline mt-1" id="model">
                    <select class="form-control" onchange="updateFilter()">
                        <option value="uc.LastName">Nom</option>
                        <option value="uc.FirstName">Prénom</option>
                        <option value="companyName">Entreprise</option>
                        <option value="um.LastName">Chef de projet</option>
                        <option value="sessionStart">Date de début</option>
                        <option value="sessionEnd">Date de fin</option>
                        <option value="title">Titre</option>
                        <option value="cfcDomain">Domaine</option>
                        <option value="ue1.LastName">Expert 1</option>
                        <option value="ue2.LastName">Expert 2</option>
                    </select>
                    <select class=" ml-1 form-control" onchange="updateFilter()">
                        <option>=</option>
                        <option><=</option>
                        <option><</option>
                        <option>></option>
                        <option>>=</option>
                        <option value="like">comme</option>
                    </select>
                    <input type="text" class="ml-1 form-control" onchange="updateFilter()" onkeypress="updateFilter()" onkeydown="updateFilter()" onkeyup="updateFilter()">
                    <button class="ml-1 btn btn-outline-danger" onclick="removeFilter(this.parentNode)">Supprimer</button>
                </div>
            </div>
            <!-- fin du contenu de la page-->
        </main>
        <?php require_once 'footer.php' ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/tabOrder.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</body>

</html>
