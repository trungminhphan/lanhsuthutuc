<?php
require_once('header.php');
if(!$users_regis->isLoggedIn()){
    transfers_to('login.html?url='. $_SERVER['REQUEST_URI']);   
}
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$update = isset($_GET['update']) ? $_GET['update'] : '';
$abtc_regis=new ABTC_Regis(); $donvi=new DonVi();$csrf = new CSRF_Protect();
$donvi_list = $donvi->get_all_list_regis();
$chophep = 1;$tinhtrang=0;$msg='';
$id_user = $users_regis->get_userid();

switch ($update) {
	case 'edit_ok': $msg = 'Chỉnh sửa thành công'; break;
	case 'edit_no': $msg = 'Không thể chỉnh sửa';  break;
	case 'insert_ok': $msg = 'Thêm thành công';  break;
	case 'insert_no': $msg = 'Không thể thêm mới';  break;
	default: $msg = ''; break;
}
if(isset($_POST['submit'])){
	$csrf->verifyRequest();
	$id_donvi_xinphep_1 = isset($_POST['id_donvi_xinphep_1']) ? $_POST['id_donvi_xinphep_1'] : '';
	$id_donvi_xinphep_2 = isset($_POST['id_donvi_xinphep_2']) ? $_POST['id_donvi_xinphep_2'] : '';
	$id_donvi_xinphep_3 = isset($_POST['id_donvi_xinphep_3']) ? $_POST['id_donvi_xinphep_3'] : '';
	$id_donvi_xinphep_4 = isset($_POST['id_donvi_xinphep_4']) ? $_POST['id_donvi_xinphep_4'] : '';
	$id_donvi_xinphep = array($id_donvi_xinphep_1, $id_donvi_xinphep_2, $id_donvi_xinphep_3, $id_donvi_xinphep_4);
	$tencongvanxinphep = isset($_POST['tencongvanxinphep']) ? $_POST['tencongvanxinphep'] : '';
	$ngaykycongvanxinphep = isset($_POST['ngaykycongvanxinphep']) ? $_POST['ngaykycongvanxinphep'] : '';
	$filecongvanxinphep = array();
	$congvanxinphep_alias_name = isset($_POST['congvanxinphep_alias_name']) ? $_POST['congvanxinphep_alias_name'] : '';
	$congvanxinphep_filename = isset($_POST['congvanxinphep_filename']) ? $_POST['congvanxinphep_filename'] : '';
	$congvanxinphep_filetype = isset($_POST['congvanxinphep_filetype']) ? $_POST['congvanxinphep_filetype'] : '';
	if($congvanxinphep_alias_name){
		foreach ($congvanxinphep_alias_name as $key => $value) {
			array_push($filecongvanxinphep, array('alias_name' => $value, 'filename' => $congvanxinphep_filename[$key], 'filetype'=>$congvanxinphep_filetype[$key]));
		}
	}
	$congvanxinphep = array(
		'id_donvi' => $id_donvi_xinphep ? $id_donvi_xinphep : '',
		'ten' => $tencongvanxinphep,
		'attachments' => $filecongvanxinphep,
		'ngayky' => $ngaykycongvanxinphep ? new MongoDate(convert_date_dd_mm_yyyy($ngaykycongvanxinphep)) : '');
	$id_quocgia = isset($_POST['id_quocgia']) ? $_POST['id_quocgia'] : '';

	$giaytolienquan = array();
	$giaytolienquan_alias_name = isset($_POST['giaytolienquan_alias_name']) ? $_POST['giaytolienquan_alias_name'] : '';
	$giaytolienquan_filename = isset($_POST['giaytolienquan_filename']) ? $_POST['giaytolienquan_filename'] : '';
	$giaytolienquan_filetype = isset($_POST['giaytolienquan_filetype']) ? $_POST['giaytolienquan_filetype'] : '';
	$giaytolienquan_key = isset($_POST['giaytolienquan_key']) ? $_POST['giaytolienquan_key'] : '';
	if($giaytolienquan_alias_name){
		foreach ($giaytolienquan_alias_name as $key => $value) {
			array_push($giaytolienquan, array('order'=>$giaytolienquan_key[$key], 'alias_name' => $value, 'filename' => $giaytolienquan_filename[$key], 'filetype'=>$giaytolienquan_filetype[$key]));
		}
	}
	$ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';
	if($_POST["captcha"]==$_SESSION["captcha_code"]){
		$masohoso = strtoupper(uniqid());
		$stt = $abtc_regis->get_maxstt();
		$masohoso = date("Y") . '-' . $stt.'-ABTC';
		$abtc_regis->stt = $stt;
		$abtc_regis->masohoso = $masohoso;	
		$abtc_regis->congvanxinphep = $congvanxinphep;
		//$abtc->quyetdinhchophep = $quyetdinhchophep;
		//$abtc->chophep = $chophep; 
		$abtc_regis->id_quocgia = $id_quocgia;
		//$abtc->thongtinthanhvien = $thongtinthanhvien;
		$abtc_regis->giaytolienquan = $giaytolienquan;
		$abtc_regis->ghichu = $ghichu;
		$abtc_regis->id_user = $id_user;
		$arr_tinhtrang = array(
			't' => 0,
			'noidung' => 'Đang xử lý',
			'date_post' => new MongoDate(),
			'id_user' => new MongoId($id_user)
		);
		$abtc_regis->status = $arr_tinhtrang;
		if($abtc_regis->insert()){
			transfers_to('success_regis.html?masohoso=' . $masohoso);
		} else {
			$msg = 'Không thể đăng ký';
		}
	} else {
		$msg = 'Mã xác nhận chưa đúng, vui lòng nhập lại';
	}
}
?>
<link href="lanhsu/css/metro.css" rel="stylesheet">
<link href="lanhsu/css/metro-icons.css" rel="stylesheet">
<link href="lanhsu/css/metro-responsive.css" rel="stylesheet">
<link href="lanhsu/css/metro-schemes.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="lanhsu/css/style.css">
<script src="lanhsu/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="lanhsu/js/select2.min.js"></script>
<script type="text/javascript" src="lanhsu/js/metro.js"></script>
<script type="text/javascript" src="lanhsu/js/jquery.inputmask.js"></script>
<script type="text/javascript" src="js/abtc_regis.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	nhaplieu();upload_congvanxinphep();upload_giaytolienquan();delete_file();
	$(".ngaythangnam").inputmask();
	<?php if(isset($msg) && $msg) : ?>
        $.Notify({type: 'alert', caption: 'Thông báo', content: <?php echo "'".$msg."'"; ?>});
    <?php endif; ?>
    $("#btnRefresh").click(function(){
		$.get('get_captcha.php', function(data){
			$("#captcha_code").html(data);
		});
	});
	$(".open_window").click(function(){
	  window.open($(this).attr("href"), '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=0, left=100, width=1024, height=800');
	  return false;
	});
});
</script>
<article id="content">
	<div class="wrapper">
	    <div class="box1">
			<h2 class="color3"><strong>Đ</strong>ăng ký <span> cấp thẻ ABTC trực tuyến</span></h2>
      		<hr class="bg-black" />
			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" id="themabtcform" data-role="validator" data-show-required-state="false" enctype="multipart/form-data">
			<?php $csrf->echoInputField(); ?>
			<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : ''; ?>" />
			<div class="grid">
				<div class="row cells12">
					<div class="cell colspan3 padding-top-10 align-right"><b>1. Đơn vị xin phép</b></div>
					<div class="cell colspan4 input-control select">
						<select name="id_donvi_xinphep_1" id="id_donvi_xinphep_1">
							<option value="">Chọn đơn vị xin phép</option>
							<?php
								if($donvi_list){
									foreach ($donvi_list as $dv) {
										echo '<option value="'.$dv['_id'].'"'.($dv['_id']==$id_donvi_xinphep_1 ? ' selected' : '').'>'.$dv['ten'].'</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="cell colspan2 input-control text">
						<input type="text" name="tencongvanxinphep" id="tencongvanxinphep" value="<?php echo isset($tencongvanxinphep) ? $tencongvanxinphep : ''; ?>" placeholder="- Số công văn xin phép -" data-validate-func="required"/>
						<span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
					</div>
					<div class="cell colspan2 input-control text" data-role="datepicker" data-format="dd/mm/yyyy" data-scheme="darcula">
						<input type="text" name="ngaykycongvanxinphep" id="ngaykycongvanxinphep" value="<?php echo isset($ngaykycongvanxinphep) ? $ngaykycongvanxinphep : ''; ?>" placeholder="- Ngày ký công văn xin phép - " data-inputmask="'alias': 'date'" class="ngaythangnam"/>
					</div>
					<div class="cell input-control file upload" data-role="input">
						<input type="file" name="dinhkem_filecongvanxinphep[]" multiple="multiple" class="dinhkem_filecongvanxinphep" accept="*" />
					</div>
				</div>
				<div id="files_congvanxinphep">
					<?php
						if(isset($filecongvanxinphep) && $filecongvanxinphep){
							foreach ($filecongvanxinphep as $cvxp) {
								echo '<div class="row cells12" style="padding:0px 0px 10px 0px;margin:0px;">';
									echo '<div class="cell colspan2"></div>';
									echo '<div class="cell colspan10 input-control text">';
										echo '<input type="hidden" name="congvanxinphep_alias_name[]" value="'.$cvxp['alias_name'].'" readonly/>';
										echo '<input type="hidden" name="congvanxinphep_filetype[]" value="'.$cvxp['filetype'].'" readonly/>';
										echo '<span class="mif-attachment prepend-icon"></span>';
										echo '<input type="text" name="congvanxinphep_filename[]" value="'.$cvxp['filename'].'" class="bg-grayLighter" style="padding-left:50px;"/>';
										echo '<div class="button-group">';
											echo '<a href="get.xoataptin.html?filename='.$cvxp['alias_name'].'" onclick="return false;" class="delete_file button"><span class="mif-cross fg-red"></span></a>';
											echo '<a href="'.$target_files.$cvxp['alias_name'].'" class="button" target="_blank"><span class="mif-file-download fg-blue"></span></a>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						}
					?>
				</div>
				<div class="row cells12">
					<div class="cell colspan3 padding-top-10 align-right"><b>2. Nước cấp thẻ</b></div>
					<div class="cell colspan9 input-control select" data-role="select" data-multiple="true" data-placeholder="Nước cấp thẻ">
						<select name="id_quocgia[]" id="id_quocgia" class="select2" multiple>
						<?php
							$quocgia = new QuocGia();$quocgia_list = $quocgia->get_all_list();
							if($quocgia_list){
								foreach ($quocgia_list as $qg) {
									if(in_array($qg['_id'], $id_quocgia)) $selected = 'selected';
									else $selected = '';
									echo '<option value="'.$qg['_id'].'"'.$selected.'>'.$qg['ten'].'</option>';
								}
							}
						?>
						</select>
					</div>
				</div>
				<div class="row cells12">
					<div class="cell colspan3 align-right"><b>3. Các giấy tờ liên quan</b></div>
				</div>
				<div class="row cells12">
					<div class="cell colspan11 input-control select">
						<select name="select_giaytolienquan" id="select_giaytolienquan">
						<?php
							foreach ($arr_giaytolienquan as $key => $value) {
								echo '<option value="'.$key.'">'.$value.'</option>';
							}
						?>
						</select>
					</div>
					<div class="cell input-control file upload" data-role="input">
						<input type="file" name="dinhkem_filegiaytolienquan[]" multiple="multiple" class="dinhkem_giaytolienquan" accept="*" />
					</div>
				</div>
				<div id="files_giaytolienquan">
					<?php
						if(isset($giaytolienquan) && $giaytolienquan){
							foreach ($giaytolienquan as $gt) {
								echo '<div class="row cells12" style="padding:0px 0px 10px 0px;margin:0px;">';
									echo '<div class="cell colspan12 input-control text">';
										echo '<input type="hidden" name="giaytolienquan_alias_name[]" value="'.$gt['alias_name'].'" readonly/>';
										echo '<input type="hidden" name="giaytolienquan_filetype[]" value="'.$gt['filetype'].'" readonly/>';
										echo '<input type="hidden" name="giaytolienquan_key[]" value="'.$gt['order'].'" readonly/>';
										echo '<span class="mif-attachment prepend-icon"></span>';
										echo '<input type="text" name="giaytolienquan_filename[]" value="'.$gt['filename'].'" class="bg-grayLighter" style="padding-left:50px;"/>';
										echo '<div class="button-group">';
											echo '<a href="get.xoataptin.php?filename='.$gt['alias_name'].'" onclick="return false;" class="delete_file button"><span class="mif-cross fg-red"></span></a>';
											echo '<a href="'.$target_files.$gt['alias_name'].'" class="button" target="_blank"><span class="mif-file-download fg-blue"></span></a>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						}
					?>
				</div>
				<div class="row cells12">
					<div class="cell colspan12 input-control textarea">
						<textarea name="ghichu" id="ghichu" placeholder="Ghi chú"><?php echo isset($ghichu) ? $ghichu : br2nl('Họ tên: <br />Điện thoại: <br />Email: '); ?></textarea>
					</div>
				</div>
				<div class="row cells12">
					<div class="cell colspan3 padding-top-10 align-right">Mã xác nhận</div>
					<div class="cell colspan5 input-control text">
						<input type="text" name="captcha" id="captcha" />
					</div>
					<div class="cell colspan4">
						<div id="captcha_code" style="display:inline;"><?php echo $users_regis->generate_capcha(); ?></div>
						&nbsp;<a href="#" onclick="return false;" id="btnRefresh"><span class="mif-sync-problem mif-2x"></span></a>
					</div>
				</div>
				<div class="row cells12">
					<div class="cell colspan12 align-center">
						<button name="submit" id="submit" value="OK" class="button bg-black fg-white"><span class="mif-checkmark"></span> Cập nhật</button>
						<a href="abtc_instruction.php" class="button"><span class="mif-keyboard-return"></span> Trở về</a>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</article>
<?php require_once('footer.php'); ?>