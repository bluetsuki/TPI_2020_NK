<?php
/**
* Insert a wishe in the table wishes
* @param int idExpert is the Id of the Expert assign to the TPI
* @param int tpiId is the ID of the TPI
* @param int assigned is the number max of expert assign to the TPI
*/
function addWishe($idExpert, $tpiId, $assigned = null)
{
    $connexion = getConnexion();
    $req = $connexion->prepare("INSERT INTO wishes (userExpertID, tpiID, assigned) VALUES (:expert, :tpiID, :assigned)");
    $req->bindParam(":expert", $comment, PDO::PARAM_INT);
    $req->bindParam(":tpiID", $date, PDO::PARAM_INT);
    $req->bindParam(":assigned", $date, PDO::PARAM_INT);
    return $req->execute();
}

/**
* Delete a wishe by it id
* @param int tpiID
*/
function rmMedia($id){
    $rm = getConnexion();
    $req = $rm->prepare("DELETE FROM wishes WHERE tpiID = :id");
    $req->bindParam(":id", $id, PDO::PARAM_INT);
    $req->execute();
}

/**
* get all wishes
*/
function getWishes(){
    $wishes = getConnexion();
    $req = $wishes->prepare("SELECT userExpertID, tpiID, assigned FROM wishes");
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* update the value by the name given
* @param string name of the param
* @param string value of the param
*/
function updParam($idExpert, $tpi, $assigned = null) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE wishes SET userExpertID = :expert, assigned = :assigned WHERE tpiID = :tpi");
    $req->bindParam(":expert", $idExpert, PDO::PARAM_INT);
    $req->bindParam(":assigned", $assigned, PDO::PARAM_INT);
    $req->bindParam(":tpi", $tpi, PDO::PARAM_INT);
    $req->execute();
}
