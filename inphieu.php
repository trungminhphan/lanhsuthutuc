<?php
function __autoload($class_name) {
    require_once('../lanhsu/cls/class.' . strtolower($class_name) . '.php');
}
require_once('../lanhsu/inc/functions.inc.php');
require_once('../lanhsu/inc/config.inc.php');
$session = new SessionManager();
$users_regis = new Users_Regis();
if(!$users_regis->isLoggedIn()){
    transfers_to('login.php?url='. $_SERVER['PHP_SELF']);   
}
$csrf = new CSRF_Protect();$canbo = new CanBo();$donvi = new DonVi();
$masohoso = isset($_GET['masohoso']) ? $_GET['masohoso'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$csrf->verifyGet();
$id_user = $users_regis->get_userid();
$users_regis->id = $id_user;
$u = $users_regis->get_one();
if(isset($u['canbo']['id_canbo']) && $u['canbo']['id_canbo']){
	$canbo->id = $u['canbo']['id_canbo']; $cb = $canbo->get_one();	
	$hoten = $cb['hotent'];
} else {
	$hoten = $u['hoten'];
}
if(isset($u['canbo']['id_donvi']) && $u['canbo']['id_donvi']){
	$tendonvi = $donvi->tendonvi($u['canbo']['id_donvi']);
} else {
	$tendonvi = $u['donvi'];
}
//$donvi->id = $u['canbo']['id_donvi']; $dv = $donvi->get_one();
$ngaydangky = '';
if($act == 'doanra'){
	///doanra
	$doanra = new DoanRa_Regis();
	$doanra->masohoso = $masohoso; $a = $doanra->get_one_mshs();
	$ngaydangky = isset($a['date_post']) ? date("d/m/Y H:i", $a['date_post']->sec) : '';
} else if($act == 'doanvao'){
	///doanvao
	$doanvao = new DoanVao_Regis();
	$doanvao->masohoso = $masohoso; $a = $doanvao->get_one_mshs();
	$ngaydangky = isset($a['date_post']) ? date("d/m/Y H:i", $a['date_post']->sec) : '';
} else {
	///abct
	$abtc = new ABTC_Regis();
	$abtc->masohoso = $masohoso; $a = $abtc->get_one_mshs();
	$ngaydangky = isset($a['date_post']) ? date("d/m/Y H:i", $a['date_post']->sec) : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Đăng ký trực tuyến - Phần mềm Lãnh sự Sở Ngoại vụ</title>
<meta charset="utf-8">
<link href="../lanhsu/css/metro.css" rel="stylesheet">
<link href="../lanhsu/css/metro-icons.css" rel="stylesheet">
<script src="../lanhsu/js/jquery-2.1.3.min.js"></script>
<script src="../lanhsu/js/metro.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		window.print();
	});
</script>
</head>
<body>
<div style="max-width: 750px; margin: auto; border:3px solid #000;padding:20px;">
<div class="grid">
	<div class="row cells12">
		<div class="cell colspan12">
			<b>UBND TỈNH AN GIANG</b> <br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SỞ NGOẠI VỤ
		</div>
	</div>
	<div class="row cells12 align-center">
		<div class="cell colspan12"><h3>PHIẾU NHẬN KẾT QUẢ</h3></div>
	</div>
</div>
<table width="700" align="center" cellpadding="10" border="0">
	<tr>
		<td width="500">
			<p><h4>Họ tên: <?php echo $hoten; ?></h4></p>
			<p><h4>Đơn vị: <?php echo $tendonvi; ?></h4></p>
			<p><h4>Mã số hồ sơ: <b><?php echo $masohoso; ?></b></h4></p>
			<p><h4>Ngày đăng ký: <?php echo $ngaydangky; ?></h4></p>
		</td>
		<td width="200" align="center">
			<?php    
			    //set it to writable location, a place for temp generated PNG files
			    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'inc/qrcode/temp'.DIRECTORY_SEPARATOR;
			    //html PNG location prefix
			    $PNG_WEB_DIR = 'inc/qrcode/temp/';
			    include "inc/qrcode/qrlib.php";    
			    //ofcourse we need rights to create temp dir
			    if (!file_exists($PNG_TEMP_DIR)) mkdir($PNG_TEMP_DIR);
			    $filename = $PNG_TEMP_DIR.'test.png';
			    $matrixPointSize = 10; //1-10
			    $errorCorrectionLevel = 'L'; //L,M,Q,H
			    //$data = show_6($sophieuthu) .'\n' . $id_lophoc . '\n' . $id_hocvien . '\n' . date("d/m/Y H:i",$ngaythu->sec); //'Phan Minh Trung\n351518061\n28/10/1984';
			    $data = $masohoso;
			    // user data
			    //$filename = $PNG_TEMP_DIR.'test'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
			    $filename = $PNG_TEMP_DIR . $masohoso . '.png';
			    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
			    //display generated file
			    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" width="150"/>';  
			?>
		</td>
	</tr>
</table>
</div>
<div class="align-center">
</div>
</body>
</html>