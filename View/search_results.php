<?php
session_start();

require_once('../Models/User.php');
$user = new UserLogic();
$result = $user->checkLogin();

if (!$result){
    header('Location: login_form.php');
    return;
}
    
    require_once('../Models/Article.php');
    $article = new Article();
    
    
    if(isset($_POST['keysearch']) || isset($_POST["category"])){
      $params = $article->keywordAndCategorySearch($_POST['keysearch'], $_POST['category'] ?? null);
    }else{
      $params = $article->findAll();
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>検索結果一覧｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/history.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/favorite.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="post_wrapper">
          <?php if(isset($_POST['keysearch'])): ?>
          <h3>”<?= $_POST['keysearch'] ?>”の検索結果</h3>
          <?php else: ?>
          <h3>記事一覧</h3>
          <?php endif ?>
                    
          <div class="newpost_flex">
            <?php foreach($params as $value): ?>
            <div class="product_wrap">
              <a href="article_detail.php?id=<?= $value['id'] ?>"><img class="product_img" src="../img/article.png"></a>
              <p>【<?= $value['title'] ?>】</p>
                            
              <div class="favorite_flex">
                <div class="author_wrap">
                  <img class="author_icon" src="<?= $value['user_img'] ?>">
                  <!-- マイページ or 他ユーザーページへ　-->
                  <a class="author_name" href="<?php if($_SESSION['login_user']['id'] === $value['user_id']){ echo "mypage.php"; }else{ echo "user_detail.php?id=".$value['user_id']; } ?>"><?= $value['user_name'] ?></a>
                </div>
                            
              </div> <!-- favorite_flex -->
            </div><!-- product_wrap -->
            <?php endforeach; ?>
                        
          </div><!-- newpost_flex -->
            
        </div><!-- newpost_wrapper -->
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>