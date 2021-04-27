<?php
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if (!parse_url($referer, PHP_URL_HOST) == 'delete_pf_conf.php'){
     header('Location: top.php');
    return;
}

session_start();

require_once('../Models/User.php');
$user = new UserLogic();
$user->deleteUser($_GET['id']);
$user->deleteUserP($_GET['id']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>退会完了｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/complete.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="comp_form_wrap2">
          <h2 class="comp_h2">退会手続きが完了しました</h2>
          <p class="comp_a"><a href="login.php">ログインページへ</a></p>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>