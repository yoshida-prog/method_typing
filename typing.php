<?php
//共通変数・関数の読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ゲームページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

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
          <?php if(!empty($_SESSION['login_date'])) echo '<li><a href="typing.php">PLAYGAME</a></li>' ?>
          <?php if(empty($_SESSION['login_date'])) echo '<li><a href="register.php">REGISTER</a></li>' ?>
          <?php if(!empty($_SESSION['login_date'])) echo '<li><a href="mypage.php">MYPAGE</a></li>' ?>
          <?php if(!empty($_SESSION['login_date'])) echo '<li><a href="logout.php">LOGOUT</a></li>' ?>
        </ul>
      </div>
    </header>

    <div class="container">

      <div class="typing-word-box">
        <div class="word-container">
          <div class="contents-box">
            <div class="word">
              Appears words
            </div>
            <div class="your-typing-word-container">
              <div class="your-typing-word">
                The typing word displays
              </div>
            </div>
            <div class="mean">
              Meaning of the word<br />
              <span class="press-enter">Press Enter Key</span>
            </div>
          </div>
        </div>
      </div>

      <div class="keyboard">
        <div class="table-container">
          <table class="number-line">
            <tr>
              <td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>0</td><td>-</td><td>^</td><td>¥</td>
            </tr>
          </table>
          <table class="q-line">
            <tr>
              <td>q</td><td>w</td><td>e</td><td>r</td><td>t</td><td>y</td><td>u</td><td>i</td><td>o</td><td>p</td><td>@</td><td>[</td>
            </tr>
          </table>
          <table class="a-line">
            <tr>
              <td>a</td><td>s</td><td>d</td><td>f</td><td>g</td><td>h</td><td>j</td><td>k</td><td>l</td><td>;</td><td>:</td><td>]</td>
            </tr>
          </table>
          <table class="z-line">
            <tr>
              <td colspan="2">shift</td><td>z</td><td>x</td><td>c</td><td>v</td><td>b</td><td>n</td><td>m</td><td>,</td><td>.</td><td>/</td><td>_</td><td colspan="2">shift</td>
            </tr>
          </table>
          <table class="space">
            <tr>
              <td colspan="6"></td>
            </tr>
          </table>
        </div>

      </div>

    </div>

    <footer>

    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/typing_main.js"></script>

  </body>
</html>
