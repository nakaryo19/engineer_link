<?php
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if (!parse_url($referer, PHP_URL_HOST) == 'delete_pf_conf.php'){
     header('Location: top.php');
    return;
}

session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>退会確認｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/complete.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="comp_form_wrap">
          <h2 class="comp_h2">退会すると、これまでの投稿内容やお気に入りも含めた<br>全ての情報が削除されます。</h2>
          <p>本当に削除してよろしいですか？</p>
                    
          <a class="btn" href="mypage.php?id=<?= $_SESSION['login_user']['id'] ?>">キャンセル</a>
          <a class="btn" href="delete_pf_complete.php?id=<?= $_SESSION['login_user']['id'] ?>">退会する</a>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>