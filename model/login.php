<?php
require_once 'connectDB.php';

$btn = FILTER_INPUT(INPUT_POST, 'send', FILTER_SANITIZE_STRING);
if ($btn == 'send') {
    $email = FILTER_INPUT(INPUT_POST, 'inputEmailAddress', FILTER_SANITIZE_STRING);
    $pwd = FILTER_INPUT(INPUT_POST, 'inputPassword', FILTER_SANITIZE_STRING);
    if (login($email, $pwd)) {
        // header('Location: ?action=home');
        // exit;
    }
}

//SHA1(CONCAT($pwdFourniParLutilisateur,pwdSalt)) = pwdHash

function login($email, $pwd){
    $log = getConnexion();
    $req = $log->prepare("SELECT userID, lastName, firstName, email, pwdHash, pwdSalt FROM users WHERE email = :email");
    $req->bindParam(':email', $email, PDO::PARAM_STR);
    $req->execute();
    $res = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $key => $value) {
        echo $value['pwdHash'] . '<br>' . SHA1($pwd . $value['pwdSalt']);
        if ($value['pwdHash'] == SHA1($pwd . $value['pwdSalt'])) {
            $_SESSION['role'] = getRole($value['userID']);
            $_SESSION['name'] = $value['lastName'] . $value['firstName'];
            return true;
        }
    }
    return false;
}

function getRole($id){
    $role = getConnexion();
    $req = $role->prepare("SELECT roleName FROM user_roles LEFT JOIN roles AS r ON user_roles.roleID = r.roleID WHERE userID = :id");
    $req->bindParam(':id', $id, PDO::PARAM_STR);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
