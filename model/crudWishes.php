<?php
/**
 * @author Nguyen Kelly
 * @version 1.0
 */

/**
* Insert a wishe in the table wishes
* @param int idExpert is the Id of the Expert assign to the TPI
* @param int tpiId is the ID of the TPI
*/
function addWish($idExpert, $tpiId)
{
    $connexion = getConnexion();
    $req = $connexion->prepare("INSERT INTO wishes (userExpertID, tpiID) VALUES (:expert, :tpiID)");
    $req->bindParam(":expert", $idExpert, PDO::PARAM_INT);
    $req->bindParam(":tpiID", $tpiId, PDO::PARAM_INT);
    $req->execute();

}

/**
* Delete a wishe by it id
* @param int idExpert
* @param int id of the TPI
*/
function rmWish($idExpert, $id){
    $rm = getConnexion();
    $req = $rm->prepare("DELETE FROM wishes WHERE userExpertID = :idExpert AND tpiID = :id");
    $req->bindParam(":idExpert", $idExpert, PDO::PARAM_INT);
    $req->bindParam(":id", $id, PDO::PARAM_INT);
    $req->execute();
}

/**
* get all wishes of the TPI by it ID that hasn't been assigned
* @param int id of the TPI
*/
function getWishesByTpiIdAssignedAssignedNull($id){
    $wishes = getConnexion();
    $req = $wishes->prepare("SELECT userExpertID, lastName as expertLastName, firstName as expertFirstName, `tpiID`, assigned
        FROM `wishes` AS w
        LEFT JOIN users AS ue1 ON w.userExpertID = ue1.userID
        WHERE assigned IS NULL
        AND tpiID = :id");
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* get all wishes of the TPI by it ID that has been assigned
* @param int id of the TPI
*/
function getWishesByTpiIdAssigned($id){
    $wishes = getConnexion();
    $req = $wishes->prepare("SELECT userExpertID, lastName as expertLastName, firstName as expertFirstName, `tpiID`, assigned
        FROM `wishes` AS w
        LEFT JOIN users AS ue1 ON w.userExpertID = ue1.userID
        WHERE tpiID = :id
        AND assigned IS NOT NULL");
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* get all wishes of the TPI by it ID
* @param int id of the TPI
*/
function getWishesByTpiId($id){
    $wishes = getConnexion();
    $req = $wishes->prepare("SELECT tpiID, assigned FROM `wishes` WHERE tpiID = :id");
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetch(PDO::FETCH_KEY_PAIR);
}

/**
* get the wish of the user by ids
* @param int id of the TPI
*/
function getWishUser($idExpert, $tpiID){
    $wishes = getConnexion();
    $req = $wishes->prepare("SELECT userExpertID, tpiID FROM `wishes` WHERE userExpertID = :id AND tpiID = :tpiID");
    $req->bindParam(':id', $idExpert, PDO::PARAM_INT);
    $req->bindParam(':tpiID', $tpiID, PDO::PARAM_INT);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* update the value by the name given
* @param string name of the param
* @param string value of the param
*/
function updWish($idExpert, $tpi, $assigned = null) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE `wishes` SET `assigned` = :assigned WHERE `userExpertID` = :expert AND `tpiID` = :tpi");
    $req->bindParam(":expert", $idExpert, PDO::PARAM_INT);
    $req->bindParam(":assigned", $assigned, PDO::PARAM_INT);
    $req->bindParam(":tpi", $tpi, PDO::PARAM_INT);
    $req->execute();
}
