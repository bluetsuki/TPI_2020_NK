<?php
require_once 'model/formParams.php';

if ($btn == 'send') {
    $newDateStart = FILTER_INPUT(INPUT_POST, 'dateStart', FILTER_SANITIZE_STRING);
    $newDateEnd = FILTER_INPUT(INPUT_POST, 'dateEnd', FILTER_SANITIZE_STRING);
    $newNbExpMax = FILTER_INPUT(INPUT_POST, 'nbExpMax', FILTER_SANITIZE_STRING);

    updParam(nbExpertMax, $newNbExpMax);
    updParam(wishesSessionStart, $newDateStart);
    updParam(wishesSessionEnd, $newDateEnd);

    header('Location: ?action=home');
    exit;
}

require_once 'view/formParams.php';
