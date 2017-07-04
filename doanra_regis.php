<?php require_once('header.php');
if(!$users_regis->isLoggedIn()){
    transfers_to('login.html?url='. $_SERVER['REQUEST_URI']);   
}
$donvi = new DonVi();$kinhphi = new KinhPhi();
$donvi_list = $donvi->get_all_list_regis();
$doanra_regis = new DoanRa_Regis();
$id_user = $users_regis->get_userid();
$csrf = new CSRF_Protect();
$msg = '';
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
	$ngaydi = isset($_POST['ngaydi']) ? $_POST['ngaydi'] : '';
	$ngayve = isset($_POST['ngayve']) ? $_POST['ngayve'] : '';
	$songay = isset($_POST['songay']) ? $_POST['songay'] : 0;
	$id_quocgia = isset($_POST['id_quocgia']) ? $_POST['id_quocgia'] : '';
	$id_mucdich = isset($_POST['id_mucdich']) ? $_POST['id_mucdich'] : '';
	$id_kinhphi = isset($_POST['id_kinhphi']) ? $_POST['id_kinhphi'] : '';
	$noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
	$ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';
	if($_POST["captcha"]==$users_regis->get_capcha()){
		//$masohoso = strtoupper(uniqid());
		$stt = $doanra_regis->get_maxstt();
		$masohoso = date("Y") . '-' . $stt . '-XC';
		$doanra_regis->stt = $stt;
		$doanra_regis->masohoso = $masohoso;
		$doanra_regis->congvanxinphep = $congvanxinphep;
		$doanra_regis->ngaydi = $ngaydi != '' ? new MongoDate(convert_date_dd_mm_yyyy($ngaydi)) : '';
		$doanra_regis->ngayve = $ngayve != '' ? new MongoDate(convert_date_dd_mm_yyyy($ngayve)) : '';
		$doanra_regis->songay = $songay;
		$doanra_regis->id_quocgia = $id_quocgia;
		$doanra_regis->id_mucdich = $id_mucdich;
		$doanra_regis->id_kinhphi = $id_kinhphi;
		$doanra_regis->noidung = $noidung;
		$doanra_regis->ghichu = $ghichu;
		$doanra_regis->id_user = $id_user;
		$arr_tinhtrang = array(
			't' => 0,
			'noidung' => 'Đang xử lý',
			'date_post' => new MongoDate(),
			'id_user' => new MongoId($id_user)
		);
		$doanra_regis->status = $arr_tinhtrang;
		if($doanra_regis->insert()){
			transfers_to('success_regis.html?masohoso=' . $masohoso . '&act=doanra');
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
<link rel="stylesheet" type="text/css" href="../lanhsu/css/style.css">
<script src="lanhsu/js/metro.js"></script>
<script type="text/javascript" src="../lanhsu/js/select2.min.js"></script>
<script type="text/javascript" src="../lanhsu/js/jquery.inputmask.js"></script>
<script type="text/javascript" src="js/doanra_regis.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		doanra_regis();	upload_congvanxinphep_regis();delete_file();
		<?php if(isset($msg) && $msg) : ?>
        	$.Notify({type: 'alert', caption: 'Thông báo', content: '<?php echo $msg; ?>'});
    	<?php endif; ?>
    	$("#btnRefresh").click(function(){
    		$.get('get_captcha.php', function(data){
    			$("#captcha_code").html(data);
    		});
    		//$("#captcha_code").attr('src','captcha_code.php');
    		//captcha = '<?php echo $users_regis->generate_capcha(); ?>';
    		//$("#captcha_code").html(captcha);
    	});
	});
