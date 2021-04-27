<?php
session_start();
require_once('../Models/User.php');

$user = new UserLogic();
$result = $user->checkLogin();

if (!$result){
    header('Location: login_form.php');
    return;
}else{
    require_once('../Models/Article.php');
    $article = new Article();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>記事作成｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/article_form.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/validate.js"></script>
    <script>
            //バリデーション
            $(function () {
                validate_post();
            });

            
            
            function check(){
                if(window.confirm('この内容で投稿してよろしいですか？')){ // 確認ダイアログを表示
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
        <form method="post" action="article_complete.php" enctype="multipart/form-data" onSubmit="return check()">
          <input type="hidden" name="MAX_FILE_SIZE" value="33554432" />

            <div class="post_right"><!--タイトル、本文など　画面の右側-->
              <div class="form_content p_title">
                <input type="text" name="title" class="title" placeholder="タイトル">
                <p class="red required_title"></p>
                <?php if(isset($err['title'])): ?>
                <p class="red"><?php echo $err['title']; ?></p>
                <?php endif; ?>
              </div>

              <div class="form_content p_select" class="category">
                <select name="category">
                  <option hidden value="0">--カテゴリーを選択--</option>
                  <?php
                    $params = $article->selectCategory();

                    foreach($params as $value):
                  ?>
                  <option class="category" value="<?php echo $value["id"] ?>">
                    <?php echo $value["name"] ?>
                  </option>
                  <?php endforeach; ?>
                </select>
                                    
                <p class="red required_category"></p>
                <?php if(isset($err['title'])): ?>
                <p class="red"><?php echo $err['title']; ?></p>
                <?php endif; ?>
              </div>

              <div class="form_content p_text">
                <textarea name="text" class="text" placeholder="説明文"><?php echo isset($_POST['text']) ? h($_POST['text']) : ''; ?></textarea>

                <p class="red required_text"></p>
                <?php if(isset($err['text'])): ?>
                <p class="red"><?php echo $err['text']; ?></p>
                <?php endif; ?>
              </div>
              <input type="submit" name="submit" class="submit" value="投稿する">
            </div><!-- post_right -->
          </div><!--post_wrap-->

          
        </form>
      </div>
      
    </div>
    
  </body>
</html>