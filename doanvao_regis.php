<?php require_once('header.php');
if(!$users_regis->isLoggedIn()){
    transfers_to('login.html?url='. $_SERVER['REQUEST_URI']);   
}
$doanvao_regis = new DoanVao_Regis();$canbo = new CanBo(); $donvi = new DonVi(); $chucvu = new ChucVu();
$csrf = new CSRF_Protect();
$donvi = new DonVi();$donvi_list = $donvi->get_all_list_regis();
$dmdoanvao = new DMDoanVao();
$id_donvi_tiep='';
$id_user = $users_regis->get_userid();
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

	//$id_dmdoanvao = isset($_POST['id_dmdoanvao']) ? $_POST['id_dmdoanvao'] : '';
	$id_dmdoanvao = new MongoId();
	$tendoan = isset($_POST['tendoan']) ? $_POST['tendoan'] : '';
	$dmdoanvao->id = $id_dmdoanvao;$dmdoanvao->ten = $tendoan;$dmdoanvao->id_user = $id_user;
	$dmdoanvao->insert();

	$id_mucdich = isset($_POST['id_mucdich']) ? $_POST['id_mucdich'] : '';
	$id_donvi_duocphep = isset($_POST['id_donvi_duocphep']) ? $_POST['id_donvi_duocphep'] : '';
	$tencongvanduocphep = isset($_POST['tencongvanduocphep']) ? $_POST['tencongvanduocphep'] : '';
	$ngaybanhanhcongvanduocphep = isset($_POST['ngaybanhanhcongvanduocphep']) ? $_POST['ngaybanhanhcongvanduocphep'] : '';
	$ngayden = isset($_POST['ngayden']) ? $_POST['ngayden'] : '';
	$ngaydi = isset($_POST['ngaydi']) ? $_POST['ngaydi'] : '';
	$ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';
	$noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
	$id_canbo = isset($_POST['id_canbo']) ? $_POST['id_canbo'] : '';
	if($_POST["captcha"]==$users_regis->get_capcha()){
		//$masohoso = strtoupper(uniqid());
		$stt = $doanvao_regis->get_maxstt();
		$masohoso = date("Y") . '-' . $stt .'-NC';
		$doanvao_regis->stt = $stt;
		$doanvao_regis->masohoso = $masohoso;
		$doanvao_regis->congvanxinphep = $congvanxinphep;
		$doanvao_regis->id_dmdoanvao = $id_dmdoanvao;
		$doanvao_regis->id_mucdich = $id_mucdich;
		$doanvao_regis->ngayden = $ngayden != '' ? new MongoDate(convert_date_dd_mm_yyyy($ngayden)) : '';
		$doanvao_regis->ngaydi = $ngaydi != '' ? new MongoDate(convert_date_dd_mm_yyyy($ngaydi)) : '';
		$doanvao_regis->noidung = $noidung;
		$doanvao_regis->ghichu = $ghichu;
		$doanvao_regis->hanxuly = new MongoDate();
		$doanvao_regis->ngayxuly = '';
		$doanvao_regis->id_user = $id_user;
		$arr_tinhtrang = array(
			't' => 0,
			'noidung' => 'Đang xử lý',
			'date_post' => new MongoDate(),
			'id_user' => new MongoId($id_user)
		);
		$doanvao_regis->status = $arr_tinhtrang;
		if($doanvao_regis->insert()){
			transfers_to('success_regis.html?masohoso='.$masohoso . '&act=doanvao');
		} else {
			$msg = 'Không thể đăng ký.';
		}
	} else {
		$msg = 'Mã xác nhận chưa đúng, vui lòng nhập lại';
	}
}
?>
<link href="../lanhsu/css/metro.css" rel="stylesheet">
<link href="../lanhsu/css/metro-icons.css" rel="stylesheet">
<link href="../lanhsu/css/metro-responsive.css" rel="stylesheet">
<link href="../lanhsu/css/metro-schemes.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../lanhsu/css/style.css">
<script src="../lanhsu/js/metro.js"></script>
<script type="text/javascript" src="../lanhsu/js/select2.min.js"></script>
<script type="text/javascript" src="../lanhsu/js/jquery.inputmask.js"></script>
<script type="text/javascript" src="js/doanvao_regis.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".select2").select2({tags: true});
		$(".ngaythangnam").inputmask();
		upload_congvanxinphep();delete_file();
		<?php if(isset($msg) && $msg) : ?>
        	$.Notify({type: 'alert', caption: 'Thông báo', content: '<?php echo $msg; ?>'});
    	<?php endif; ?>
    	$("#btnRefresh").click(function(){
    		$.get('get_captcha.php', function(data){
    			$("#captcha_code").html(data);
    		});
    	});
	});
