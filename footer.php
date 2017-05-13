<!-- footer -->
    <footer>
      <div class="wrapper">
        <nav>
          <ul id="footer_menu">
            <li <?php echo $active_menu == 'index' ? 'class="active"' : ''; ?>><a href="index.html?active=index">Trang chủ</a></li>
            <li <?php echo $active_menu == 'gioi_thieu' ? 'class="active"' : ''; ?>><a href="gioi-thieu.html?active=gioi_thieu">Giới thiệu</a></li>
            <li <?php echo $active_menu == 'lien_he' ? 'class="active"' : ''; ?>><a href="lien-he.html?active=lien_he">Liên hệ</a></li>
            <?php if($users_regis->isLoggedIn()): ?>
            <li><a href="logout.php">Đăng xuất</a></li>
          <?php else: ?>
          <li <?php echo $active_menu == 'login' ? 'id="menu_active"' : ''; ?>><a href="login.html?active=login">Đăng nhập</a></li>
        <?php endif; ?>
          </ul>
        </nav>
        <div class="tel"><span>+84 296</span> 3953 936</div>
      </div>
      <div id="footer_text"><b>&copy; 2016 Sở Ngoại Vụ</a> tỉnh An Giang</b><br>
        Địa chỉ: 8/18 Lý Thường Kiệt, phường Mỹ Bình, TP. Long Xuyên, tỉnh An Giang</div>
    </footer>
    <!-- / footer -->
  </div>
</div>
</body>
</html>