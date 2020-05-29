<?php
$by = FILTER_INPUT(INPUT_GET, 'by', FILTER_SANITIZE_STRING);
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'idTPI', FILTER_SANITIZE_STRING);

if (is_numeric($by) && is_numeric($tpiChoosen)) {
    addWishe($by, $tpiChoosen);
}
