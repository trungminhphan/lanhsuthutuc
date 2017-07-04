<?php
function __autoload($class_name) {
    require_once('lanhsu/cls/class.' . strtolower($class_name) . '.php');
}
require_once('lanhsu/inc/functions.inc.php');
require_once('lanhsu/inc/config.inc.php');
$session = new SessionManager();
$users_regis = new Users_Regis();

$captcha = $users_regis->generate_capcha();

echo $captcha;
?>