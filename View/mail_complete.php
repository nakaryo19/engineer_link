<?php
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if (!parse_url($referer, PHP_URL_HOST) == 'mail_form.php'){
     header('Location: top.php');
    return;
}

session_start();
require_once('../Models/User.php');

$err = [];

if(!$email = filter_input(INPUT_POST,'mail')){
    $err['mail'] = '*メールアドレスを入力してください';
    $_SESSION = $err;
    header('Location: mail_form.php');
    return;
}

$user = new UserLogic();
$result = $user->findUserMail($_POST['mail']);

//メールアドレスが登録されてない場合
if($result == false){
    header('Location: mail_form.php');
    $err['false'] = '*ご入力いただいたメールアドレスでのご登録はありません';
    $_SESSION = $err;
    return;
}else{
    //受信者の登録情報を取得
    $params = $user->getUser($_POST['mail']);
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>メール送信完了｜Engineer Link〜エンジニア知識共有サイト〜</title>
    <link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="../css/mail_complete.css?<?php echo date("YmdHis"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="all_wrapper">
      <?php require("header.php"); ?>

      <div class="container">
        <div class="complete_form_wrap">
          <h2>メールの送信が完了しました</h2>
          <p>ご登録頂いているメールアドレス宛にパスワード再設定用のURLを送信しました。</p>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div>
  </body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 設置した場所のパスを指定する
require('../PHPMailer/src/PHPMailer.php');
require('../PHPMailer/src/Exception.php');
require('../PHPMailer/src/SMTP.php');

// 文字エンコードを指定
mb_language('uni');
mb_internal_encoding('UTF-8');

// インスタンスを生成（true指定で例外を有効化）
$mail = new PHPMailer(true);

// 文字エンコードを指定
$mail->CharSet = 'utf-8';

try {
  // デバッグ設定
  // $mail->SMTPDebug = 2; // デバッグ出力を有効化（レベルを指定）
  // $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str<br>";};

  // SMTPサーバの設定
  $mail->isSMTP();                          // SMTPの使用宣言
  $mail->Host       = 'smtp.gmail.com';   // SMTPサーバーを指定
  $mail->SMTPAuth   = true;                 // SMTP authenticationを有効化
  $mail->Username   = 'techryo19@gmail.com';   // SMTPサーバーのユーザ名
  $mail->Password   = 'rfvngulhxzillpid';           // SMTPサーバーのパスワード
  $mail->SMTPSecure = 'false';  // 暗号化を有効（tls or ssl）無効の場合はfalse
  $mail->Port       = 587; // TCPポートを指定（tlsの場合は465や587）

  // 送受信先設定（第二引数は省略可）
  $mail->setFrom('techryo19@gmail.com', 'Engineer Link〜エンジニア知識共有サイト〜'); // 送信者
  $mail->addAddress($_POST['mail'], $params['name'].'様');   // 宛先
  //$mail->addReplyTo('replay@example.com', 'お問い合わせ'); // 返信先
  //$mail->addCC('cc@example.com', '受信者名'); // CC宛先
  $mail->Sender = 'techryo19@gmail.com'; // Return-path

  // 送信内容設定
  $mail->Subject = '【Engineer Link】パスワード再設定用URLの送付'; 
  $mail->Body    = 
      '
      ※このメールはシステムからの自動返信です。
      
      ＜'.$params['user_name'].'＞様
      
      お世話になっております。
      パスワード再設定の申請を受け付けました。

      以下URLよりパスワード再設定ページにアクセスの上、パスワードの再設定を行ってください。
      
      http://localhost/php_selfmade/View/reset_pass_form.php?id='.$params['id'];  

  // 送信
  $mail->send();
} catch (Exception $e) {
  // エラーの場合
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>