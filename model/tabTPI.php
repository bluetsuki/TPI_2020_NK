<?php
require_once 'connectDB.php';
require_once 'crudWishes.php';
require_once 'crudParams.php';

session_start();

$order = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_STRING);
$order = utf8_encode($order);
$order = str_replace('&#34;', '"', $order);
$order = str_replace('\\;', '', $order);
$tblorder = json_decode($order);

$limit =  filter_input(INPUT_GET, 'limit', FILTER_SANITIZE_NUMBER_INT);
$page =  filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);

$filter = filter_input(INPUT_GET, 'filter');
$filter = utf8_encode($filter);
$filter = str_replace('&#34;', '"', $filter);
$filter = str_replace('\\', '', $filter);
$tblfilter = json_decode($filter, true);

$query = "SELECT tpiID, pdfPath, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID";

$sqlField = ['tpiID', 'pdfPath', 'uc.LastName', 'uc.FirstName', 'um.LastName', 'um.FirstName', 'companyName', 'ue1.LastName', 'ue1.FirstName', 'ue2.LastNane', 'ue2.FirstName', 'sessionStart', 'sessionEnd', 'title', 'cfcDomain', 'tpiStatus'];

$sqlField2 = ['tpiID', 'pdfPath', 'candidateLastName', 'candidateFirstName', 'managerLastName', 'managerFirstName', 'companyName', 'expert1LastName', 'expert1FirstName', 'expert2LastName', 'expert2FirstName', 'sessionStart', 'sessionEnd', 'title', 'cfcDomain', 'tpiStatus'];

$conditionOperator = ['=', '<=', '<', '>', '>=', 'like'];

$conditionValue = [];

if (!empty($tblfilter)) {
    $query .= " WHERE ";
    foreach ($tblfilter as $key => $value) {
        if (in_array($key, $sqlField)) {
            if (array_key_first($tblfilter) == $key){
                $query .= " (";
            }else{
                $query .= " AND (";
            }
            foreach ($value as $condition) {
                $count = count($conditionValue);
                if (in_array($condition[0], $conditionOperator)) {
                    if ($condition[0] == 'like') {
                        array_push($conditionValue, '%' . $condition[1] . '%');
                    }else {
                        array_push($conditionValue, $condition[1]);
                    }
                    if ($value[0] == $condition) {
                        $query .= $key . ' ' . $condition[0] . ' :param' . $count;
                    }
                    else {
                        $query .= ' OR ' . $key . ' ' . $condition[0] . ' :param' . $count;
                    }
                }
            }
            $query .= ")";
        }
    }
}

if (!empty($tblorder)) {

    foreach($tblorder as $key => $col){
        if (($col[1] == 'ASC' || $col[1] == 'DESC') && in_array($col[0], $sqlField2)) {
            if (array_key_first($tblorder) == $key){
                $query .= " ORDER BY " . $col[0] . " " . $col[1];
            }else{
                $query .= ", " . $col[0] . " " . $col[1];
            }
        }
    }
}

$order = getConnexion();
$req = $order->prepare($query);

for ($i = 0; $i < count($conditionValue); $i++) {
    $req->bindParam(":param" . $i, $conditionValue[$i], PDO::PARAM_STR);
}

$req->execute();
$res = $req->fetchAll(PDO::FETCH_ASSOC);
//Display the table in the page tabTPI
foreach ($res as $key => $value) {
    echo '<tr>';
    echo '<th scope="row">' . $value['tpiID'] . '</th>';
    echo '<td>' . $value['candidateLastName'] . '</td>';
    echo '<td>' . $value['candidateFirstName'] . '</td>';
    echo '<td>' . $value['companyName'] . '</td>';
    echo '<td>' . $value['managerLastName'] . ' ' . $value['managerFirstName'] . '</td>';
    echo '<td>' . $value['sessionStart'] . '</td>';
    echo '<td>' . $value['sessionEnd'] . '</td>';
    echo '<td><a href="?action=displayPDF&link=pdf/' . $value['pdfPath'] . '">' . $value['title'] . '</a></td>';
    echo '<td>' . $value['cfcDomain'] . '</td>';
    echo '<td>' . $value['tpiStatus'] . '</td>';
    echo '<td>' . $value['expert1LastName'] . ' ' . $value['expert1FirstName'] . '</td>';
    echo '<td>' . $value['expert2LastName'] . ' ' . $value['expert2FirstName'] . '</td>';
    echo '<td>';
    $names = getWishesByTpiIdAssignedNull($value['tpiID']);
    $nbExpert = count($names);
    foreach ($names as $key => $name) {
        $key++;
        echo $key . '. ' . $name['expertLastName'] . ' ' . $name['expertFirstName'] . '<br>';
    }
    echo '</td>';
    //If the number of expert choices is inferior of the number max of expert per TPI (in table params)
    if ($nbExpert < getParamsByName('NbMaxExpertForOneCandidate')[0]['value']) {
        echo '<td>';
        if (in_array('Expert', $_SESSION['roles'][0])) {
            if (getWishUser($_SESSION['id'], $value['tpiID'])) {
                echo '<a href="?action=displayTPI&idTPI=' . $value['tpiID'] . '&rm=true"><button class="btn btn-danger">Annuler</button></a>';
            }else{
                if (empty($value['expert1LastName']) || empty($value['expert2LastName'])) {
                    echo '<a href="?action=displayTPI&idTPI=' . $value['tpiID'] . '"><button class="btn btn-success">Choisir</button></a>';
                }else{
                    echo '<a><button class="btn btn-secondary" disabled>Choisir</button></a>';
                }
            }
        }

        if (in_array('Administrator', $_SESSION['roles'][0])){
            if (empty($value['expert1LastName']) || empty($value['expert2LastName'])) {
                echo '<a href="?action=chooseExpert&idTPI=' . $value['tpiID'] . '"><button class="btn btn-success">Choisir Expert</button></a>';
            }
            else{
                echo '<a><button class="btn btn-secondary" disabled>Choisir Expert</button></a>';
            }
        }
        echo '</td>';
    }else{
        echo '<td>';
        if (in_array('Expert', $_SESSION['roles'][0])) {
            if (getWishUser($_SESSION['id'], $value['tpiID'])) {
                echo '<a href="?action=displayTPI&idTPI=' . $value['tpiID'] . '&rm=true"><button class="btn btn-danger">Annuler</button></a>';
            }else{
                echo '<button class="btn btn-secondary" disabled>Choisir</button>';
            }
        }
        if (in_array('Administrator', $_SESSION['roles'][0])){
                echo '<a href="?action=chooseExpert&idTPI=' . $value['tpiID'] . '"><button class="btn btn-secondary">Choisir Expert</button></a>';
        }
        echo '</td>';
    }
    echo '</tr>';

}
