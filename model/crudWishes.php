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
function addWishe($idExpert, $tpiId)
{
    try {
        $connexion = getConnexion();
        $req = $connexion->prepare("INSERT INTO wishes (userExpertID, tpiID) VALUES (:expert, :tpiID)");
        $req->bindParam(":expert", $idExpert, PDO::PARAM_INT);
        $req->bindParam(":tpiID", $tpiId, PDO::PARAM_INT);
        $req->execute();
        // return $req->debugDumpParams();
    } catch (\Exception $e) {
        return $e;
    }

}

/**
* Delete a wishe by it id
* @param int tpiID
*/
function rmWishe($idExpert, $id){
    $rm = getConnexion();
    $req = $rm->prepare("DELETE FROM wishes WHERE tpiID = :id AND userExpertID = :idExpert");
    $req->bindParam(":id", $id, PDO::PARAM_INT);
    $req->bindParam(":idExpert", $idExpert, PDO::PARAM_INT);
    $req->execute();
}

/**
* get all wishes of the TPI by it ID that hasn't been assigned
* @param int id of the TPI
*/
function getWishesByTpiIdAssignedNull($id){
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
function getWishesByTpiId($id){
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

function getWishesUser($idExpert, $tpiID){
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
function updWishe($idExpert, $tpi, $assigned = null) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE `wishes` SET `assigned` = :assigned WHERE `userExpertID` = :expert AND `tpiID` = :tpi");
    $req->bindParam(":expert", $idExpert, PDO::PARAM_INT);
    $req->bindParam(":assigned", $assigned, PDO::PARAM_INT);
    $req->bindParam(":tpi", $tpi, PDO::PARAM_INT);
    $req->execute();
}
