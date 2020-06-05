<?php
require_once 'model/connectDB.php';
require_once 'model/crudParams.php';

const nbExpertMax = 'NbMaxExpertForOneCandidate';
const wishesSessionStart = 'WishesSessionStart';
const wishesSessionEnd = 'WishesSessionEnd';

$tabParams = getParams();
$nbExpMax = $tabParams[nbExpertMax];
$dateStart = $tabParams[wishesSessionStart];
$dateEnd = $tabParams[wishesSessionEnd];

$btn = FILTER_INPUT(INPUT_POST, 'send', FILTER_SANITIZE_STRING);
