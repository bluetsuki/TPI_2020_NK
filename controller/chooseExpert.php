<?php
require_once 'model/crudWishes.php';
require_once 'model/crudTPIS.php';
require_once 'model/selectExpert.php';

if (is_numeric($idExpert) && is_numeric($tpiChoosen) && is_numeric($assigned)) {
    updWish($idExpert, $tpiChoosen, $assigned);
    if ($assigned == '1') {
        updTPIExp1($tpiChoosen, $idExpert);
    }else {
        updTPIExp2($tpiChoosen, $idExpert);
    }
}

require_once 'view/selectExpert.php';