</script>
<article id="content">
	<div class="wrapper">
	    <div class="box1">
      		<h2><strong>Đ</strong>ăng ký <span> Xuất Cảnh trực tuyến</span></h2>
      		<hr class="bg-black" />
      		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="regis_doanraform" data-role="validator" data-show-required-state="false" enctype="multipart/form-data">
      		<?php $csrf->echoInputField(); ?>
				<div class="grid">
					<div class="row cells12">
					<div class="cell colspan2 padding-top-10 align-right">Đơn vị</div>
						<div class="cell colspan5 input-control margin-top-10" data-role="select">
							<select name="id_donvi_xinphep_1" id="id_donvi_xinphep_1" class="select2">
							<?php
								if($donvi_list){
									foreach ($donvi_list as $dv) {
										echo '<option value="'.$dv['_id'].'">'.$dv['ten'].'</option>';
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
							<input type="text" name="ngaykycongvanxinphep" id="ngaykycongvanxinphep" value="<?php echo isset($ngaykycongvanxinphep) ? $ngaykycongvanxinphep : ''; ?>" placeholder="Ngày ký." data-inputmask="'alias': 'date'" class="ngaythangnam"/>
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
											echo '<input type="text" name="congvanxinphep_filename[]" value="'.$cvxp['filename'].'" class="bg-grayLighter"/>';
											echo '<a href="get.xoataptin.html?filename='.$cvxp['alias_name'].'" onclick="return false;" class="delete_file button"><span class="mif-cross fg-red"></span></a>';
										echo '</div>';
									echo '</div>';
								}
							}
						?>
					</div>
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Ngày đi</div>
						<div class="cell colspan4 input-control text" data-role="datepicker" data-scheme="darcula" data-format="dd/mm/yyyy">
							<input type="text" name="ngaydi" id="ngaydi" value="<?php echo isset($ngaydi) ? $ngaydi : '';?>" placeholder="Ngày đi." data-inputmask="'alias': 'date'" class="ngaythangnam"/>
						</div>
						<div class="cell colspan2 padding-top-10 align-right">Ngày về</div>
						<div class="cell colspan3 input-control text" data-role="datepicker" data-scheme="darcula" data-format="dd/mm/yyyy">
							<input type="text" name="ngayve" id="ngayve" value="<?php echo isset($ngayve) ? $ngayve : '';?>" placeholder="Ngày về." data-inputmask="'alias': 'date'" class="ngaythangnam"/>
						</div>
						<div class="cell input-control text">
							<input type="text" name="songay" id="songay" value="<?php echo isset($songay) ? $songay : 0; ?>" readonly data-validate-func="min" data-validate-arg="1"/>
							 <span class="input-state-error mif-warning"></span><span class="input-state-success mif-checkmark"></span>
						</div>
					</div>
					<div class="row cells12">	
						<div class="cell colspan2 padding-top-10 align-right">Nước đến</div>
						<div class="cell colspan4 input-control select">
							<select name="id_quocgia[]" id="id_quocgia" class="select2" multiple="multiple">
							<option value="">Chọn Quốc gia</option>
							<?php
								$quocgia = new QuocGia();$quocgia_list = $quocgia->get_all_list();
								if($quocgia_list){
									foreach ($quocgia_list as $qg) {
										echo '<option value="'.$qg['_id'].'"'.(in_array($qg['_id'],$id_quocgia) ? ' selected' :'').'>'.$qg['ten'].'</option>';
									}
								}
							?>
							</select>
						</div>
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
					</div>
					
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Kinh phí</div>
						<div class="cell colspan4 input-control select" data-role="select">
							<select name="id_kinhphi" id="id_kinhphi" class="select2">
							<?php
								$kinhphi = new KinhPhi();$kinhphi_list = $kinhphi->get_all_list();
								if($kinhphi_list){
									foreach ($kinhphi_list as $kp) {
										echo '<option value="'.$kp['_id'].'"'.($id_kinhphi==$kp['_id'] ? ' selected' : '').'>'.$kp['ten'].'</option>';
									}
								}
							?>
							<div class="cell colspan3 padding-top-10 align-right">Mục đích</div>	
							</select>
						</div>
					</div>
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Nội dung</div>	
						<div class="cell colspan10 input-control textarea">
							<textarea name="noidung" id="noidung" placeholder="Nội dung"><?php echo isset($noidung) ? $noidung : ''; ?></textarea>
						</div>
					</div>
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Thông tin liên hệ</div>
						<div class="cell colspan10 input-control textarea">
							<textarea name="ghichu" id="ghichu" placeholder="@ Vui lòng nhập thông tin: #Họ tên:     #Điện thoại:      #Email: "><?php echo isset($ghichu) ? $ghichu : br2nl('Họ tên:<br />Điện thoại:<br />Email:'); ?></textarea>
						</div>
					</div>
					<div class="row cells12">
						<div class="cell colspan2 padding-top-10 align-right">Mã xác nhận</div>
						<div class="cell colspan5 input-control text">
							<input type="text" name="captcha" id="captcha" />
						</div>
						<div class="cell colspan5">
							<div id="captcha_code" style="display: inline;">
								<?php echo $users_regis->generate_capcha(); ?>
							</div>
							<a href="#" onclick="return false;" id="btnRefresh"><span class="mif-sync-problem mif-2x"></span></a>
						</div>
					</div>
					<div class="row cells12">
						<div class="cell colspan12 align-center">
							<button name="submit" id="submit" value="OK" class="button bg-black fg-white"><span class="mif-checkmark"></span> Hoàn thành</button>
							<a href="index.html" class="button"><span class="mif-keyboard-return"></span> Huỷ không đăng ký</a>
						</div>
					</div>
				</div>
			</form>
	    </div>
	</div>
</article>
<?php require_once('footer.php'); ?>