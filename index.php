<?php
/**
 * @author Nguyen Kelly
 * @version 1.0
 */
session_start();
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

if(isset($_SESSION['role']))
    $role = $_SESSION['role'];
else
    $role = "Nobody";

$permission = [
    "Nobody"=>[
        "default" => "login",
        "home" => "home",
        "tpi" => "tabTPI",
    ],
    "Administrator" => [
        "default" => "login",
        "home" => "home",
    ],
    "Candidate" => [
        "default" => "login",
        "home" => "home",
    ],
    "Expert" => [
        "default" => "login",
        "home" => "home",
    ],
    "Manager" => [
        "default" => "login",
        "home" => "home",
    ]
];

if (!array_key_exists($action, $permission[$role])) {
    $action = "default";
}

try {
    require './controller/'.$permission[$role][$action].'.php';
} catch (Exception $e) {

}
