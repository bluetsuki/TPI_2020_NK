<?php
require_once 'model/login.php';

if ($btn == 'send') {
    $email = FILTER_INPUT(INPUT_POST, 'inputEmailAddress', FILTER_SANITIZE_STRING);
    $pwd = FILTER_INPUT(INPUT_POST, 'inputPassword', FILTER_SANITIZE_STRING);

    if (login($email, $pwd)) {
        header('Location: ?action=home');
        exit;
    }else{
        $error = true;
    }
}

require_once 'view/login.php';
