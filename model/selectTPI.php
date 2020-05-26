<?php
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'idTPI', FILTER_SANITIZE_STRING);
$by = FILTER_INPUT(INPUT_GET, 'by', FILTER_SANITIZE_STRING);

addWishe($by, $tpiChoosen);
