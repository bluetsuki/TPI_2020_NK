<?php
/**
* @author Nguyen Kelly
* @version 1.0
*/

require_once 'connectDB.php';

/**
* update the userExpert1ID by the ID given
* @param int tpiID
* @param int expertID
*/
function updTPIExp1($tpiID, $expertID) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE `tpis` SET `userExpert1ID` = :expert1 WHERE `tpis`.`tpiID` = :tpiID");
    $req->bindParam(":tpiID", $tpiID, PDO::PARAM_INT);
    $req->bindParam(":expert1", $expertID, PDO::PARAM_INT);
    $req->execute();
}

/**
* update the userExpert1ID by the ID given
* @param int tpiID
* @param int expertID
*/
function updTPIExp2($tpiID, $expertID) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE `tpis` SET `userExpert2ID` = :expert2 WHERE `tpis`.`tpiID` = :tpiID");
    $req->bindParam(":tpiID", $tpiID, PDO::PARAM_INT);
    $req->bindParam(":expert2", $expertID, PDO::PARAM_INT);
    $req->execute();
}

/**
* update the status of the TPI
* @param int tpiID
* @param int stat of the TPI
*/
function updStatus($tpiId, $stat) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE `tpis` SET `tpiStatus` = :stat WHERE `tpiID` = :tpiID");
    $req->bindParam(":tpiID", $tpiId, PDO::PARAM_INT);
    $req->bindParam(":stat", $stat, PDO::PARAM_STR);
    $req->execute();
}

/**
* get all TPIs
*/
function getTPIs(){
    $tpi = getConnexion();
    $sql = "SELECT tpiID, pdfPath, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, userExpert2ID, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID WHERE year = YEAR(CURDATE())";
    $req = $tpi->prepare($sql);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* get all TPIs by id
* @param int id of the TPI
*/
function getTPIsById($id){
    $tpi = getConnexion();
    $sql = "SELECT tpiID, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, userExpert2ID, pdfPath, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID WHERE tpiID = :id";
    $req = $tpi->prepare($sql);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* get all TPIs that has experts assigned
*/
function getTPIsWExpert(){
    $tpi = getConnexion();
    $sql = "SELECT tpiID, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, userExpert2ID, pdfPath, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID WHERE userExpert1ID IS NOT NULL AND userExpert2ID IS NOT NULL ORDER BY tpiID";
    $req = $tpi->prepare($sql);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* get all TPIs of the manager
* @param int id of the manager
*/
function getTPIsOfManager($idUser){
    $tpi = getConnexion();
    $sql = "SELECT tpiID, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, userExpert2ID, pdfPath, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID WHERE userManagerID = :idUser AND userExpert1ID IS NOT NULL AND userExpert2ID IS NOT NULL ORDER BY tpiID";
    $req = $tpi->prepare($sql);
    $req->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* get all TPIs of the expert
* @param int id of expert
*/
function getTPIsOfExpert($idUser){
    $tpi = getConnexion();
    $sql = "SELECT tpiID, year, tpiStatus, title, cfcDomain, sessionStart, sessionEnd, presentationDate, workplace, userCandidateID, userManagerID, userExpert1ID, userExpert2ID, pdfPath, uc.LastName AS candidateLastName, uc.FirstName AS candidateFirstName, um.LastName AS managerLastName, um.FirstName AS managerFirstName, ue1.LastName AS expert1LastName, ue1.FirstName AS expert1FirstName, ue2.LastName AS expert2LastName, ue2.FirstName AS expert2FirstName, tpiStatus, submissionDate, uc.companyName FROM tpis LEFT JOIN users AS uc ON userCandidateID = uc.userID LEFT JOIN users AS um ON userManagerID = um.userID LEFT JOIN users AS ue1 ON userExpert1ID = ue1.userID LEFT JOIN users AS ue2 ON userExpert2ID = ue2.userID WHERE userExpert1ID = :idUser OR userExpert2ID = :idUser";
    $req = $tpi->prepare($sql);
    $req->bindParam(':idUser', $idUser, PDO::PARAM_INT);
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
