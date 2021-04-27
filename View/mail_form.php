<?php
session_start();
$err = $_SESSION;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>メール送信フォーム｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/mail_form.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="user_form">
        <h2>パスワード再設定画面のURLを送信します</h2>
        <p class="send_p">ご登録頂いているメールアドレスを入力してください。</p>

        <form action="mail_complete.php" method="post">

          <?php if(isset($err['msg'])): ?>
          <p class="red"><?php echo $err['msg']; ?></p>
          <?php endif; ?>

          <div class="form_content">
            <input class="mail" name="mail" type="text" placeholder="メールアドレス"/>
            <p class="red required_mail"></p>
            <p class="red error_mail"></p>
            <?php if(isset($err['mail'])): ?>
            <p class="red"><?php echo $err['mail']; ?></p>
            <?php endif; ?>
                             
            <?php if(isset($err['false'])): ?>
            <p class="red"><?php echo $err['false']; ?></p>
            <?php endif; ?>
          </div>

          <input type="submit" class="submit" value="メール送信">
        </form>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>