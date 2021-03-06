<?php
$tab = '';
$tabValidation = '';

if (in_array('Expert', $_SESSION['roles'][0])) {
    $tabValidation = getTPIsOfExpert($_SESSION['id']);
}

if (in_array('Manager', $_SESSION['roles'][0])) {
    $tabValidation = getTPIsOfManager($_SESSION['id']);
}

if (in_array('Administrator', $_SESSION['roles'][0])) {
    $tabValidation = getTPIsWExpert();
}
if (empty($tabValidation)) {
    $assigned = false;
}else{
    $assigned = true;
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
        $tab .= '<td>'. $value['tpiStatus'] .'</td>';
        $tab .= '<td>'. $value['expert1LastName'] . ' ' . $value['expert1FirstName'] .'</td>';
        $tab .= '<td>'. $value['expert2LastName'] . ' ' . $value['expert2FirstName'] .'</td>';
        if (!in_array('Candidate', $_SESSION['roles'][0])){
            if ($value['userExpert1ID'] == $_SESSION['id']) {
                $tab .= '<td><a href="?action=checkValidation&tpiID=' . $value['tpiID'] . '&expert=1"><button class="btn btn-success">Voir validation</button></a></td>';
            } elseif ($value['userExpert2ID'] == $_SESSION['id']){
                $tab .= '<td><a href="?action=checkValidation&tpiID=' . $value['tpiID'] . '&expert=2"><button class="btn btn-success">Voir validation</button></a></td>';
            } else{
                $tab .= '<td><a href="?action=checkValidation&tpiID=' . $value['tpiID'] . '"><button class="btn btn-success">Voir validation</button></a></td>';
            }
        }
        $tab .= '</tr>';
    }
}
