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
  $params = $article->findByNew();
  $login_user = $user->getUser($_COOKIE["login_user_mail"]);
  

}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>トップページ｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/top.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <!-- <div class="top">
          <img src='../img/top.jpeg'>
        </div> -->
        <div class="content">
          <div class="user_photo">     
            <?php if(!empty($login_user["img"])):?>
              <img src='../user_img/<?= $login_user["img"] ?>'>
            <?php else: ?>
              <img src='../user_img/profile_icon.png'>
            <?php endif ?>
          </div>
          <div class="profile">
            <!-- <li><a href="mypage.php?id=<?= $_SESSION['login_user']['id'] ?>"><i class="fa fa-user"></i> マイページ</a></li> -->
            <a href="article_form.php"><i class="fa fa-edit"></i> 記事作成</a>
          </div>
        
          <div class="keyword_search">
            <h3>キーワード検索</h3>
            <form action="search_results.php" method="post">
              <input id="search_form"  id="s" name="keysearch" type="text" placeholder="キーワードを入力"/>
              <div class="box">
                <div class="category">
                  <p>カテゴリー</p>
                  <div class="checkbox">
                    <div class="checkbox1">
                      <input type="checkbox" name="category[]" value="HTML/CSS">HTML/CSS
                      <input type="checkbox" name="category[]" value="Javascript">Javascript
                      <input type="checkbox" name="category[]" value="php">php
                      <input type="checkbox" name="category[]" value="Ruby">Ruby
                      <input type="checkbox" name="category[]" value="Java">Java
                    </div>
                    
                  </div>
                </div>
              </div>
              <button type="submit" id="search_btn"><i class="fas fa-search"></i></button>
            </form>
          </div>
          <!-- <div class="category_search">
            <h3>カテゴリー検索</h3>
            <ul class="c_search_btn_wrap">
              <a href="#"><img class="c_search_btn" src="../img/HTMLCSS.jpeg" alt="HTML/CSS"></a>
              <a href="#"><img class="c_search_btn" src="../img/javascript.png" alt="JavaScript"></a>
              <a href="#"><img class="c_search_btn" src="../img/PHP.png" alt="PHP"></a>
              <a href="#"><img class="c_search_btn" src="../img/Ruby.png" alt="Ruby"></a>
              <a href="#"><img class="c_search_btn" src="../img/Java.png" alt="Java"></a>
            </ul>
          </div> -->


          <div class="newpost_wrapper">
            <div class="newpost_flex">
              <h3>新規投稿</h3>
            </div>
                    
            <div class="newpost_flex">
              <?php foreach($params as $value): 
                        
              ?>
              <div class="new_post">
                <a href="article_detail.php?id=<?= $value['id'] ?>"><p>【<?= $value['title'] ?>】</p></a>
                
                  <div class="profile_flex">
                                    
                    <!-- マイページ or 他ユーザーページへ　-->
                    <a class="author_name" href="<?php if($_SESSION['login_user']['id'] === $value['user_id']){ echo "mypage.php"; }else{ echo "user_detail.php?id=".$value['user_id']; } ?>"><?= $value['user_name'] ?></a>
                  </div>

                                
                </div><!-- profile_flex -->
                
              </div><!-- new_post -->
                <?php endforeach; ?> 
                
            </div><!-- newpost_flex -->
          </div><!--newpost_wrapper -->
        </div>
      
    </div>
  </body>
</html>