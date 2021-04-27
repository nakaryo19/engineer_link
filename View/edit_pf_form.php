<?php
session_start();
$err = $_SESSION;

require_once('../Models/User.php');
$user = new UserLogic();
$result = $user->checkLogin();

if (!$result){
    header('Location: login_form.php');
    return;
}else{
    $name = $_SESSION['login_user']['user_name'];
    $mail = $_SESSION['login_user']['mail'];
}

function h($str){
   return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会員情報編集｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/edit_pf.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/validate.js"></script>

    <script>
            // バリデーション
            $(function () {
                validate_editUser();
            });
            
            
            
            function check(){
                if(window.confirm('この内容で編集してよろしいですか？')){ // 確認ダイアログを表示
                    return true; // 「OK」時は送信を実行
                }else{
                    return false; // 送信を中止
                }
            }
      </script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="user_form">
          <h2>会員情報編集</h2>
          <form action="edit_pf_complete.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $_SESSION['login_user']['id'] ?>">
                        
            <label for="file">
              <i class="fas fa-camera"></i>プロフィール写真を選択
              <input name="img" type="file" id="file" accept="image/*" accept=".png, .jpg, .jpeg" required>
              <div id="file_result"></div>
            </label>
                        
            <div class="form_content">
              <input class="name" name="user_name" type="text" value="<?= h($name); ?>" placeholder="ユーザー名">
                                
              <p class="red required_name"></p>
              <p class="red count_name"></p>
              <?php if(isset($err['user_name'])): ?>
              <p class="red"><?php echo $err['user_name']; ?></p>
              <?php endif; ?>
            </div>
                            
            <div class="form_content">
              <input class="mail" name="mail" type="text" value="<?= h($mail); ?>" placeholder="メールアドレス">
                                
              <p class="red required_mail"></p>
              <p class="red error_mail"></p>
              <?php if(isset($err['mail'])): ?>
              <p class="red"><?php echo $err['mail']; ?></p>
              <?php endif; ?>
            </div>
                        
            <input type="submit" name="submit" class="submit" value="変更する" onclick="return confirm('会員情報を変更してよろしいですか？')">                       
            
          </form>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>