<?php

session_start();

if(isset($_POST['postId'])){
    
    require_once('../Models/Article.php');
    $article = new Article;
    $article->favorite($_SESSION['login_user']['id'] ,$_POST['postId']);

}else{
    echo 'FAIL TO AJAX REQUEST';
}
 
?>