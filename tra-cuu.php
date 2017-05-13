<?php
require_once('header.php');
$vanbanphapquy = new VanBanPhapQuy();
$doanra_regis = new DoanRa_Regis();
$doanvao_regis = new DoanVao_Regis();
$abtc_regis = new ABTC_Regis();
$loaihoso='';
if(isset($_GET['submit'])){
	$arr_query = array();
	$masohoso = isset($_GET['masohoso']) ? $_GET['masohoso'] : '';
	$loaihoso = isset($_GET['loaihoso']) ? $_GET['loaihoso'] : '';
      if($loaihoso == 'doanra'){
            $doanra = new DoanRa_Regis();
            $doanra->masohoso = $masohoso;
            $dr = $doanra->get_one_mshs();
            if($dr && $dr['status']) $status = $dr['status'];
      }
      if($loaihoso == 'doanvao'){
            $doanvao = new DoanVao_Regis();
            $doanvao->masohoso = $masohoso;
            $dv = $doanvao->get_one_mshs();
            if($dv && $dv['status']) $status = $dv['status'];
      }

      if($loaihoso == 'abtc'){
            $abtc = new ABTC_Regis();
            $abtc->masohoso = $masohoso;
            $a = $abtc->get_one_mshs();
            if($a && $a['status']) $status = $a['status'];
      }

}
?>
<link href="../lanhsu/css/metro.css" rel="stylesheet">
<link href="../lanhsu/css/metro-icons.css" rel="stylesheet">
<link href="../lanhsu/css/metro-responsive.css" rel="stylesheet">
<link href="../lanhsu/css/metro-schemes.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../lanhsu/css/style.css">
<script src="../lanhsu/js/jquery-2.1.3.min.js"></script>
<script src="../lanhsu/js/metro.js"></script>
<style type="text/css">
.timeline {
    white-space:nowrap;
    overflow-x: hidden;
    padding:30px 0 10px 0;
    position:relative;
}

.entry {
    display:inline-block;
    vertical-align:top;
    background:#13519C;
    color:#fff;
    padding:10px;
    font-size:12px;
    text-align:center;
    position:relative;
    border-top:4px solid #06182E;
    border-radius:3px;
    min-width:200px;
    width: 200px;
    max-width:500px;
    margin-left: 20px;
    font-size: 15px;
    white-space: normal;
}

.success{
      background:green !important;
}
.failed{
      background:red !important;     
}

.entry:after {
    content:'';
    display:block;
    background:#eee;
    width:7px;
    height:7px;
    border-radius:6px;
    border:3px solid #06182E;
    position:absolute;
    left:50%;
    top:-30px;
    margin-left:-6px;
}

.entry:before {
    content:'';
    display:block;
    background:#06182E;
    width:5px;
    height:20px;
    position:absolute;
    left:50%;
    top:-20px;
    margin-left:-2px;
}

.entry h1 {
    color:#fff;
    font-size:18px;
    font-family:Georgia, serif;
    font-weight:bold;
    margin-bottom:10px;
}

.entry h2 {
    letter-spacing:.2em;
    margin-bottom:10px;
    font-size:14px;
}

.bar {
    height:4px;
    background:#eee;
    width:100%;
    position:relative;
    top:13px;
    left:0;
}
</style>
<article id="content">
	<div class="wrapper">
	    <div class="box1">
      		<h2><strong>T</strong>ra<span> cứu tình trạng hồ sơ</span></h2>
      		<hr class="bg-black" />
      		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET" data-role="validator" data-show-required-state="false">
      			<input type="hidden" name="active" id="active" value="tra-cuu">
      			<div class="grid">
      				<div class="row cells12">
      					<div class="cell colspan2 padding-top-10 align-right">Mã số hồ sơ</div>
						<div class="cell colspan4 input-control text">
							<input type="text" name="masohoso" id="masohoso" value="<?php echo isset($masohoso) ? $masohoso: ''; ?>">
						</div>
						<div class="cell colspan2 padding-top-10 align-right">Loại hồ sơ</div>
						<div class="cell colspan4 input-control select">
							<select name="loaihoso" id="loaihoso" class="select2">
								<option value="doanra" <?php echo $loaihoso=='doanra' ? ' selected': ''; ?>>Xuất cảnh</option>}
								<option value="doanvao" <?php echo $loaihoso=='doanvao' ? ' selected': ''; ?>>Nhập cảnh</option>}
								<option value="abtc" <?php echo $loaihoso=='abtc' ? ' selected': ''; ?>>ABTC</option>
							</select>
						</div>
      				</div>
      				<div class="row cells12">
						<div class="cell colspan12 align-center">
							<button name="submit" id="submit" value="OK" class="button bg-black fg-white"><span class="mif-search"></span> Tìm</button>
						</div>
					</div>
      			</div>
      		</form>
      		<?php if(isset($status) && $status): ?>
      		<hr />
      		<h2><strong>K</strong>ết<span> quả tìm kiếm</span></h2>
      		<?php
                  if(isset($status) && $status){
                        echo '<div class="bar"></div>';
                        echo '<div class="timeline">';
                        $count = count($status)-1;
                        foreach($status as $key => $value){
                              $t = $status[$count]['t'];
                              if($t == 3) $class = 'success';
                              else if($t==4) $class ='failed';
                              else $class= '';
                              echo '<div class="entry '.$class.'">';
                              echo date("d/m/Y", $status[$count]['date_post']->sec);
                              echo '<br /><b>'. $arr_tinhtrang[$t].'</b>';
                              echo '<br /><br />' . $status[$count]['noidung'];
                              echo '</div>';
                              $count = $count-1;
                        }
                        echo '</div>';
                        /*foreach($status as $key => $value){
                              echo '<div>';
                              echo $arr_tinhtrang[$value['t']];
                              echo '</div>';
                        }*/
                        
                        
                  }
      		/*foreach ($vanban_list as $vb) {
      			$linhvuc->id = $vb['id_linhvuc']; $lv = $linhvuc->get_one();
      			$donvi->id = $vb['id_coquanbanhanh']; $cq = $donvi->get_one();
      			echo '<strong>'.$vb['sovanban'] . ' - ' . $vb['trichyeu'] . '</strong>';
      			echo '<br />Lĩnh vực: <b>' . $lv['ten'] . '</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      			echo '<br />Loại văn bản: <b>' . $vb['loaivanban'] . '</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      			echo '<br />Cơ quan ban hành: <b>' . $cq['ten'] . '</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      			echo '<br />Ngày ban hành: <b>' . date("d/m/Y", $vb['ngaybanhanh']->sec) . '</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      			echo '<br /> Đính kèm: ';
      			if($vb['dinhkem']){
      				foreach ($vb['dinhkem'] as $dk) {
      					echo '<span class="tag alert"><a href="'.$folder_files_public.$dk['aliasname'].'" class="fg-white"><span class="mif-attachment"></span> '.$dk['filename'].'</span></a> &nbsp;';
      				}
      			}
      			echo '<hr class="bg-black" />';
      		}*/
      		?>

                  <!--<div class="bar"></div>
                  <div class="timeline">
                      <div class="entry">
                        10/10/2017<br />
                        <b>Đang xử lý</b>
                      </div>
                      <div class="entry">
                          Here's the info about this date
                      </div>
                      <div class="entry">
                          Here's the info about this date
                      </div>
                      <div class="entry">
                          Here's the info about this date
                      </div>
                  </div>-->
      		<?php else: ?>
      			<h2>Không tìm thấy</h2>
      		<?php endif; ?>
      	</div>

    </div>
</article>
<?php
require_once('footer.php');
?>