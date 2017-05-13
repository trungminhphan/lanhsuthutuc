<?php
require_once('header.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$tintuc = new TinTuc();
$tintuc->id = $id; $tt = $tintuc->get_one();
?>
<article id="content">
	<div class="wrapper">
	    <div class="box1">
	    	<div class="wrapper">
	        	<section class="col12">
	        	<h2><?php echo $tt['tieude']; ?></h2>
	        	<div class="wrapper tab-content" style="margin-top:10px;">
	        		<p class="pad_bot2"><?php echo $tt['mota']; ?></p>
	        		<p class="pad_bot2"><?php echo $tt['noidung']; ?></p>
	        	</div>
	        	</section>
	        	<section class="col12">
	        		<h2>Các tin khác</h2>
	        		<ul>
	        		<?php
	        		$relates = $tintuc->get_relate_list();
	        		if($relates){
	        			foreach ($relates as $r) {
	        				echo '<li><a href="chitiettintuc.php?id='.$r['_id'].'">'.$r['tieude'].'</a></li>';
	        			}
	        		}
	        		?>
	        		</ul>
	        	</section>
	        </section>
	    </div>
	</div>
</div>
<?php require('footer.php'); ?>