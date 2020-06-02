<?php
$tabValidation = '';

$tab = <<<TABVALIDATION
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
            <th scope="col">Expert 1</th>
            <th scope="col">Expert 2</th>
            <th scope="col">Validation</th>
        </tr>
    </thead>
    <tbody>
TABVALIDATION;

if (in_array('Expert', $_SESSION['roles'][0]) || in_array('Manager', $_SESSION['roles'][0])) {
    $tabValidation = getTPIsOfUser($_SESSION['id']);
}

if (in_array('Administrator', $_SESSION['roles'][0])) {
    $tabValidation = getTPIs();
}

foreach ($tabValidation as $value) {
    if ($value['tpiStatus'] != 'valid') {
        $tab .= '<tr>';
        $tab .= '<td>'. $value['tpiID'] .'</td>';
        $tab .= '<td>'. $value['candidateLastName'] .'</td>';
        $tab .= '<td>'. $value['candidateFirstName'] .'</td>';
        $tab .= '<td>'. $value['companyName'] .'</td>';
        $tab .= '<td>'. $value['managerLastName'] . ' ' . $value['managerFirstName'] .'</td>';
        $tab .= '<td>'. $value['sessionStart'] .'</td>';
        $tab .= '<td>'. $value['sessionEnd'] .'</td>';
        $tab .= '<td>'. $value['title'] .'</td>';
        $tab .= '<td>'. $value['cfcDomain'] .'</td>';
        $tab .= '<td>'. $value['expert1LastName'] . ' ' . $value['expert1FirstName'] .'</td>';
        $tab .= '<td>'. $value['expert2LastName'] . ' ' . $value['expert2FirstName'] .'</td>';
        if (in_array('Expert', $_SESSION['roles'][0]))
        $tab .= '<td><a href="?action=editValidation&tpiID=' . $value['tpiID'] . '"><button class="btn btn-success">Valider</button></a></td>';
        $tab .= '</tr>';
    }
}
$tab .= '</tbody></table>';
