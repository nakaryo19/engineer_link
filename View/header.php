<link rel="stylesheet" href="../css/header.css?<?php echo date("YmdHis"); ?>">
<header>
  <div class="header_wrapper">
    <div class="header_logo">
      <a href="top.php"><img src="../img/header.jpg" alt="ロゴ" /></a>
      <p>EngineerLink〜エンジニア知識共有サイト〜</p>
    </div>

    
    <div class="header_nav_top">
      <a href="login_form.php" onclick="return confirm('ログアウトしてよろしいですか？')"><i class="fa fa-user"></i> ログアウト</a></li>
      <a href="mypage.php?id=<?= $_SESSION['login_user']['id'] ?>"><i class="fa fa-user"></i> マイページ</a></li>
    </div> 
            
    
  </div>
</header>