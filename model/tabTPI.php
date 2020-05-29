<?php
require_once 'connectDB.php';
require_once 'crudWishes.php';
require_once 'crudParams.php';

$by = FILTER_INPUT(INPUT_GET, 'by', FILTER_SANITIZE_STRING);
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'idTPI', FILTER_SANITIZE_STRING);
echo $tpiChoosen;

if (is_numeric($by) && is_numeric($tpiChoosen)) {
    addWishe($by, $tpiChoosen);
}

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

foreach ($res as $key => $value) {
    echo '<tr>';
    echo '<th scope="row">' . $value['tpiID'] . '</th>';
    echo '<td>' . $value['candidateLastName'] . '</td>';
    echo '<td>' . $value['candidateFirstName'] . '</td>';
    echo '<td>' . $value['companyName'] . '</td>';
    echo '<td>' . $value['managerLastName'] . ' ' . $value['managerFirstName'] . '</td>';
    echo '<td>' . $value['sessionStart'] . '</td>';
    echo '<td>' . $value['sessionEnd'] . '</td>';
    echo '<td><a href="pdf/' . $value['pdfPath'] . '">' . $value['title'] . '</a></td>';
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
    if ($nbExpert < getParamsByName('NbMaxExpertForOneCandidate')[0]['value']) {
        // @TODO by=id to change when the management of roles is done
        // display this when the user is a expert
        // echo '<td><a href="?action=tpi&by=277&idTPI=' . $value['tpiID'] . '"><button class="btn btn-success">Choisir</button></a></td>';

        // display this when the user is the user is the expert manager
        echo '<td><a href="?action=selectExpert&idTPI=' . $value['tpiID'] . '"><button class="btn btn-success">Choisir Expert</button></a></td>';

    }else{
        // echo '<td><button class="btn btn-secondary" disabled>Choisir</button></td>';

        // display this when the user is the user is the expert manager
        echo '<td><a href="?action=selectExpert&idTPI=' . $value['tpiID'] . '"><button class="btn btn-secondary">Choisir Expert</button></a></td>';
    }
    echo '</tr>';
}
