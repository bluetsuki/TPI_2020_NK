<?php
/**
* update the value by the name given
* @param string name of the param
* @param string value of the param
*/
function updParam($name, $value) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE params SET value = :value WHERE name = :name");
    $req->bindParam(":name", $id, PDO::PARAM_STR);
    $req->bindParam(":value", $id, PDO::PARAM_STR);
    $req->execute();
}
