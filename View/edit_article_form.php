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
    $params = $article->findByID($_GET['id']);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>記事編集｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/article_form.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <form method="post" action="edit_article_complete.php" enctype="multipart/form-data" onSubmit="return check()">
          <input type="hidden" name="MAX_FILE_SIZE" value="33554432" />
          <input type="hidden" name="id" value="<?= $params['id'] ?>">
          <input type="hidden" name="image" value="<?= $params['image'] ?>">
                        
          <div class="post_wrap">

            <div class="post_right"><!--タイトル、本文など　画面の右側-->
              <div class="form_content p_title">
                <input type="text" name="title" class="input-name" placeholder="タイトル" value="<?= $params['title'] ?>">
                  <p class="red required-name"></p>
                  <p class="red count-name"></p>
                  <?php if(isset($err['title'])): ?>
                  <p class="red"><?php echo $err['title']; ?></p>
                  <?php endif; ?>
              </div>

              <div class="form_content p_select">
                <select name="category">
                  <option value="<?= $params['category_id'] ?>"><?= $params['category'] ?></option>
                  <?php
                    $select = $article->selectCategory();

                    foreach($select as $value):
                  ?>
                  <option value="<?php echo $value["id"] ?>">
                    <?php echo $value["name"] ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form_content p_text">
                <textarea name="text" class="input_body" placeholder="説明文"><?= $params['text'] ?></textarea>
                <p class="red required_content"></p>
                <?php if(isset($err['text'])): ?>
                <p class="red"><?php echo $err['text']; ?></p>
                <?php endif; ?>
              </div>
            </div><!-- post_right -->
          </div><!--post_wrap-->

          <input type="submit" name="submit" class="submit" value="編集を反映する">
        </form>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>