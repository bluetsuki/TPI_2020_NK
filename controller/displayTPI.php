<?php
require_once 'model/crudParams.php';
require_once 'model/crudWishes.php';
require_once 'model/crudTPIS.php';
require_once 'model/expertWishes.php';

//Check if the session is open
if (date('Y-m-d H:i:m') >= getParamsByName('WishesSessionStart')[0]['value'] && date('Y-m-d H:i:m') <= getParamsByName('WishesSessionEnd')[0]['value']) {
    //Add a wish of the user if the user click on the button
    if (is_numeric($_SESSION['id']) && is_numeric($tpiChoosen) && empty($cancelChoice)) {
        if (empty(getWishUser($_SESSION['id'],$tpiChoosen)) && count(getWishesByTpiIdAssignedNull($tpiChoosen)) < getParamsByName('NbMaxExpertForOneCandidate')[0]['value']) {
            addWish($_SESSION['id'], $tpiChoosen);
        }
    }

    //Remove the wish of the Expert
    if (!empty($cancelChoice)) {
        rmWish($_SESSION['id'], $tpiChoosen);
    }
}
require_once 'view/tabTPI.php';
