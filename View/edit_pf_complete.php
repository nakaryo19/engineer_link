<?php

$img = $_FILES['img']['name'];
move_uploaded_file($_FILES['img']['tmp_name'], '../user_img/'.$img);


$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if (!parse_url($referer, PHP_URL_HOST) == 'edit_pf_form.php'){
     header('Location: top.php');
    return;
}


session_start();

require_once('../Models/User.php');

$err = [];

if(!$name = filter_input(INPUT_POST,'user_name')){
    $err['user_name'] = 'ユーザー名を入力してください';
}else if(mb_strlen($name) > 10){
            $err['user_name'] = '*10文字以内で入力してください';
        }

$pattern_add = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
if(!$email = filter_input(INPUT_POST,'mail')){
    $err['mail'] = '*メールアドレスを入力してください';
}else if(!preg_match($pattern_add, $email)){
    $err['mail'] = '*メールアドレスは正しい形式で入力してください';
}


if(count($err) > 0){
    $_SESSION['err'] = $err;
    header('Location: edit_pf_form.php');
    return;
    
}else {
  $user = new UserLogic();
  $post = $_POST;
  $post['img'] = $img;
  $user->updateUser($post);
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会員情報編集完了｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/complete.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="comp_form_wrap2">
          <h2 class="comp_h2">会員情報編集が完了しました</h2>
          <p class="comp_a"><a href="top.php">トップページへ</a></p>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>