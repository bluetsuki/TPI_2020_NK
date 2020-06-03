<?php
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'idTPI', FILTER_SANITIZE_STRING);
$idExpert = FILTER_INPUT(INPUT_GET, 'idExpert', FILTER_SANITIZE_STRING);
$assigned = FILTER_INPUT(INPUT_GET, 'assigned', FILTER_SANITIZE_STRING);

$tab = "";

$nbExpert = 0;
foreach (getTPIsById($tpiChoosen) as $value) {
    $tab .= '<td>' . $value['tpiID'] . '</td>';
    $tab .= '<td>' . $value['candidateLastName'] . '</td>';
    $tab .= '<td>' . $value['candidateFirstName'] . '</td>';
    $tab .= '<td>' . $value['companyName'] . '</td>';
    $tab .= '<td>' . $value['managerLastName'] . ' ' . $value['managerFirstName'] . '</td>';
    $tab .= '<td>' . $value['sessionStart'] . '</td>';
    $tab .= '<td>' . $value['sessionEnd'] . '</td>';
    $tab .= '<td><a href="pdf/Enonce_TPI_'. $value['year'] .'_'. $value['tpiID'] .'_'. $value['candidateLastName'] .'_'. $value['candidateFirstName'] .'.pdf">' . $value['title'] . '</a></td>';
    $tab .= '<td>' . $value['cfcDomain'] . '</td>';
    $tab .= '<td>';
    $names = getWishesByTpiIdAssignedNull($value['tpiID']);
    $nbExpertAssigned = count(getWishesByTpiId($value['tpiID']));
    foreach ($names as $key => $name) {
        $key++;
        $tab .= '<div class="row">';
        $tab .= '<div class="col-5">' . $key . '. ' . $name['expertLastName'] . ' ' . $name['expertFirstName'] . '</div>';
        if ($nbExpertAssigned < 2) {
            $tab .= '<a href="?action=chooseExpert&idTPI=' . $value['tpiID'] . '&idExpert=' . $name['userExpertID'] . '&assigned=1"><button class="ml-2 mb-2 btn btn-outline-success">Expert 1</button></a>';
            $tab .= '<a href="?action=chooseExpert&idTPI=' . $value['tpiID'] . '&idExpert=' . $name['userExpertID'] . '&assigned=2"><button class="ml-2 mb-2 btn btn-outline-success">Expert 2</button></a></div><br>';
        }else{
            $tab .= '<a><button class="ml-2 mb-2 btn btn-secondary" disabled>Expert 1</button></a>';
            $tab .= '<a><button class="ml-2 mb-2 btn btn-secondary" disabled>Expert 2</button></a></div><br>';
        }
    }
    $tab .= '</td></tr>';
}
