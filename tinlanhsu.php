<?php
require_once('header.php');
$tintuc = new TinTuc();
$tintuc_list = $tintuc->get_all_list();
?>
<article id="content">
	<div class="wrapper">
	    <div class="box1">
	      <div class="wrapper">
	        <section class="col12">
	        	<h2><strong>T</strong>in <span>Lãnh sự</span></h2>
	        	<?php
	        	if($tintuc_list){
	        		foreach ($tintuc_list as $tt) {
	        			$hinhanh = isset($tt['hinhanh'][0]['aliasname']) ? $tt['hinhanh'][0]['aliasname'] : '';
	        			echo '<div class="wrapper tab-content" style="margin-top:10px;">';
	        			echo '<p class="pad_bot2"><a href="chitiettintuc.php?id='.$tt['_id'].'"><strong>'.$tt['tieude'].'</strong></a></p>';
	        			echo '<p class="pad_bot1">'.($hinhanh ? '<img src="'.$folder_files_public.$hinhanh.'" style="height:100px;float:left;margin-right:10px;"/>' : '') .$tt['mota'].'</p>';
	        			echo '</div>';
	        		}
	        	}
	        	?>	        
	    </div>
	</div>
</div>
<?php require_once('footer.php'); ?>