<?php
// Disable error display
ini_set('display_errors', 'Off');
error_reporting(E_ALL);

include_once __DIR__.'/../helpers/sql.php';
include_once __DIR__.'/../helpers/auth.php';
include_once __DIR__.'/../helpers/validation.php';

define('DB_USER', 'mhamdy');
define('DB_PASS', '123456789');
define('DB_NAME', 'inisev_task');

?>