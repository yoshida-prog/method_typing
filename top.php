<?php
//共通変数・関数の読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　トップページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

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
          <?php if(empty($_SESSION['login_date'])) echo '<li><a href="register.php">REGISTER</a></li>' ?>
          <?php if(!empty($_SESSION['login_date'])) echo '<li><a href="mypage.php">MYPAGE</a></li>' ?>
          <?php if(empty($_SESSION['login_date'])) echo '<li><a href="login.php">LOGIN</a></li>' ?>
          <?php if(!empty($_SESSION['login_date'])) echo '<li><a href="logout.php">LOGOUT</a></li>' ?>
        </ul>
      </div>
    </header>

    <div class="container">
      <div class="top-message">
        <p>Method Typingはプログラマー向けタイピングゲームです。</p>
      </div>
      <div class="points-container">
        <div class="points">
          <h2>Point 1</h2>
          <p>プログラミングに必要なタイピングスキルを身に付けます。</p>
          <p>プログラミング言語では普段扱う文章とは違い、' (シングルクォーテーション)や$(ダラー)など、shiftを多用する文字も扱います。</p>
          <p>本タイピングゲームでは、プログラミング言語で扱われる命令文を練習題材とすることで、プログラミングにおけるタイピング能力向上を期待しています。</p>
        </div>
        <div class="points">
          <h2>Point 2</h2>
          <p>全10問であなたのタイピングスピードを計測します。</p>
          <p>ゲーム終了時に１秒あたりのタイピングキー数を画面に表示します。ミスタッチしたものはカウントされません。</p>
          <p>まずは3.00~4.00type/secを目指してみましょう。あなたもプログラマーの仲間入りです。</p>
        </div>
        <div class="points">
          <h2>Point 3</h2>
          <p>アカウントを作成して全国ランキング挑戦や称号を獲得できます。</p>
          <p>あなたのタイピング力を全国のみんなと共有しよう！</p>
          <p>まずは上のメニュー欄のREGISTERか、下の「アカウントを作成する」ボタンからユーザー登録！必要なものは一切なし。ニックネーム・ID・パスワードのみでお手軽登録。</p>
        </div>
      </div>
      <div class="top-message">
        <?php if(empty($_SESSION['login_date'])) echo '<p><a href="register.php">アカウントを作成する</a></p>' ?>
      </div>
    </div>

    <footer>

    </footer>

  </body>
</html>
