<?php require_once('header.php'); ?>
<link href="lanhsu/css/metro.css" rel="stylesheet">
<link href="lanhsu/css/metro-icons.css" rel="stylesheet">
<script src="lanhsu/js/jquery-2.1.3.min.js"></script>
<script src="lanhsu/js/metro.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#dongy").hide();
		$("#check_dongy").click(function(){
			if($(this).is(":checked")){
				$("#dongy").show();
			} else {
				$("#dongy").hide();
			}
		});
	});
</script>
<article id="content" style="font-size: 17px !important;">
	<div class="wrapper">
	    <div class="box1">
      		<h2 class="color2"><strong>H</strong>ướng dẫn đăng ký <span>Trực tuyến - tiếp khách nước ngoài</span></h2>
      		<hr class="bg-black" />
      		<p>Vui lòng đọc kỹ và điền thông tin trước khi bắt đầu đăng ký trực tuyến:
				<ul class="numeric-list dark-bullet">
			      <li>Điền đầy đủ và chi tiết các thông tin vào mẫu tờ khai, không được bỏ trống.</li>
			      <li>Đính kèm tất cả các hồ sơ ở dạng tập tin PDF.</li>
			      <li>Nhận thống báo xác nhận đăng ký và ghi nhận mã số hồ sơ khi đến nhận kết quả.</li>
			      <li>Hoàn thành đăng ký trực tuyến.</li>
			    </ul>
			</p>
			<label class="input-control checkbox small-check">
		        <input type="checkbox" name="check_dongy" id="check_dongy" />
		        <span class="check"></span>
		        <span class="caption">Tôi đã đọc kỹ nội dung trên và muốn đăng ký xin cấp phép tiếp khách nước ngoài.</span>
		    </label>
			<br /><a href="doanvao_regis.html" class="button bg-black fg-white" id="dongy"><span class="mif-checkmark"></span> Bắt đầu đăng ký</a>
	    </div>
	</div>
</article>

<?php require_once('footer.php'); ?>