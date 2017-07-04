<?php require_once('header.php');
require_once('lanhsu/inc/functions.inc.php');
require_once('lanhsu/inc/config.inc.php');
$session = new SessionManager();
$users_regis = new Users_Regis();
if(!$users_regis->isLoggedIn()){
    transfers_to('login.php?url='. $_SERVER['PHP_SELF']);   
}
$masohoso = isset($_GET['masohoso']) ? $_GET['masohoso'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$csrf = new CSRF_Protect();
$token = $csrf->getToken();
?>
<link href="../lanhsu/css/metro.css" rel="stylesheet">
<link href="../lanhsu/css/metro-icons.css" rel="stylesheet">
<script src="../lanhsu/js/metro.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".open_window").click(function(){
      window.open($(this).attr("href"), '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=0, left=100, width=1024, height=800');
      return false;
    });
  });
</script>
<article id="content">
    <div class="box1">
        <h2><strong>Đ</strong>ăng ký <span> thành công</span></h2>
        <hr class="bg-black" />
    	<h3 style="color:#000;"><span class="mif-barcode"></span> Mã số hồ sơ của bạn là: <b><?php echo $masohoso; ?></b></h3>
      	<p style="clear: both;"><b>Vui lòng ghi nhận Mã số hồ sơ, khi đến nhận kết quả chỉ cần thông tin mã số hồ sơ để tra cứu trả kết quả.</b></p>        
      	<div class="align-center">
      	<a href="inphieu.php?masohoso=<?php echo $masohoso; ?>&_token=<?php echo $token; ?>&act=<?php echo $act; ?>" class="button bg-black fg-white open_window" onlick="return false;"><span class="mif-print"></span> In</a>
      	<a href="index.php" class="button bg-black fg-white"><span class="mif-keyboard-return"></span> Trở về</a>
      	</div>
    </div>	
</article>
<?php require_once('footer.php'); ?>