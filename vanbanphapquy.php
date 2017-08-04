<?php
require_once('header.php');
$vanbanphapquy = new VanBanPhapQuy();
$linhvuc = new LinhVuc();$donvi = new DonVi();
$linhvuc_list = $linhvuc->get_all_list();
if(isset($_GET['submit'])){
	$arr_query = array();
	$id_linhvuc = isset($_GET['id_linhvuc']) ? $_GET['id_linhvuc'] : '';
	//$loaivanban = isset($_GET['loaivanban']) ? $_GET['loaivanban'] : '';
	$sovanban = isset($_GET['sovanban']) ? $_GET['sovanban'] : '';
	$trichyeu = isset($_GET['trichyeu']) ? $_GET['trichyeu'] : '';
	if($id_linhvuc) array_push($arr_query, array('id_linhvuc' => $id_linhvuc));
	//if($loaivanban) array_push($arr_query, array('loaivanban' => $loaivanban));
	if($sovanban) array_push($arr_query, array('sovanban' => new MongoRegex('/'.$sovanban.'/i')));
	if($trichyeu) array_push($arr_query, array('sovanban' => new MongoRegex('/'.$trichyeu.'/i')));
	if(count($arr_query) > 0){
		$query = array('$and' => $arr_query);
		$vanban_list = $vanbanphapquy->get_list_condition($query);
	} else {
		$vanban_list = $vanbanphapquy->get_list_limit(50);
	}
}
?>
<link href="lanhsu/css/metro.css" rel="stylesheet">
<link href="lanhsu/css/metro-icons.css" rel="stylesheet">
<link href="lanhsu/css/metro-responsive.css" rel="stylesheet">
<link href="lanhsu/css/metro-schemes.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../lanhsu/css/style.css">
<script src="../lanhsu/js/metro.js"></script>
<article id="content">
	<div class="wrapper">
	    <div class="box1">
      		<h2><strong>T</strong>ra<span> cứu văn bản pháp quy</span></h2>
      		<hr class="bg-black" />
      		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET" data-role="validator" data-show-required-state="false">
      			<input type="hidden" name="active" id="active" value="vanban">
      			<div class="grid">
      				<div class="row cells12">
                                    <div class="cell colspan2 padding-top-10">Số văn bản</div>
                                    <div class="cell colspan4 input-control text">
                                          <input type="text" name="sovanban" id="sovanban" value="<?php echo isset($sovanban) ? $sovanban: ''; ?>">
                                    </div>
      					<div class="cell colspan2 padding-top-10">Lĩnh vực</div>
						<div class="cell colspan4 input-control select">
							<select name="id_linhvuc" id="id_linhvuc" class="select2">
							<option value=""></option>}
							option
							<?php
							if($linhvuc_list){
								foreach ($linhvuc_list as $lv) {
									echo '<option value="'.$lv['_id'].'"'.($lv['_id'] == $id_linhvuc ? ' selected' : '').'>'.$lv['ten'].'</option>';
								}
							}
							?>
							</select>
						</div>
						<!--<div class="cell colspan2 padding-top-10">Loại văn bản</div>
						<div class="cell colspan4 input-control select">
							<select name="loaivanban" id="loaivanban" class="select2">
							<?php
							/*foreach ($arr_loaivanban as $lvb) {
								echo '<option value="'.$lvb.'"'.($lvb == $loaivanban ? ' selected' : '').'>'.$lvb.'</option>';
							}*/
							?>
							</select>
						</div>-->
      				</div>
      				<div class="row cells12">
						<div class="cell colspan2 padding-top-10">Trích yếu</div>
						<div class="cell colspan10 input-control text">
							<input type="text" name="trichyeu" id="trichyeu" value="<?php echo isset($trichyeu) ? $trichyeu: ''; ?>">
						</div>
      				</div>
      				<div class="row cells12">
						<div class="cell colspan12 align-center">
							<button name="submit" id="submit" value="OK" class="button bg-black fg-white"><span class="mif-search"></span> Tìm</button>
						</div>
					</div>
      			</div>
      		</form>
      		<?php if(isset($vanban_list) && $vanban_list->count() > 0): ?>
      		<hr />
      		<h2><strong>K</strong>ết<span> quả tìm kiếm</span></h2>
      		<table class="table striped hovered border bordered">
      			<thead>
      				<tr>
      					<th>STT</th>
      					<th>Số văn bản</th>
      					<th>Trích yếu</th>
      					<th>Cơ quan ban hành</th>
      					<th>Ngày ký</th>
      					<th>Toàn văn</th>
      				</tr>
      			</thead>
      			<tbody>
      		<?php
      		$i = 1;
      		foreach ($vanban_list as $vb) {
      			$lv = $linhvuc->get_linhvuc($vb['id_linhvuc']);
      			$donvi->id = $vb['id_coquanbanhanh']; $cq = $donvi->get_one();
      			echo '<tr>';
      			echo '<td>'.$i.'</td>';
      			echo '<td>'.$vb['sovanban'].'</td>';
      			echo '<td>'.$vb['trichyeu'].'</td>';
      			echo '<td>'.$cq['ten'].'</td>';
      			echo '<td>'.date("d/m/Y", $vb['ngaybanhanh']->sec).'</td>';
      			echo '<td>';
      				foreach ($vb['dinhkem'] as $dk) {
      					echo '<span class="tag alert"><a href="'.$folder_files_public.$dk['aliasname'].'" class="fg-white" target="_blank"><span class="mif-attachment"></span> '.$dk['filename'].'</span></a> &nbsp;';
      				}
      			echo '</td>';
      			echo '</tr>'; $i++;
      			//echo '<strong>'.$vb['sovanban'] . ' - ' . $vb['trichyeu'] . '</strong>';
      			//echo '<br />Lĩnh vực: <b>' . $lv . '</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      			//echo '<br />Loại văn bản: <b>' . implode(", ",$vb['loaivanban']) . '</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      			//echo '<br />Cơ quan ban hành: <b>' . $cq['ten'] . '</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      			//echo '<br />Ngày ban hành: <b>' . date("d/m/Y", $vb['ngaybanhanh']->sec) . '</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      			//echo '<br /> Đính kèm: ';
      			//if($vb['dinhkem']){
      				
      			//}
      			//echo '<hr class="bg-black" />';
      		}
      		?>
      		</tbody></table>
      		<?php elseif(isset($_GET['submit'])): ?>
      			<h2>Không tìm thấy</h2>
      		<?php endif; ?>
      	</div>

    </div>
</article>
<?php
require_once('footer.php');
?>