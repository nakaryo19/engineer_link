<?php
session_start();

require_once('../Models/User.php');
$user = new UserLogic();
$result = $user->checkLogin();

if (!$result){
    header('Location: login_form.php');
    return;
}else{
    $params = $user->findByID($_SESSION['login_user']['id']);
    $login_user = $user->getUser($_COOKIE["login_user_mail"]);   
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>マイページ｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/mypage.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>
      <div class="container">
        <div class="form_wrap">
          <h2>マイページ</h2>
                     
          <div class="user_wrap">
            <div class="prof_icon">
              
              <?php if(!empty($login_user["img"])):?>
                <img src='../user_img/<?= $login_user["img"] ?>'>
              <?php else: ?>
                <img src='../user_img/profile_icon.png'>
              <?php endif ?>
            </div>
            <div class="prof_name">
              <h2><?= $params['user_name'] ?></h2>
            </div>
            <div class="mypage_btn">
              <a href="edit_pf_form.php?id=<?= $_SESSION['login_user']['id'] ?>"><button>会員情報変更</button></a>
            </div>
            <div class="mypage_btn">
              <a href="my_article.php?id=<?= $_SESSION['login_user']['id'] ?>"><button>あなたの記事作成履歴</button></a>
            </div>
            <div class="mypage_btn">
              <a href="my_favorite.php?id=<?= $_SESSION['login_user']['id'] ?>"><button>お気に入り記事</button></a>
            </div>
          </div>

          <div class="user_delete">
            <div class="mypage_delete">
              <a href="delete_pf_conf.php?id=<?= $_SESSION['login_user']['id'] ?>"><button>会員情報削除</button></a>
            </div>
          </div>

        </div><!--form_wrap  -->
      </div><!--container  -->
      <?php require("footer.php"); ?>
    </div><!--all_wrapper  -->
  </body>
</html>