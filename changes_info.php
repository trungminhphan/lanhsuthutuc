<?php
require_once('header.php');
$url = isset($_GET['url']) ? $_GET['url'] : '';
if(!$users_regis->isLoggedIn()){ transfers_to('index.html');}
if($users_regis->isLoggedIn()){ $id_user = $users_regis->get_userid();} else { $id_user = ''; }
$users_regis->id = $id_user; $u = $users_regis->get_one();
$id = isset($u['_id']) ? $u['_id'] : '';
$email = isset($u['email']) ? $u['email'] : '';
$hoten = isset($u['hoten']) ? $u['hoten'] : '';
$donvi = isset($u['donvi']) ? $u['donvi'] : '';
$chucvu = isset($u['chucvu']) ? $u['chucvu'] : '';
$dienthoai = isset($u['dienthoai']) ? $u['dienthoai'] : '';

if(isset($_POST['submit'])){
      $id = isset($_POST['id']) ? $_POST['id'] : '';
      $email = isset($_POST['email']) ? $_POST['email'] : '';
      $password = isset($_POST['password']) ? $_POST['password'] : '';
      $repassword = isset($_POST['repassword']) ? $_POST['repassword'] : '';
      $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
      $donvi = isset($_POST['donvi']) ? $_POST['donvi'] : '';
      $chucvu = isset($_POST['chucvu']) ? $_POST['chucvu'] : '';
      $dienthoai = isset($_POST['dienthoai']) ? $_POST['dienthoai'] : '';
      $url = isset($_POST['url']) ? $_POST['url'] : '';
      $users_regis->id = $id;
      $users_regis->email = $email;
      if($password !== $repassword){
            $msg = 'Mật khẩu không trùng khớp';
      } else if($users_regis->check_exists()){
            $msg = 'Email đã tồn tại trong cơ sở dữ liệu';
      } else {
            $users_regis->password = $password;
            $users_regis->hoten = $hoten;
            $users_regis->donvi = $donvi;
            $users_regis->chucvu = $chucvu;
            $users_regis->dienthoai = $dienthoai;
            //$msg = '<h2>Đăng ký thành công</h2>';
            if($users_regis->changes_info()) $msg = 'Cập nhật thành công thành công';
            else $msg = 'Không thay đổi, vui lòng liên hệ số điện thoại: +84 296 3953 936';
      }
      /*
      if($users_regis->authenticate($email, $password)) {
            if($url) transfers_to($url);
            else transfers_to("index.php");
      } else {
        $msg = 'Không thể đăng nhập, vui lòng kiểm tra Email và Mật khẩu';
      }*/
}
?>
<link href="lanhsu/css/metro.css" rel="stylesheet">
<link href="lanhsu/css/metro-icons.css" rel="stylesheet">
<script src="lanhsu/js/jquery-2.1.3.min.js"></script>
<script src="lanhsu/js/metro.js"></script>
<article id="content" style="font-size: 17px !important;">
  <div class="wrapper">
      <div class="box1">
        <h2 class="color2"><strong>C</strong>ập nhật thông tin tài khoản</h2>
        <hr class="bg-black" />
          <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000" id="register">
            <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : ''; ?>" />
            <div class="grid">
                              <?php if(isset($msg) && $msg): ?>
                              <div class="row cells12">
                                    <div class="cell colspan2"></div>
                                    <div class="cell colspan8">
                                          <p class="bg-red fg-white padding20"><?php echo $msg; ?></p>
                                    </div>
                              </div>
                              <?php endif; ?>
              <div class="row cells12">
                <div class="cell"></div>
                <div class="cell colspan3 padding-top-10 align-right">Tài khoản (Email)</div>
                <div class="cell colspan6 input-control text">
                                          <input type="hidden" name="url" id="url" value="<?php echo $url; ?>" />
                  <input type="text" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>" data-validate-func="email" data-validate-hint="Địa chỉ email sai --> ten@angiang.gov.vn" placeholder="Địa chỉ email: ten@angiang.gov.vn" disabled/>
                  <span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
                </div>
              </div>
              <div class="row cells12">
                <div class="cell"></div>
                <div class="cell colspan3 padding-top-10 align-right">Mật khẩu</div>
                <div class="cell colspan6 input-control text">
                  <input type="password" name="password" id="password" value="<?php echo isset($password) ? $password : ''; ?>" data-validate-func="minlength" data-validate-arg="6" data-validate-hint="Tối thiểu 6 ký tự" placeholder="Mật khẩu tối thiểu 6 ký tự" />
                  <span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
                </div>
              </div>
                              <div class="row cells12">
                                    <div class="cell"></div>
                                    <div class="cell colspan3 padding-top-10 align-right">Nhập lại mật khẩu</div>
                                    <div class="cell colspan6 input-control text">
                                          <input type="password" name="repassword" id="repassword" value="<?php echo isset($repassword) ? $repassword : ''; ?>" data-validate-func="minlength" data-validate-arg="6" data-validate-hint="Tối thiểu 6 ký tự" placeholder="Mật khẩu tối thiểu 6 ký tự" />
                                          <span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
                                    </div>
                              </div>
                              <div class="row cells12">
                                    <div class="cell"></div>
                                    <div class="cell colspan3 padding-top-10 align-right">Họ tên</div>
                                    <div class="cell colspan6 input-control text">
                                          <input type="text" name="hoten" id="hoten" value="<?php echo isset($hoten) ? $hoten : ''; ?>" data-validate-func="required" placeholder="Họ tên" />
                                          <span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
                                    </div>
                              </div>
                              <div class="row cells12">
                                    <div class="cell"></div>
                                    <div class="cell colspan3 padding-top-10 align-right">Đơn vị</div>
                                    <div class="cell colspan6 input-control text">
                                          <input type="text" name="donvi" id="donvi" value="<?php echo isset($donvi) ? $donvi : ''; ?>" data-validate-func="required" placeholder="Đơn vị" />
                                          <span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
                                    </div>
                              </div>
                              <div class="row cells12">
                                    <div class="cell"></div>
                                    <div class="cell colspan3 padding-top-10 align-right">Chức vụ</div>
                                    <div class="cell colspan6 input-control text">
                                          <input type="text" name="chucvu" id="chucvu" value="<?php echo isset($chucvu) ? $chucvu : ''; ?>" data-validate-func="required" placeholder="Chức vụ" />
                                          <span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
                                    </div>
                              </div>
                              <div class="row cells12">
                                    <div class="cell"></div>
                                    <div class="cell colspan3 padding-top-10 align-right">Điện thoại liên hệ</div>
                                    <div class="cell colspan6 input-control text">
                                          <input type="text" name="dienthoai" id="dienthoai" value="<?php echo isset($dienthoai) ? $u['dienthoai'] : ''; ?>" data-validate-func="required" placeholder="Số điện thoại" />
                                          <span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
                                    </div>
                              </div>
              <div class="row cells12">
            <div class="cell colspan12 align-center">
              <button name="submit" id="submit" value="OK" class="button bg-black fg-white"><span class="mif-checkmark"></span> Cập nhật</button>
              <a href="taikhoan.html" class="button"><span class="mif-keyboard-return"></span> Trở về</a>
            </div>
          </div>
            </div>
          </form>
      </div>
  </div>
</article>
<?php require_once('footer.php'); ?>
