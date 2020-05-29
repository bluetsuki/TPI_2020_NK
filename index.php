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

    // $permission = [
    //     "Nobody"=>[
    //         "default" => "login",
    //         "home" => "home",
    //         "tpi" => "tabTPI",
    //         "selectTPI" => "selectTPI",
    //         "logout" => "logout",
    //         "formParams" => "formParams",
    //         "selectExpert" => "selectExpert",
    //         "logout" => "logout"
    //     ],
    //     "Administrator" => [
    //         "default" => "login",
    //         "home" => "home",
    //     ],
    //     "Candidate" => [
    //         "default" => "login",
    //     ],
    //     "Expert" => [
    //         "default" => "login",
    //         "home" => "home",
    //         "tpi" => "tabTPI",
    //         "slctTPI" => "selectTPI"
    //     ],
    //     "Manager" => [
    //         "default" => "login",
    //         "home" => "home",
    //         "tpi" => "tabTPI",
    //         "slctTPI" => "selectTPI"
    //     ]
    // ];

    // if (!array_key_exists($action, $permission[$role])) {
    //     $action = "default";
    // }

    var_dump($_SESSION['rights']);
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
