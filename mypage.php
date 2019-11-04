<?php
//共通変数・関数の読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　マイページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

//DB接続開始
$dbh = dbConect();
//SQL文
$sql = 'SELECT * FROM users WHERE id = :user_id';
$data = array(':user_id' => $_SESSION['user_id']);
//SQL実行
$stmt = queryPost($dbh, $sql, $data);
//結果を取得
$result = $stmt->fetch(PDO::FETCH_ASSOC);

debug('クエリ結果の中身：'.print_r($result, true));

$count = $dbh->query('SELECT count(id) AS id FROM users');
$rows = "";
while($res = $count->fetch(PDO::FETCH_ASSOC)){
  $rows .= $res['id'];
}

$ranking = $dbh->prepare('SELECT *, (SELECT COUNT(*) + 1 FROM users b WHERE b.best > a.best) AS ranking FROM users a WHERE id = :id');
$ranking->execute(array(':id' => $_SESSION['user_id']));
$yourRanking = $ranking->fetch(PDO::FETCH_ASSOC);
debug('あなたのランキング：'.print_r($yourRanking['ranking'], true));

?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Method Typing</title>
    <link rel="stylesheet" type="text/css" href="css/mypage.css">
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
          <li><a href="typing.php">PLAYGAME</a></li>
          <li><a href="mypage.php">MYPAGE</a></li>
          <li><a href="logout.php">LOGOUT</a></li>
        </ul>
      </div>
    </header>

    <div class="container">

      <div class="user-info">
        <div class="info-box">
          <label>NAME</label><span class="user-name"><?php echo $result['name']; ?></span>
        </div>
        <div class="info-box">
          <label>RANK</label><span class="rank"><?php echo $result['rank']; ?></span>
        </div>
        <div class="info-box">
          <label>BEST</label><span class="best"><?php echo $result['best']; ?> type/sec</span>
        </div>
      </div>

      <div class="achievement">
        <div class="achievement-title">
          <h2>YOUR RANKING</h2>
        </div>
        <div class="achievement-content">
          <div class="ranking-box">
            <span class="your-ranking"><?php echo $yourRanking['ranking'] ?></span> / <span class="all-users"><?php echo $rows ?></span>
          </div>
        </div>
      </div>

      <!-- <div class="achievement">
        <div class="achievement-title">
          <h2>ACHIEVEMENT</h2>
        </div>
        <div class="achievement-content">
          <table>
            <tr>
              <td><span class="a1"><i class="fas fa-hammer fa-2x"></i></span></td>
              <td><span class="a2"></span></td>
              <td><span class="a3"></span></td>
              <td><span class="a4"></span></td>
              <td><span class="a5"></span></td>
            </tr>
            <tr>
              <td><span class="a6"></span></td>
              <td><span class="a7"></span></td>
              <td><span class="a8"></span></td>
              <td><span class="a9"></span></td>
              <td><span class="a10"><i class="far fa-keyboard fa-2x"></i></span></td>
            </tr>
          </table>
        </div>
      </div> -->

    </div>

    <footer>

    </footer>

  </body>
</html>
