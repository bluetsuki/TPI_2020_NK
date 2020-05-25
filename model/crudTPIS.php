<?php
require_once 'connectDB.php';
/**
* update the value by the name given
* @param string name of the param
* @param string value of the param
*/
function updParam($tpiId, $expert1 = null, $expert2 = null) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE params SET userExpert1ID = :expert1, userExpert2ID = :expert2 WHERE tpiID = :tpiID");
    $req->bindParam(":tpiID", $tpiId, PDO::PARAM_STR);
    $req->bindParam(":expert1", $expert1, PDO::PARAM_INT);
    $req->bindParam(":expert2", $expert2, PDO::PARAM_INT);
    $req->execute();
}

/**
* get all TPIs
*/
function getTpi(){
    $tpi = getConnexion();
    $req = $tpi->prepare("SELECT ( SELECT lastName FROM users WHERE userID = tpis.userCandidateID ) as 'Name', ( SELECT firstName FROM users WHERE userID = tpis.userCandidateID ) as 'firstName', ( SELECT companyName FROM users WHERE userID = tpis.userCandidateID ) as 'companyName', ( SELECT lastName FROM users WHERE userID = tpis.userManagerID ) as 'projectManager', sessionStart, sessionEnd, title, cfcDomain, ( SELECT lastName from users WHERE userID = tpis.userExpert1ID) as 'expert1', ( SELECT lastName from users WHERE userID = tpis.userExpert2ID) as 'expert2' FROM `tpis`, users");
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}
