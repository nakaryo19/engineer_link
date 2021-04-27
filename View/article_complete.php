<?php
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if (!parse_url($referer, PHP_URL_HOST) == 'article_form.php'){
     header('Location: top.php');
    return;
}

session_start();

require_once('../Models/Article.php');
$article = new Article();
$article->create($_POST,$_SESSION);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>記事作成完了｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/complete.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="comp_form_wrap2">
          <h2 class="comp_h2">記事の作成が完了しました</h2>
          <?php
            $params = $article->toDetail();
          ?>
          <p class="comp_a"><a href="top.php">トップページへ</a></p>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>