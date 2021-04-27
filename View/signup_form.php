<?php

session_start();
$err = $_SESSION;

?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <title>新規会員登録｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/signup.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/validate.js"></script>
  </head>

  <script>
        //バリデーション
        $(function () {
            validate_signup();
        });

        function check(){
                if(window.confirm('この内容で会員登録してよろしいですか？')){ // 確認ダイアログを表示
                    return true; // 「OK」時は送信を実行
                }else{
                    return false; 
                }
            }
    </script>

    <body>
      <div class="all_wrapper">
        <?php require("header.php"); ?>

        <div class="container">
          <div class="user_form">
            <h2>新規会員登録</h2>
            <form action="register.php" method="post" onSubmit="return check()">
              <div class="form_wrap">
                <div class="form_content">
                  <input class="name" name="user_name" type="text" placeholder="ユーザー名"/>               
                  <p class="red required_name"></p>
                  <p class="red count_name"></p>
                  <?php if(isset($err['user_name'])): ?>
                  <p class="red"><?php echo $err['user_name']; ?></p>
                  <?php endif; ?>
                </div>
                            
                <div class="form_content">
                  <input class="mail" name="mail" type="text" placeholder="メールアドレス"/>   
                  <p class="red required_mail"></p>
                  <p class="red error_mail"></p>
                  <?php if(isset($err['mail'])): ?>
                  <p class="red"><?php echo $err['mail']; ?></p>
                  <?php endif; ?>
                </div>
                            
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
                            
              </div>

              <input class="submit" type="submit"  value="新規登録">
          </form>
          
        </div>
        <?php require("footer.php"); ?>
      </div>
    </body>
</html>