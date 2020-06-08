<?php
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'idTPI', FILTER_SANITIZE_STRING);
$idExpert = FILTER_INPUT(INPUT_GET, 'idExpert', FILTER_SANITIZE_STRING);
$assigned = FILTER_INPUT(INPUT_GET, 'assigned', FILTER_SANITIZE_STRING);

require_once 'model/crudWishes.php';
require_once 'model/crudTPIS.php';

//Update the wish when the administrator click on the button. Change the column assigned
if (is_numeric($idExpert) && is_numeric($tpiChoosen) && is_numeric($assigned)) {
    updWish($idExpert, $tpiChoosen, $assigned);
    if ($assigned == '1') {
        updTPIExp1($tpiChoosen, $idExpert);
    }else {
        updTPIExp2($tpiChoosen, $idExpert);
    }
}

require_once 'model/selectExpert.php';
require_once 'view/selectExpert.php';
