<?php
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if (!parse_url($referer, PHP_URL_HOST) == 'edit_article_form.php'){
     header('Location: top.php');
    return;
}

session_start();

require_once('../Models/Article.php');
$article = new Article();
$article->update($_POST,$_FILES);
var_dump($_POST);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>記事編集完了｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/complete.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="comp_form_wrap">
          <h2 class="comp_h2">記事を編集しました</h2>
          <?php
           $params = $article->toDetail();
          ?>
          <p class="comp_a"><a href="mypage.php?id=<?= $_SESSION['login_user']['id'] ?>">マイページへ</a></p>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>