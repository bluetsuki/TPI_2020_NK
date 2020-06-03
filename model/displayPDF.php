<?php
$path = FILTER_INPUT(INPUT_GET, 'link', FILTER_SANITIZE_STRING);

header('Cache-Control: public');
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . substr($path, 4) . '"');
header('Content-Length: ' . filesize($path));
readfile($path);
