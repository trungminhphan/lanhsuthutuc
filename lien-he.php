<?php require_once('header.php'); ?>
<link href="lanhsu/css/metro.css" rel="stylesheet">
<link href="lanhsu/css/metro-icons.css" rel="stylesheet">
<link href="lanhsu/css/metro-responsive.css" rel="stylesheet">
<link href="lanhsu/css/metro-schemes.css" rel="stylesheet">
<script src="lanhsu/js/jquery-2.1.3.min.js"></script>
<script src="lanhsu/js/metro.js"></script>
 <article id="content">
      <div class="wrapper">
        <div class="box1">
          <div class="line1 wrapper">
            <section class="col11">
              <h2><strong>L</strong>iên<span> hệ</span></h2>
              <h5>Sở Ngoại Vụ tỉnh An Giang</h5>
              <ul style="list-style-type: disc; padding-left:30px;text-align:justify;">
              	<li>Địa chỉ: 8/18 Lý Thường Kiệt, phường Mỹ Bình, TP. Long Xuyên, tỉnh An Giang</li>
              	<li>Điện thoại: +84 0296 3940103</li>
              	<li>Fax:  +84 0296 3940104</li>
              	<li>Email: songoaivu@angiang.gov.vn</li>
              	<li>Website: http://songoaivu.angiang.gov.vn</li>
              </ul>
            </section>
          </div>
        </div>
      </div>
      <div class="wrapper">
        <div class=" relative">
        <div class="box1">
          <h2 class="color3"><strong>G</strong>ởi<span> Email</span></h2>
          <form action="send_email.php" method="POST" id="themdoanraform" data-role="validator" data-show-required-state="false" enctype="multipart/form-data">
          <div class="grid example">
          	<div class="row cells12">
          		<div class="cell colspan2 align-right padding-top-10">Họ tên:</div>
          		<div class="cell colspan10 input-control text">
          			<input type="text" name="hoten" id="hoten" placeholder="Họ tên" data-validate-func="required"/>
          			<span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
          		</div>
          	</div>
          	<div class="row cells12">
          		<div class="cell colspan2 align-right padding-top-10">Địa chỉ Email: </div>
          		<div class="cell colspan10 input-control text">
          			<input type="text" name="email" id="email" placeholder="Địa chỉ email của bạn" data-validate-func="email"/>
          			<span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
          		</div>
          	</div>
          	<div class="row cells12">
          		<div class="cell colspan2 align-right padding-top-10">Điện thoại: </div>
          		<div class="cell colspan10 input-control text">
          			<input type="text" name="dienthoai" id="dienthoai" placeholder="Số điện thoại" data-validate-func="required"/>
          			<span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
          		</div>
          	</div>
          	<div class="row cells12">
          		<div class="cell colspan2 align-right padding-top-10">Nội dung: </div>
          		<div class="cell colspan10 input-control textarea">
          			<textarea name="noidung" id="noidung" placeholder="Nội dung cần gởi." data-validate-func="required"></textarea>
          			<span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
          		</div>
          	</div>
          	<div class="row cells12">
          		<div class="cell colspan12 align-center ">
          			<button name="submit" id="submit" value="OK" class="button bg-black fg-white"><span class="mif-checkmark"></span> Gởi Email</button>
          		</div>
          	</div>
          </div>
          </form>
          <!--<img src="images/page6_img1.png" alt="" class="img1">
          <form id="ContactForm" action="#">
            <div>
              <div class="wrapper"><span>Họ tên:</span>
                <input type="text" class="input">
              </div>
              <div class="wrapper"><span>Email E-mail:</span>
                <input type="text" class="input">
              </div>
              <div class="wrapper"><span>Your Website:</span>
                <input type="text" class="input">
              </div>
              <div class="textarea_box"><span>Your Message:</span>
                <textarea name="textarea" cols="1" rows="1"></textarea>
              </div>
              <a href="#" class="button2 color3">Send</a> <a href="#" class="button2 color3">Clear</a> </div>
          </form>-->
        </div>
        </div>
      </div>
    </article>
<?php require_once('footer.php'); ?>
