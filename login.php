<?php
require_once('header.php');
$url = isset($_GET['url']) ? $_GET['url'] : '';
if($users_regis->isLoggedIn()){
    transfers_to('index.html');   
}

if(isset($_POST['submit'])){
      $email = isset($_POST['email']) ? $_POST['email'] : '';
      $password = isset($_POST['password']) ? $_POST['password'] : '';
      $url = isset($_POST['url']) ? $_POST['url'] : '';
      if($users_regis->authenticate($email, $password)) {
            if($url) transfers_to($url);
            else transfers_to("index.html");
      } else {
        $msg = 'Không thể đăng nhập, vui lòng kiểm tra Email và Mật khẩu';
      }
}
?>
<link href="lanhsu/css/metro.css" rel="stylesheet">
<link href="lanhsu/css/metro-icons.css" rel="stylesheet">
<script src="lanhsu/js/jquery-2.1.3.min.js"></script>
<script src="lanhsu/js/metro.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	});
</script>

<article id="content" style="font-size: 17px !important;">
	<div class="wrapper">
	    <div class="box1">
      	<h2 class="color2"><strong>Đ</strong>ăng nhập</h2>
     		<hr class="bg-black" />
      		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000" id="register">
      			<div class="grid">
                              <?php if(isset($msg) && $msg): ?>
                              <div class="row cells12">
                                    <div class="cell colspan4"></div>
                                    <div class="cell colspan6">
                                          <p class="bg-red fg-white padding20"><?php echo $msg; ?></p>
                                    </div>
                              </div>
                              <?php endif; ?>
      				<div class="row cells12">
      					<div class="cell colspan2"></div>
      					<div class="cell colspan2 padding-top-10 align-right">Email</div>
      					<div class="cell colspan6 input-control text">
                                          <input type="hidden" name="url" id="url" value="<?php echo $url; ?>" />
      						<input type="text" name="email" id="email" value="" data-validate-func="email" data-validate-hint="Địa chỉ email sai --> ten@angiang.gov.vn" placeholder="Địa chỉ email: ten@angiang.gov.vn" />
      						<span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
      					</div>
      				</div>
      				<div class="row cells12">
      					<div class="cell colspan2"></div>
      					<div class="cell colspan2 padding-top-10 align-right">Mật khẩu</div>
      					<div class="cell colspan6 input-control text">
      						<input type="password" name="password" id="password" value="" data-validate-func="minlength" data-validate-arg="6" data-validate-hint="Không đủ ký tự" placeholder="Mật khẩu" />
      						<span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
      					</div>
      				</div>
      				<div class="row cells12">
						<div class="cell colspan12 align-center">
							<button name="submit" id="submit" value="OK" class="button bg-black fg-white"><span class="mif-checkmark"></span> Đăng nhập</button>
                                          <a class="button bg-black fg-white" href="register.html"><span class="mif-user-plus"></span> Đăng ký tài khoản</a>
							<a href="index.html" class="button"><span class="mif-keyboard-return"></span> Trở về</a>
						</div>
					</div>
      			</div>
      		</form>
	    </div>
	</div>
</article>
<?php require_once('footer.php'); ?>