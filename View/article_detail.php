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
    $login_user = $user->getUser($_COOKIE["login_user_mail"]); 
    
  //DBからいいねを取得
	$dbPostGoodNum = count($article->getGood($_GET['id']));
 }

function h($str){
   return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>記事詳細｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/article_detail.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/favorite.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="detail_wrap">

          <div class="detail_left">
         
            <div class="d_content d_author">
              <div class="author_icon">
                <?php if(!empty($params["img"])):?>
                  <img src='../user_img/<?= $params["img"] ?>'>
                <?php else: ?>
                  <img src='../user_img/profile_icon.png'>
                 <?php endif ?>
              </div>
              <div class="author_name">
                <a href="<?php if($_SESSION['login_user']['id'] === $params['user_id']){
                    echo "mypage.php";
                  }else{
                    echo "user_detail.php?id=".$params['user_id'];
                  } ?>"> <?= $params['user_name'] ?>
                </a>
              </div>
            </div>

            
   
            <!--　いいねボタン　-->
            <section class="post" data-postid="<?php echo $_GET['id'] ?>">
              <div class="btn-good <?php if($article->isGood($_SESSION['login_user']['id'], $params['id'])) echo 'active'; ?>">
                 <!-- 自分がいいねした投稿にはハートのスタイルを常に保持する -->
                 <i class="fa-heart fa-lg px-16
                <?php
                  if($article->isGood($_SESSION['login_user']['id'],$params['id'])){
                      echo ' active fas';
                  }else{
                      echo ' far';
                  }; ?>"></i><span><?php echo $dbPostGoodNum; ?></span>
              </div>
            </section>
     
    
          </div><!-- detail_left -->
 
          <div class="detail_right"><!--（タイトル、本文など）　画面の右側-->
            <div class="d_content d_title">
              <h2>【 <?= $params['title'] ?> 】</h2>
            </div>

            <div class="select_wrap">
              <div class="d_content d_category">
                <p class="s1 category">カテゴリー</p>
                <p class="s2"><?= $params['category'] ?></p>
              </div>
             </div><!-- select_wrap -->

             <div class="d_content d_text">
               <p><?= nl2br(h($params['text'])); ?></p>
             </div>

             <?php if($_SESSION['login_user']['id'] === $params['user_id']): ?>
             <div class="btn_wrap">
              <a class="btn" href="edit_article_form.php?id=<?= $params['id'] ?>"><i class="fa fa-edit"></i> 編集</a>
              <a class="btn" href="delete_article_complete.php?id=<?= $params['id'] ?>" onclick="return confirm('記事を削除します。よろしいですか？')"><i class="fa fa-trash"></i> 削除</a>
             </div>
             <?php endif; ?>
       
          </div><!-- detail_right -->

        </div><!-- detail_wrap -->
      </div><!-- container -->
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>