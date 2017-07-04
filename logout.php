<?php
function __autoload($class_name) {
    require_once('lanhsu/cls/class.' . strtolower($class_name) . '.php');
}
require_once('lanhsu/inc/functions.inc.php');

$session = new SessionManager();
$users_regis = new Users_Regis();
$users_regis->logout();
transfers_to('index.html');
exit;

?>