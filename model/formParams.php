<?php
//@TODO check the format of the date and hour aaaa-mm-jj hh:mm:ss
require_once 'model/connectDB.php';
require_once 'model/crudParams.php';

$tabParams = getParams();

const nbExpertMax = 'NbMaxExpertForOneCandidate';
const wishesSessionStart = 'WishesSessionStart';
const wishesSessionEnd = 'WishesSessionEnd';

$nbExpMax = $tabParams[nbExpertMax];
$dateStart = $tabParams[wishesSessionStart];
$dateEnd = $tabParams[wishesSessionEnd];

$btn = FILTER_INPUT(INPUT_POST, 'send', FILTER_SANITIZE_STRING);
