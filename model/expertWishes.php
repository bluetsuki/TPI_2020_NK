<?php
$action = FILTER_INPUT(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'idTPI', FILTER_SANITIZE_STRING);
$cancelChoice = FILTER_INPUT(INPUT_GET, 'rm', FILTER_SANITIZE_STRING);

//Add a wishe of the user if the user click on the button
if (is_numeric($_SESSION['id']) && is_numeric($tpiChoosen)) {
    addWishe($_SESSION['id'], $tpiChoosen);
}

//Remove the wishe of the user if the user click on the button
if ($cancelChoice) {
    rmWishe($_SESSION['id'], $tpiChoosen);
}
