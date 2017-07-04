<?php
require_once('lanhsu/inc/config.inc.php');
$filename = isset($_GET['filename']) ? $_GET['filename'] : '';
if(file_exists($target_files_regis.$filename)){
	if(unlink($target_files_regis.$filename)){
		echo 'Đã xoá thành công';
	} else {
		echo 'Không thể xoá';
	}
}
?>