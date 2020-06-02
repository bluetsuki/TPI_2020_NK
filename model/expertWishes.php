<?php
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'idTPI', FILTER_SANITIZE_STRING);
$cancelChoice = FILTER_INPUT(INPUT_GET, 'rm', FILTER_SANITIZE_STRING);

//Add a wishe of the user if the user click on the button
if (is_numeric($_SESSION['id']) && is_numeric($tpiChoosen) && empty($cancelChoice)) {
    addWish($_SESSION['id'], $tpiChoosen);
}

if (!empty($cancelChoice)) {
    rmWish($_SESSION['id'], $tpiChoosen);
}
