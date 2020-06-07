<?php
/**
 * @author Nguyen Kelly
 * @version 1.0
 */

/**
* update the value by the name given
* @param string $name of the param
* @param string $value of the param
*/
function updParam($name, $value) {
    $upd = getConnexion();
    $req = $upd->prepare("UPDATE params SET value = :value WHERE name = :name");
    $req->bindParam(":name", $name, PDO::PARAM_STR);
    $req->bindParam(":value", $value, PDO::PARAM_STR);
    $req->execute();
}

/**
* get all the params
*/
function getParams() {
    $upd = getConnexion();
    $req = $upd->prepare("SELECT name, value FROM params");
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_KEY_PAIR);
}

/**
* get the param by the name
* @param string $name of the value
*/
function getParamsByName($name) {
    $upd = getConnexion();
    $req = $upd->prepare("SELECT value FROM params WHERE name = :name");
    $req->bindParam(':name', $name, PDO::PARAM_STR);
    $req->execute();
    return $res = $req->fetchAll(PDO::FETCH_ASSOC);
}
