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
    $params = $article->getUserGood($_GET['id']);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>お気に入り投稿一覧｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/history.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="post_wrapper">
          <h2>お気に入り投稿一覧</h2>

          <div class="newpost_flex">
            <?php foreach($params as $value): 
                        
            ?>
            <div class="article_wrap">
              <a href="article_detail.php?id=<?= $value['id'] ?>"><img class="product_img" src="../img/article.png"></a>
              <p>【<?= $value['title'] ?>】</p>
              <div class="author_wrap">
                
                <a class="author_name" href="user_detail.php?id=<?= $value['user_id'] ?>"><?= $value['user_name'] ?></a>
              </div>
                            
                            
            </div>
            <?php endforeach; ?>
                        
                        
          </div>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>