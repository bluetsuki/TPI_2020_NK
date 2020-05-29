<?php
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'idTPI', FILTER_SANITIZE_STRING);
$idExpert = FILTER_INPUT(INPUT_GET, 'idExpert', FILTER_SANITIZE_STRING);
$assigned = FILTER_INPUT(INPUT_GET, 'assigned', FILTER_SANITIZE_STRING);

if (is_numeric($idExpert) && is_numeric($tpiChoosen) && is_numeric($assigned)) {
    updWishe($idExpert, $tpiChoosen, $assigned);
    if (is_numeric($assigned) == 1) {
        updTPI($tpiId, $idExpert, $expert2 = null);
    }else {
        updTPI($tpiId, $expert1 = null, $idExpert);
    }
}
