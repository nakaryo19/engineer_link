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
    $params = $article->findByHistory($_GET['id']);

    //DBからいいねを取得
	$dbPostGoodNum = count($article->getGood($_GET['id']));
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>投稿記事一覧｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/history.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="post_wrapper">
          <h2><?= $_SESSION['login_user']['user_name'] ?>さんの投稿記事</h2>
            
            <div class="newpost_flex">
                        
              <?php foreach($params as $value): ?>
              <div class="product_wrap">
                <a href="article_detail.php?id=<?= $value['id'] ?>"><img class="product_img" src="../img/article.png"></a>
                <p>【<?= $value['title'] ?>】</p>
              </div>
              <?php endforeach; ?>
                        
            </div><!-- newpost_flex -->
            
        </div><!-- newpost_wrapper -->
      </div><!--container-->
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>