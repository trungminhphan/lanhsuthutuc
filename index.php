<?php require_once('header.php');?>
<script type="text/javascript">Cufon.now();</script>
<script type="text/javascript">
$(window).load(function () {
    $('.slider')._TMS({
        preset: 'zabor',
        easing: 'easeOutQuad',
        duration: 800,
        pagination: true,
        banners: true,
        waitBannerAnimation: false,
        slideshow: 6000,
        bannerShow: function (banner) {
            banner.css({
                right: '-700px'
            }).stop().animate({
                right: '0'
            }, 600, 'easeOutExpo')
        },
        bannerHide: function (banner) {
            banner.stop().animate({
                right: '-700'
            }, 600, 'easeOutExpo')
        }
    });  
})
</script>
<header>
  <div class="slider">
    <ul class="items">
      <li> <img src="images/img1.png" alt="Đăng ký Nhập cảnh">
        <div class="banner">
          <div class="wrapper_1"><strong><a href="doanra_instruction.html">Đăng ký Trực tuyến</a></strong></div>
        </div>
      </li>
      <li> <img src="images/img2.png" alt="Đăng ký Xuất cảnh">
        <div class="banner">
          <div class="wrapper_2"><strong><a href="doanvao_instruction.html">Đăng ký Trực tuyến</a></strong></div>
        </div>
      </li>
      <li> <img src="images/img3.png" alt="Đăng ký cấp thẻ ABTC">
        <div class="banner">
          <div class="wrapper_3"><strong><a href="abtc_instruction.html">Đăng ký Trực tuyến</a></strong></div>
        </div>
      </li>
    </ul>
    <ul class="pagination">
      <li id="banner1"><a href="doanra_instruction.html">Xuất Cảnh<span></a></li>
      <li id="banner2"><a href="doanvao_instruction.html">Nhập Cảnh<span></a></li>
      <li id="banner3"><a href="abtc_instruction.html">ABTC<span></a></li>
    </ul>
  </div>
</header>
<!-- / header -->
<!-- content -->
<article id="content">
  <div class="wrapper">
    <h3>Hướng dẫn thủ tục hồ sơ</h3>
  </div>
  <div class="wrapper">
    <div class="box1">
      <div class="line1">
        <div class="line2 wrapper">
          <section class="col1">
            <h2><strong>X</strong>uất <span>Cảnh</span></h2>
            <div class="pad_bot1">
              <figure><img src="images/page1_img1.jpg" alt=""></figure>
            </div>
            Trình tự thủ tục hồ sơ xin phép Xuất cảnh. <a href="thutuc.html?view=doanra" class="button1">Xem chi tiết</a> </section>
          <section class="col1 pad_left1">
            <h2 class="color2"><strong>N</strong>hập <span>Cảnh</span></h2>
            <div class="pad_bot1">
              <figure><img src="images/page1_img2.jpg" alt=""></figure>
            </div>
            Trình tự thủ tục hồ sơ xin phép Nhập cảnh <a href="thutuc.html?view=doanvao" class="button1 color2">Xem chi tiết</a> </section>
          <section class="col1 pad_left1">
            <h2 class="color3"><strong>A</strong>BTC</h2>
            <div class="pad_bot1">
              <figure><img src="images/page1_img3.jpg" alt=""></figure>
            </div>
            Trình tự thủ tục hồ sơ xin cấp thẻ ABTC.<a href="thutuc.html?view=abtc" class="button1 color3">Xem chi tiết</a> </section>
        </div>
      </div>
    </div>
  </div>
</article>
<!-- / content -->
<?php require_once('footer.php'); ?>