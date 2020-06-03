<?php
require_once 'connectDB.php';
require_once 'crudUser.php';

$btn = FILTER_INPUT(INPUT_POST, 'send', FILTER_SANITIZE_STRING);
$error = '';
