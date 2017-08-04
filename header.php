<?php
function __autoload($class_name) {
    require_once('lanhsu/cls/class.' . strtolower($class_name) . '.php');
}
require_once('lanhsu/inc/functions.inc.php');
require_once('lanhsu/inc/config.inc.php');
$active_menu = isset($_GET['active']) ? $_GET['active']: 'index';
$session = new SessionManager();
$users_regis = new Users_Regis();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Đăng ký trực tuyến - Phần mềm Lãnh sự Sở Ngoại vụ</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script src="lanhsu/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/tms-0.3.js"></script>
<script type="text/javascript" src="js/tms_presets.js"></script>
<script type="text/javascript" src="js/backgroundPosition.js"></script>
<script type="text/javascript" src="js/atooltip.jquery.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<style type="text/css">.box1 figure{behavior:url("js/PIE.htc");}</style>
<![endif]-->
</head>
<body id="page1">
<div class="body1">
  <div class="main">
  	<header>
	  <div class="wrapper">
	    <h1><a href="index.html" id="logo">Lãnh sự</a></h1>
	    <nav>
	      <ul id="menu">
	      	<li <?php echo $active_menu == 'index' ? 'id="menu_active"' : ''; ?>><a href="index.html?active=index">Trang chủ</a></li>
	        <li <?php echo $active_menu == 'gioi_thieu' ? 'id="menu_active"' : ''; ?>><a href="gioi-thieu.html?active=gioi_thieu">Giới thiệu</a></li>
	        <li <?php echo $active_menu == 'tin_lanh_su' ? 'id="menu_active"' : ''; ?>><a href="tinlanhsu.html?active=tin_lanh_su">Tin lãnh sự</a></li>
	        <li <?php echo $active_menu == 'vanban' ? 'id="menu_active"' : ''; ?>><a href="vanbanphapquy.html?active=vanban">Văn bản</a></li>
	        <li <?php echo $active_menu == 'tra_cuu' ? 'id="menu_active"' : ''; ?>><a href="tra-cuu.html?active=tra_cuu">Tra cứu</a></li>
	        <?php if($users_regis->isLoggedIn()): ?>
	        	<li><a href="logout.html">Đăng xuất</a></li>
	        <?php else: ?>
	        <li <?php echo $active_menu == 'login' ? 'id="menu_active"' : ''; ?>><a href="login.html?active=login">Đăng nhập</a></li>
	    	<?php endif; ?>
	      </ul>
	    </nav>
	  </div>
	</header>