<?php
require_once 'connectDB.php';

/**
* add criterions in the table tpi_validations with the tpiID
* @param int $tpiID
* @param string $crit is the string of criterions with a delimiter ';'
*/
function addCrit($tpiID, $crit){
    $add = getConnexion();
    $req = $add->prepare("INSERT INTO tpi_validations (tpiID, criterions) VALUES (:tpiID, :crit)");
    $req->bindParam(':tpiID', $tpiID, PDO::PARAM_INT);
    $req->bindParam(':crit', $crit, PDO::PARAM_STR);
    $req->execute();
}

/**
* get TPI validation by it ID
* @param int $id of the TPI
*/
function getValidation($id){
    $tpi = getConnexion();
    $req = $tpi->prepare("SELECT * FROM `tpi_validations` WHERE tpiID = :id");
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);

}

/**
* get TPI signature by it ID
* @param int $id of the TPI
*/
function getSignExpert($id){
    $tpi = getConnexion();
    $req = $tpi->prepare("SELECT expert1Signature, expert2Signature FROM tpi_validations WHERE tpiID = :id");
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetch();
}

/**
* update the criterions of the TPI
* @param int $tpiID
* @param string $crit is the criterions of the TPI, the delimitation is ';'
*/
function updCriterions($tpiID, $crit) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE `tpi_validations` SET `criterions` = :crit WHERE `tpiID` = :tpiID");
    $req->bindParam(':crit', $crit, PDO::PARAM_STR);
    $req->bindParam(':tpiID', $tpiID, PDO::PARAM_STR);
    $req->execute();
}

/**
* update the comment of the TPI
* @param int $tpiID
* @param string $comment is the comment of the TPI
*/
function updComment($tpiID, $comment) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE `tpi_validations` SET `comment` = :comment WHERE `tpiID` = :tpiID");
    $req->bindParam(':comment', $comment, PDO::PARAM_STR);
    $req->bindParam(':tpiID', $tpiID, PDO::PARAM_INT);
    $req->execute();
}

/**
* update the signature of the Expert define by the parameter
* @param int $tpiID
* @param string $sign is the signature of the Expert by the format 'Y-m-d H:i:s'
* @param string $expert is use to define the expert 1 or 2
*/
function updExpertSign($tpiID, $sign, $expert) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE `tpi_validations` SET $expert = :expertSign WHERE `tpiID` = :tpiID");
    if ($sign == '') {
        $sign = NULL;
        $req->bindParam(':expertSign', $sign, PDO::PARAM_NULL);
    }else{
        $req->bindParam(':expertSign', $sign, PDO::PARAM_STR);
    }
    $req->bindParam(':tpiID', $tpiID, PDO::PARAM_INT);
    $req->execute();
}

/**
* update the pdfPath of the TPI
* @param int $tpiID
* @param string $path is the path of the PDF by the format of 'Validation_TPI_YEAR_tpiID_CandidateName'
*/
function updPdfPath($tpiID, $path) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE `tpi_validations` SET `pdfPath` = :pdfPath WHERE `tpiID` = :tpiID");
    $req->bindParam(':pdfPath', $path, PDO::PARAM_STR);
    $req->bindParam(':tpiID', $tpiID, PDO::PARAM_INT);
    $req->execute();
}
