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
    $sql = "SELECT tpiID, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID WHERE year = YEAR(CURDATE())";
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

/**
* get TPI information by it ID
* @param int id of the TPI
*/
function getTPIInfoCandidate($id){
    $tpi = getConnexion();
    $sql = "SELECT tpiID, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName, um.companyName as managerCompagny, um.phone as managerPhone, um.email as managerMail, uc.phone as candidatePhone, uc.email as candidateMail, ue1.phone as expert1Phone, ue1.email as expert1Mail, ue2.phone as expert2Phone, ue2.email as expert2Mail, description FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID WHERE tpiID = :id";
    $req = $tpi->prepare($sql);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}
/**
* get criterion of the TPI by it ID
* @param int id of the TPI
*/
function getCriterion($id){
    $tpi = getConnexion();
    $req = $tpi->prepare("SELECT criterionDescription FROM `evaluation_criterions` WHERE tpiID = :id");
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* get TPI validation by it ID
* @param int id of the TPI
*/
function getTPIValidation($id){
    $tpi = getConnexion();
    $req = $tpi->prepare("SELECT * FROM `tpi_validations` AS tec LEFT JOIN evaluation_criterions AS ec ON tec.evaluationCriterionID = ec.evaluationCriterionID WHERE tec.tpiID = :id");
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);

}

/**
* get TPI signature by it ID
* @param int id of the TPI
*/
function getSignExpert($id){
    $tpi = getConnexion();
    $req = $tpi->prepare("SELECT expert1Signature, expert2Signature FROM tpi_evaluations WHERE tpiID = :id");
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}
