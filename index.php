<?php
/**
* @author Nguyen Kelly
* @version 1.0
*/

session_start();

if (!empty($_SESSION['rights'])) {

    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

    if(isset($_SESSION['roles']))
        $role = $_SESSION['roles'];
    else
        $role = "Nobody";

    if (!in_array($action, $_SESSION['rights'][0])) {
        $action = "home";
    }

    try {
        require './controller/'. $action .'.php';
    } catch (Exception $e) {

    }
}else{
    try {
        require './controller/login.php';
    } catch (Exception $e) {

    }
}
