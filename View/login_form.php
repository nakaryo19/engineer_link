<?php
session_start();
$err = $_SESSION;

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err']: null;
unset($_SESSION['login_err']);

$_SESSION = array();//セッションの中身の配列を消す
session_destroy();//セッションファイルを消す

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ログイン｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/login.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  
  <body>
    <div class="all_wrapper">
      <?php require("header1.php"); ?>

      <div class="container">
        <div class="login_form">
          <h2>ログイン</h2>

          <?php if(isset($login_err)): ?>
          <p class="red"><?php echo $login_err; ?></p>
          <?php endif; ?>
                    
          <?php if(isset($err['msg'])): ?>
          <p class="red"><?php echo $err['msg']; ?></p>
          <?php endif; ?>
                    
          <form action="login.php" method="post">
            <div class="form_content">
              <input class="input" name="mail" type="text" placeholder="メールアドレス"/>
              <?php if(isset($err['mail'])): ?>
              <p class="red"><?php echo $err['mail']; ?></p>
              <?php endif; ?>
            </div>
                        
            <div class="form_content">
              <input class="input" name="password" type="password" placeholder="パスワード"/>
              <?php if(isset($err['password'])): ?>
              <p class="red"><?php echo $err['password']; ?></p>
              <?php endif; ?>
            </div>
                        
            <input class="sumit_btn" type="submit" value="ログイン">
          </form>

          <a class="signup" href="signup_form.php">新規登録はこちら</a>
          <a class="forget_pass" href="mail_form.php">パスワードをお忘れですか？</a>

        </div><!-- login_form -->
      </div><!--container-->

      <?php require("footer.php"); ?>
    </div><!--all_wrapper-->
  </body>
</html>