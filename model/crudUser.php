<?php
/**
* Log the user with the email and check the password and add roles and rights to the session
* @param string $email of the user
* @param string $pwd of the user
*/
function login($email, $pwd){
    $log = getConnexion();
    $req = $log->prepare("SELECT userID, lastName, firstName, email, pwdHash, pwdSalt FROM users WHERE email = :email");
    $req->bindParam(':email', $email, PDO::PARAM_STR);
    $req->execute();
    $res = $req->fetch();
    //return false if the email is invalid
    if (empty($res)) {
        return false;
    }

    if ($res['pwdHash'] == SHA1($pwd . $res['pwdSalt'])) {

        $_SESSION['roles'] = getRole($res['userID']);
        $_SESSION['rights'] = array();

        $rights = array();

        foreach ($_SESSION['roles'] as $key => $value) {
            foreach (getUserRights($value['roleName']) as $right) {
                if (!in_array($right['rightName'], $rights)) {
                    array_push($rights, $right['rightName']);
                }
            }

            array_push($_SESSION['rights'], $rights);
        }
        $_SESSION['id'] = $res['userID'];
        $_SESSION['name'] = $res['lastName'] . ' ' . $res['firstName'];
        return true;
    }
    return false;
}

/**
* get the role of the user by it ID
* @param int $id of the user
*/
function getRole($id){
    $role = getConnexion();
    $req = $role->prepare("SELECT roleName FROM user_roles LEFT JOIN roles AS r ON user_roles.roleID = r.roleID WHERE userID = :id");
    $req->bindParam(':id', $id, PDO::PARAM_STR);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* get all user rights by the roleName
* @param string $roleName
*/
function getUserRights($roleName){
    $role = getConnexion();
    $req = $role->prepare("SELECT rightName FROM `role_rights` AS rr LEFT JOIN rights AS r ON rr.rightID = r.rightID LEFT JOIN roles AS rl ON rr.roleID = rl.roleID WHERE roleName = :roleName");
    $req->bindParam(':roleName', $roleName, PDO::PARAM_STR);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
