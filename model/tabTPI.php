<?php
require_once 'connectDB.php';

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

$query = "SELECT tpiID, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userCandidateID = um.userID LEFT JOIN users AS ue1 ON userCandidateID = ue1.userID LEFT JOIN users AS ue2 ON userCandidateID = ue2.userID";

$sqlField = ['tpiID', 'uc.LastName', 'uc.FirstName', 'um.LastName', 'um.FirstName', 'companyName', 'ue1.LastName', 'ue1.FirstName', 'ue2.LastNane', 'ue2.FirstName', 'sessionStart', 'sessionEnd', 'title', 'cfcDomain'];

$sqlField2 = ['tpiID', 'candidateLastName', 'candidateFirstName', 'managerLastName', 'managerFirstName', 'companyName', 'expert1LastName', 'expert1FirstName', 'expert2LastName', 'expert2FirstName', 'sessionStart', 'sessionEnd', 'title', 'cfcDomain'];

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
