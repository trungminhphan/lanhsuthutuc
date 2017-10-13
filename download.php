<?php
function __autoload($class_name) {
    require_once('lanhsu/cls/class.' . strtolower($class_name) . '.php');
}
require_once('lanhsu/inc/functions.inc.php');
require_once('lanhsu/inc/config.inc.php');
$masohoso = isset($_GET['masohoso']) ? $_GET['masohoso'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$filename = ''; $alias_name='';
if($action == 'doanra'){
  $d = new DoanRa(); $d->masohoso = $masohoso;
  $hs = $d->get_one_masohoso();
  if(isset($hs['quyetdinhchophep']['attachments'][0]['alias_name'])){
    $filename = $copy_desc.$hs['quyetdinhchophep']['attachments'][0]['alias_name'];
    $alias_name = 'xuatcanh_'.date("YmdHi");
  }
}

if($action == 'doanvao'){
  $d = new DoanVao(); $d->masohoso = $masohoso;
  $hs = $d->get_one_masohoso();
  if(isset($hs['quyetdinhchophep']['attachments'][0]['alias_name'])){
    $filename = $copy_desc.$hs['quyetdinhchophep']['attachments'][0]['alias_name'];
    $alias_name = 'nhapcanh_'.date("YmdHi");
  }
}

if($action == 'abtc'){
  $d = new ABTC(); $d->masohoso = $masohoso;
  $hs = $d->get_one_masohoso();
  if(isset($hs['quyetdinhchophep']['attachments'][0]['alias_name'])){
    $filename = $copy_desc.$hs['quyetdinhchophep']['attachments'][0]['alias_name'];
    $alias_name = 'abtc_'.date("YmdHi");
  }
}

if (file_exists($filename)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($alias_name).'.pdf');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    exit;
} else {
    echo '<p>Sorry! Tập tin không tồn tại.</p>';
    echo '<p>Vui lòng liên hệ số điện thoại: <b>+84 296 3953 936</b></p>';
}

?>
