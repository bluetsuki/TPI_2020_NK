<?php
/**
 * @author Nguyen Kelly
 * @version 1.0
 */

require_once 'connectDB.php';
/**
* update the value by the name given
* @param string name of the param
* @param string value of the param
*/
function updTPI($tpiId, $expert1 = null, $expert2 = null) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE tpis SET userExpert1ID = :expert1, userExpert2ID = :expert2 WHERE tpiID = :tpiID");
    $req->bindParam(":tpiID", $tpiId, PDO::PARAM_STR);
    $req->bindParam(":expert1", $expert1, PDO::PARAM_INT);
    $req->bindParam(":expert2", $expert2, PDO::PARAM_INT);
    $req->execute();
}

/**
* get all TPIs
*/
function getTPIs(){
    $tpi = getConnexion();
    $sql = "SELECT tpiID, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID";
    $req = $tpi->prepare($sql);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* get all TPIs that haven't got experts
*/
function getTPIsWOExpert(){
    $tpi = getConnexion();
    $sql = "SELECT tpiID, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID WHERE userExpert1ID IS NULL OR userExpert2ID IS NULL";
    $req = $tpi->prepare($sql);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}
