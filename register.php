<?php
//共通変数・関数の読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ユーザー登録ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

if(!empty($_SESSION['login_date'])){
  header('Location:mypage.php');
}

if(!empty($_POST)){

  debug('POST送信があります。');

  $name = $_POST['name'];
  $id = $_POST['id'];
  $pass = $_POST['pass'];

  //入力チェック
  validRequired($name, 'name');
  validRequired($id, 'id');
  validRequired($pass, 'pass');

  //形式チェック
  validId($id, 'id');
  validPassword($pass, 'pass');

  if(empty($err_msg)){

    //ID・PASSWORD文字数チェック
    validStrLength($id, 'id');
    validStrLength($pass, 'pass');

    if(empty($err_msg)){

      debug('バリデーションOKです。');

      try{
        //DB接続
        $dbh = dbConect();
        //SQL文
        $sql = 'INSERT INTO users (name, user_id, user_pass) VALUES (:name, :user_id, :user_pass)';
        //プレースホルダーにセットする値
        $data = array(':name' => $name, ':user_id' => $id, ':user_pass' => password_hash($pass, PASSWORD_DEFAULT));
        //SQL実行
        $stmt = queryPost($dbh, $sql, $data);

        //実行成功の場合
        if($stmt){
          //ログイン有効期限
          $sesLimit = 60*60;
          //最終ログイン日時を現在日時にする
          $_SESSION['login_date'] = time();
          $_SESSION['login_limit'] = $sesLimit;
          //ユーザーIDを格納
          $_SESSION['user_id'] = $dbh->lastInsertId();

          debug('セッション変数の中身：'.print_r($_SESSION,true));

          header('Location:mypage.php');
        }else{
          error_log('クエリに失敗しました。');
          $err_msg['common'] = MSG05.'a';
        }
      }catch(Exception $e){
        error_log('エラー発生：'.$e->getMessage());
        $err_msg['common'] = MSG05.'b';
      }

    }

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
          <li><a href="index.php">TOP</a></li>
          <?php if(!empty($_SESSION['login'])) echo '<li><a href="typing.php">PLAYGAME</a></li>' ?>
          <li><a href="register.php">REGISTER</a></li>
          <?php if(empty($_SESSION['login'])) echo '<li><a href="login.php">LOGIN</a></li>' ?>
        </ul>
      </div>
    </header>

    <div class="container">
      <div class="register">
        <h2>ユーザー登録</h2>
        <div class="id-pass-error"><span class="help-block"><?php if(!empty($err_msg['common'])) echo $err_msg['common']; ?></span></div>
        <form method="post">
          <div class="form-group">
            <label>NAME　<span class="help-block"><?php if(!empty($err_msg['name'])) echo $err_msg['name']; ?></span>
              <input type="text" name="name" id="name" maxlength="20">
            </label>
          </div>
          <div class="form-group">
            <label>ID　<span class="help-block"><?php if(!empty($err_msg['id'])) echo $err_msg['id']; ?></span>
              <input type="text" name="id" id="id" maxlength="20">
            </label>
          </div>
          <div class="form-group">
            <label>PASSWORD　<span class="help-block"><?php if(!empty($err_msg['pass'])) echo $err_msg['pass']; ?></span>
              <input type="password" name="pass" id="pass" maxlength="20">
            </label>
          </div>
          <input type="submit" value="送信" class="register-submit">
        </form>
      </div>
    </div>

    <footer>

    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/register.js"></script>

  </body>
</html>
