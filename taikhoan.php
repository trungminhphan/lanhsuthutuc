<?php
require_once('header.php');
$doanra = new DoanRa_Regis();$doanvao = new DoanVao_Regis();$abtc = new ABTC_Regis();
if(!$users_regis->isLoggedIn()){
    transfers_to('login.html?url='. $_SERVER['REQUEST_URI']);
}
if($users_regis->isLoggedIn()){ $id_user = $users_regis->get_userid();} else { $id_user = ''; }
$users_regis->id = $id_user; $u = $users_regis->get_one();
$doanra->id_user = $id_user; $doanvao->id_user = $id_user; $abtc->id_user = $id_user;
if($u['email'] == 'songoaivu@gmail.com' || $u['email'] == 'songoaivu2017@gmail.com'){
  $doanra_list = $doanra->get_all_list();
  $doanvao_list = $doanvao->get_all_list();
  $abtc_list = $abtc->get_all_list();
} else {
  $doanra_list = $doanra->get_list_to_user();
  $doanvao_list = $doanvao->get_list_to_user();
  $abtc_list = $abtc->get_list_to_user();
}
?>
<link href="lanhsu/css/metro.css" rel="stylesheet">
<link href="lanhsu/css/metro-icons.css" rel="stylesheet">
<link href="lanhsu/css/metro-responsive.css" rel="stylesheet">
<link href="lanhsu/css/metro-schemes.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="lanhsu/css/style.css">
<script src="lanhsu/js/metro.js"></script>
<article id="content">
  <div class="wrapper">
      <div class="box1">
          <h2><strong>T</strong>hông<span> tin tài khoản</span></h2>
          <hr class="bg-black" />
          <h4 style="color:#000;">Thông tin tài khoản [<a href="changes_info.html">Cập nhật</a>] [<a href="logout.html">Đăng xuất</a>]</h4>
            <ul>
              <li>Tài khoản: <?php echo $u['email']; ?> </li>
              <li>Họ tên: <?php echo isset($u['hoten']) ? $u['hoten'] : ''; ?> </li>
              <li>Đơn vị: <?php echo isset($u['donvi']) ? $u['donvi'] : ''; ?> </li>
              <li>Chức vụ: <?php echo isset($u['chucvu']) ? $u['chucvu'] : ''; ?> </li>
              <li>Điện thoại: <?php echo isset($u['dienthoai']) ? $u['dienthoai'] : ''; ?> </li>
            </ul>
          <h4 style="color:#000;">Danh sách đăng ký trực tuyến</h4>
          <table class="table hover border bordered striped">
            <thead>
            <tr>
              <th>Mã số</th>
              <th>Số công văn</th>
              <th>Loại công văn</th>
              <th>Tình trạng</th>
              <th><i class="mif mif-pencil"></i></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if($doanra_list){
              foreach($doanra_list as $dr){
                $t = isset($dr['status'][0]['t']) ? $dr['status'][0]['t'] : 0;
                if($t == 3) {
                  $download = ' [<a href="dl/'.$dr['masohoso'].'/doanra" target="_blank"><b>Download</b></a>]';
                } else $download = '';
                echo '<tr>';
                echo '<td><a href="tra-cuu.html?active=tra-cuu&masohoso='.$dr['masohoso'].'&submit=OK">'.$dr['masohoso'].'</a></td>';
                echo '<td>'.$dr['congvanxinphep']['ten'].'</td>';
                echo '<td>Xuất cảnh</td>';
                echo '<td>'.$arr_tinhtrang[$t].'<br />'.$dr['status'][0]['noidung'].$download.'</td>';
                if($t == 3 || $t==4){
                  echo '<td></td>';
                } else {
                  echo '<td><a href="doanra_regis.html?id='.$dr['_id'].'&act=edit"><i class="mif mif-pencil"></i></a></td>';
                }
                echo '</tr>';
              }
            }
            if($doanvao_list){
              foreach($doanvao_list as $dv){
                $t = isset($dv['status'][0]['t']) ? $dv['status'][0]['t'] : 0;
                if($t == 3) {
                  $download = ' [<a href="dl/'.$dv['masohoso'].'/doanvao" target="_blank"><b>Download</b></a>]';
                } else $download = '';
                echo '<tr>';
                echo '<td><a href="tra-cuu.html?active=tra-cuu&masohoso='.$dv['masohoso'].'&submit=OK">'.$dv['masohoso'].'</a></td>';
                echo '<td>'.$dv['congvanxinphep']['ten'].'</td>';
                echo '<td>Nhập cảnh</td>';
                echo '<td>'.$arr_tinhtrang[$t].'<br />'.$dv['status'][0]['noidung'].$download.'</td>';
                if($t == 3 || $t==4){
                  echo '<td></td>';
                } else {
                  echo '<td><a href="doanvao_regis.html?id='.$dv['_id'].'&act=edit"><i class="mif mif-pencil"></i></a></td>';
                }
                echo '</tr>';
              }
            }
            if($abtc_list){
              foreach($abtc_list as $ab){
                $t = isset($ab['status'][0]['t']) ? $ab['status'][0]['t'] : 0;
                if($t == 3) {
                  $download = ' [<a href="dl/'.$ab['masohoso'].'/abtc" target="_blank"><b>Download</b></a>]';
                } else $download = '';
                echo '<tr>';
                echo '<td><a href="tra-cuu.html?active=tra-cuu&masohoso='.$ab['masohoso'].'&submit=OK">'.$ab['masohoso'].'</a></td>';
                echo '<td>'.$ab['congvanxinphep']['ten'].'</td>';
                echo '<td>ABTC</td>';
                echo '<td>'.$arr_tinhtrang[$t].'<br />'.$ab['status'][0]['noidung'].$download.'</td>';
                if($t == 3 || $t==4){
                  echo '<td></td>';
                } else {
                  echo '<td><a href="abtc_regis.html?id='.$ab['_id'].'&act=edit"><i class="mif mif-pencil"></i></a></td>';
                }
                echo '</tr>';
              }
            }
            ?>
            </tbody>
          </table>
      </div>
    </div>
</article>

<?php require_once('footer.php'); ?>
