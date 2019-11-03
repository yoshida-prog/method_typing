<?php
//共通変数・関数の読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ログインページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

if(!empty($_POST)){
  debug('POST送信があります。');

  //変数にユーザー情報を代入
  $id = $_POST['id'];
  $pass = $_POST['pass'];
  $pass_save = (!empty($_POST['pass_save'])) ? true : false;

  try{
    //DB接続準備
    $dbh = dbConect();
    //SQL文
    $sql = 'SELECT * FROM users WHERE user_id = :user_id';
    $data = array(':user_id' => $id);
    //SQL実行
    $stmt = queryPost($dbh, $sql, $data);
    //クエリ結果を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    debug('クエリ結果の中身：'.print_r($result, true));

    //パスワード照合
    if(!empty($result) && password_verify($pass, $result['user_pass'])){
      debug('パスワードがマッチしました。');
      //ログイン有効期限
      $sesLimit = 60*60;
      //最終ログイン日時を現在日時に
      $_SESSION['login_date'] = time();
      //次回ログインを省略するにチェックがある場合
      if($pass_save){
        debug('次回ログインを省略するにチェックがあります。');
        //ログイン有効期限を30日にしてセット
        $_SESSION['login_limit'] = $sesLimit*24*30;
      }else{
        debug('次回ログインを省略するにチェックはありません。');
        $_SESSION['login_limit'] = $sesLimit;
      }
      //ユーザーIDを格納
      $_SESSION['user_id'] = $result['id'];

      debug('セッション変数の中身：'.print_r($_SESSION,true));
      debug('マイページへ移動します。');
      header("Location:mypage.php");
    }else{
      debug('IDまたはパスワードがアンマッチです。');
      $err_msg['common'] = MSG06;
    }
  }catch(Exception $e){
    error_log('エラー発生：'.$e->getMessage());
    $err_msg['common'] = MSG05;
  }

}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Method Typing</title>
    <link rel="stylesheet" type="text/css" href="css/typing.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
  </head>
  <body>

    <header>
      <div class="title">
        <h1>Method Typing</h1>
      </div>
      <div class="menu">
        <ul>
          <li><a href="top.php">TOP</a></li>
          <?php if(!empty($_SESSION['login_date'])) echo '<li><a href="typing.php">PLAYGAME</a></li>' ?>
          <li><a href="register.php">REGISTER</a></li>
          <?php if(empty($_SESSION['login_date'])) echo '<li><a href="login.php">LOGIN</a></li>' ?>
        </ul>
      </div>
    </header>

    <div class="container">
      <div class="register">
        <h2>ログイン</h2>
        <div class="id-pass-error"><span class="help-block"><?php if(!empty($err_msg['common'])) echo $err_msg['common']; ?></span></div>
        <form method="post">
          <div class="form-group">
            <label>ID　<span class="help-block"></span>
              <input type="text" name="id" id="id" maxlength="20">
            </label>
          </div>
          <div class="form-group">
            <label>PASSWORD　<span class="help-block"><?php if(!empty($error_message)) echo $error_message ?></span>
              <input type="password" name="pass" id="pass" maxlength="20">
            </label>
          </div>
          <label class="checkbox">
            <input type="checkbox" name="pass_save"><span class="checkbox-message">次回ログインを省略する</span>
          </label>
          <input type="submit" value="送信" class="register-submit">
        </form>
      </div>
    </div>

    <footer>

    </footer>

  </body>
</html>
