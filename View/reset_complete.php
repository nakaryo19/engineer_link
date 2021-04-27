<?php
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if (!parse_url($referer, PHP_URL_HOST) == 'reset_pass_form.php'){
     header('Location: top.php');
    return;
}

session_start();
require_once('../Models/User.php');

$err = [];

$password = filter_input(INPUT_POST,'password');
if(!preg_match("/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}$/i", $password)){
    $err['password'] = '*パスワードは半角英字と半角数字を含む8文字以上の文字列にしてください';
}
$password_conf = filter_input(INPUT_POST,'pass_conf');
if($password !== $password_conf){
    $err['pass_conf'] = '*確認用パスワードが異なっています';
}

if(count($err) > 0){
    $_SESSION = $err;
    header('Location: reset_pass_form.php');
    return;
    
}else {
    //ユーザ登録処理
    $user = new UserLogic();
    $user->passReset($_POST['id'],$_POST['password']);
    var_dump($_POST);
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>パスワード再設定完了｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/complete.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="comp_form_wrap2">
          <h2 class="comp_h2">パスワードの再設定が完了しました</h2>
          <p class="comp_a"><a href="login.php">ログインはこちら</a></p>
        </div>
      </div><!--container-->
      <?php require("footer.php"); ?>
    </div><!--all_wrapper-->
  </body>
</html>