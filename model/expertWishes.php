<?php
$action = FILTER_INPUT(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'idTPI', FILTER_SANITIZE_STRING);

if (is_numeric($_SESSION['id']) && is_numeric($tpiChoosen)) {
    addWishe($_SESSION['id'], $tpiChoosen);
}
