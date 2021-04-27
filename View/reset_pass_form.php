<?php

if(!isset($_GET['id'])){
    header('Location: top.php');
    return;
}

session_start();
$err = $_SESSION;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>パスワード再設定｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/pass_reset.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="user_form">
          <h2>パスワード再設定画面</h2>
          <p class="new_pass">新しいパスワードを入力してください。</p>

          <form action="reset_complete.php" method="post"　onSubmit="return check()">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                        
            <div class="form_content">
              <input class="pass" name="password" type="password" placeholder="パスワード"/>
              <p class="red required_pass"></p>
              <p class="red error_pass"></p>
              <?php if(isset($err['password'])): ?>
              <p class="red"><?php echo $err['password']; ?></p>
              <?php endif; ?>
            </div>

            <div class="form_content">
              <input class="pass_conf" name="pass_conf" type="password" placeholder="パスワード（確認用）"/>
                <p class="red error_pass_conf"></p>
                <?php if(isset($err['pass_conf'])): ?>
                <p class="red"><?php echo $err['pass_conf']; ?></p>
                <?php endif; ?>
            </div>
                        
            <input type="submit" class="submit" value="パスワードを再設定する">
          </form>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>