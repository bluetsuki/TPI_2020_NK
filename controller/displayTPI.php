<?php
require_once 'model/crudParams.php';
require_once 'model/crudWishes.php';
require_once 'model/crudTPIS.php';
require_once 'model/expertWishes.php';

//Add a wishe of the user if the user click on the button
if (is_numeric($_SESSION['id']) && is_numeric($tpiChoosen) && empty($cancelChoice)) {
    addWish($_SESSION['id'], $tpiChoosen);
}

if (!empty($cancelChoice)) {
    rmWish($_SESSION['id'], $tpiChoosen);
}
require_once 'view/tabTPI.php';
