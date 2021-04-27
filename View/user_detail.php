<?php
session_start();


require_once('../Models/User.php');
$user = new UserLogic();
$result = $user->checkLogin();

if (!$result){
    header('Location: login_form.php');
    return;
}else{
    $params = $user->findByID($_GET['id']);
    $login_user = $user->getUser($_COOKIE["login_user_mail"]);
    
    require_once('../Models/Article.php');
    $article = new Article();
    $history = $article->findByHistory($_GET['id']);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>マイページ｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/user_detail.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="form_wrap">
                    
          <div class="user_wrap">
            <div class="prof_icon">
              <?php if(!empty($params["img"])):?>
                <img src='../user_img/<?= $params["img"] ?>'>
              <?php else: ?>
                <img src='../user_img/profile_icon.png'>
              <?php endif ?>
            </div>
            <div class="prof_name">
              <h2><?= $params['user_name'] ?></h2>
            </div>
          </div>

          <div class="post_wrapper">
            <h2>投稿した記事</h2>
                    
            <div class="post_flex">
              <?php foreach($history as $value): ?>
              <div class="article_wrap">
                <a href="article_detail.php?id=<?= $value['id'] ?>"><p>【<?= $value['title'] ?>】</p></a>
              </div><!-- article_wrap -->
              <?php endforeach; ?>

            </div><!-- post_flex -->

          </div><!-- post_wrapper -->

        </div><!-- form_wrap -->
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>