</script>
<article id="content">
	<div class="wrapper">
	    <div class="box1">
      		<h2 class="color2"><strong>Đ</strong>ăng ký <span> tiếp khác nước ngoài trực tuyến</span></h2>
      		<hr class="bg-black" />
      		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" id="themdoanvaoform" data-role="validator" data-show-required-state="false" enctype="multipart/form-data">
      			<?php $csrf->echoInputField(); ?>
				<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : ''; ?>" />
				<div class="grid">
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Đơn vị Xin phép</div>
						<div class="cell colspan5 input-control select" data-role="select">
							<select name="id_donvi_xinphep_1" id="id_donvi_xinphep_1" class="select2">
							<?php
								if($donvi_list){
									foreach ($donvi_list as $dv) {
										echo '<option value="'.$dv['_id'].'"'.($dv['_id'] == $id_donvi_tiep ? ' selected' : '').'>'.$dv['ten'].'</option>';
									}
								}
							?>
							</select>
						</div>
						<div class="cell colspan2 input-control text">
							<input type="text" name="tencongvanxinphep" id="tencongvanxinphep" value="<?php echo isset($tencongvanxinphep) ? $tencongvanxinphep : ''; ?>" placeholder="Số công văn" data-validate-func="required"/>
							<span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
						</div>
						<div class="cell colspan2 input-control text" data-role="datepicker" data-scheme="darcula" data-format="dd/mm/yyyy">
							<input type="text" name="ngaykycongvanxinphep" id="ngaykycongvanxinphep" value="<?php echo isset($ngaykycongvanxinphep) ? $ngaykycongvanxinphep : ''; ?>" placeholder="Ngày ký" data-inputmask="'alias': 'date'" class="ngaythangnam"/>
						</div>
						<div class="cell input-control file upload" data-role="input">
							<input type="file" name="dinhkem_filecongvanxinphep[]" multiple="multiple" class="dinhkem_filecongvanxinphep" placeholder="Đính kèm" accept="*" />
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
												echo '<a href="'.$target_files_regis.$cvxp['alias_name'].'" class="button" target="_blank"><span class="mif-file-download fg-blue"></span></a>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								}
							}
						?>
					</div>
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Tên đoàn</div>
						<div class="cell colspan10 input-control text">
							<input type="text" name="tendoan" id="tendoan" value="<?php echo isset($tendoan) ? $tendoan : ''; ?>" placeholder="Tên đoàn" data-validate-func="required"/>
							<span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
						</div>
					</div>
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Mục đích</div>
						<div class="cell colspan4 input-control select" data-role="select">
							<select name="id_mucdich" id="id_mucdich" class="select2">
							<?php
								$mucdich = new MucDich();$mucdich_list = $mucdich->get_all_list();
								if($mucdich_list){
									foreach ($mucdich_list as $md) {
										echo '<option value="'.$md['_id'].'"'.($id_mucdich==$md['_id']?' selected' : '').'>'.$md['ten'].'</option>';
									}
								}
							?>
							<div class="cell colspan3 padding-top-10 align-right">Mục đích</div>	
							</select>
						</div>
						<div class="cell colspan3 input-control text" data-role="datepicker" data-scheme="darcula" data-format="dd/mm/yyyy">
							<input type="text" name="ngayden" id="ngayden" value="<?php echo isset($ngayden) ? $ngayden : '';?>" placeholder="Ngày đến." data-inputmask="'alias': 'date'" class="ngaythangnam"/>
						</div>
						<div class="cell colspan3 input-control text" data-role="datepicker" data-scheme="darcula" data-format="dd/mm/yyyy">
							<input type="text" name="ngaydi" id="ngaydi" value="<?php echo isset($ngaydi) ? $ngaydi : '';?>" placeholder="Ngày đi." data-inputmask="'alias': 'date'" class="ngaythangnam"/>
						</div>
					</div>
					
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Nội dung</div>	
						<div class="cell colspan10 input-control textarea">
							<textarea name="noidung" id="noidung" placeholder="Nội dung"><?php echo isset($noidung) ? $noidung : ''; ?></textarea>
						</div>
					</div>
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Ghi chú</div>	
						<div class="cell colspan10 input-control textarea">
							<textarea name="ghichu" id="ghichu" placeholder="Ghi chú"><?php echo isset($ghichu) ? $ghichu : br2nl('Họ tên: <br />Điện thoại: <br/>Email: '); ?></textarea>
						</div>
					</div>
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Mã xác nhận</div>
						<div class="cell colspan5 input-control text">
							<input type="text" name="captcha" id="captcha" />
						</div>
						<div class="cell colspan5">
							<div id="captcha_code" style="display:inline;"><?php echo $users_regis->generate_capcha(); ?></div>
							&nbsp;<a href="#" onclick="return false;" id="btnRefresh"><span class="mif-sync-problem mif-2x"></span></a>
						</div>
					</div>
					<div class="row cells12">
						<div class="cell colspan12 align-center">
							<button name="submit" id="submit" value="OK" class="button bg-black fg-white"><span class="mif-checkmark"></span> Hoàn thành</button>
							<a href="index.html" class="button"><span class="mif-keyboard-return"></span> Trở về</a>
						</div>
					</div>
				</div>
			</form>
	    </div>
	</div>
</article>
<?php require_once('footer.php'); ?>