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

$form = <<<FORMPARAM
<form class="mt-4" action="?action=formParams" method="POST">
    <div class="row">
        <div class="form-group col-4">
            <label for="dateStart">Date de début</label>
            <input class="form-control" type="text" id="dateStart" name="dateStart" value="$dateStart">
            <small id="dateStart" class="form-text text-muted">Format : aaaa-mm-jj hh:mm:ss</small>
        </div>
        <div class="form-group col-4">
            <label for="dateEnd">Date de fin</label>
            <input class="form-control" type="text" id="dateEnd" name="dateEnd" value="$dateEnd">
            <small id="dateEnd" class="form-text text-muted">Format : aaaa-mm-jj hh:mm:ss</small>
        </div>
        <div class="form-group col-4">
            <label for="nbExpMax">Nombre d'expert maximum par TPI</label>
            <input class="form-control" type="number" id="nbExpMax" name="nbExpMax" value="$nbExpMax">
        </div>
    </div>
<button type="submit" name="send" value="send" class="btn btn-success">Enregistrer</button>
</form>
FORMPARAM;

$btn = FILTER_INPUT(INPUT_POST, 'send', FILTER_SANITIZE_STRING);

if ($btn == 'send') {
    $newDateStart = FILTER_INPUT(INPUT_POST, 'dateStart', FILTER_SANITIZE_STRING);
    $newDateEnd = FILTER_INPUT(INPUT_POST, 'dateEnd', FILTER_SANITIZE_STRING);
    $newNbExpMax = FILTER_INPUT(INPUT_POST, 'nbExpMax', FILTER_SANITIZE_STRING);

    updParam(nbExpertMax, $newNbExpMax);
    updParam(wishesSessionStart, $newDateStart);
    updParam(wischesSessionEnd, $newDateEnd);

    header('Location: ?action=tpi');
    exit;
}
