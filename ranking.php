<?php

require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ランキング画面　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

$range = 5;
if(!empty($_GET['p'])){
  $page = (int)$_GET['p'];
  $dbh = dbConect();
  $sql = 'SELECT name,best,`rank` FROM users ORDER BY best DESC LIMIT 10 OFFSET '.($page-1)*10;
  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    debug(print_r($result, true));
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Method Typing</title>
    <link rel="stylesheet" type="text/css" href="css/ranking.css">
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

      <div class="top-ranking-container">
        <label>TOP RANKING</label>
        <div class="ranker-info">
          <table>
            <thead>
              <tr>
                <th></th>
                <th>NAME</th>
                <th>SPEED</th>
                <th>RANK</th>
              </tr>
            </thead>
            <tbody>
              <?php $count=($page-1)*10+1; foreach ($result as $e) {
                echo '<tr><th>'.$count.'</th><th>'.$e["name"].'</th><th>'.$e["best"].'type/sec</th><th>'.$e["rank"].'</th></tr>';
                $count++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="paging-container">
        <?php
          if($page===1){
            echo '<a class="now-page">'.$page.'</a>';
            for($page=2; $page<=$range; $page++){
              echo '<a class="other-page" href="ranking.php?p='.$page.'">'.$page.'</a>';
            }
          }elseif($page===2){
            echo '<a class="other-page" href="ranking.php?p=1">1</a>';
            echo '<a class="now-page">'.$page.'</a>';
            for($page=3; $page<=$range; $page++){
              echo '<a class="other-page" href="ranking.php?p='.$page.'">'.$page.'</a>';
            }
          }elseif($page===3){
            for($page=1; $page<=2; $page++){
              echo '<a class="other-page" href="ranking.php?p='.$page.'">'.$page.'</a>';
            }
            echo '<a class="now-page">'.$page.'</a>';
            for($page=4; $page<=$range; $page++){
              echo '<a class="other-page" href="ranking.php?p='.$page.'">'.$page.'</a>';
            }
          }elseif($page===4){
            for($page=1; $page<=3; $page++){
              echo '<a class="other-page" href="ranking.php?p='.$page.'">'.$page.'</a>';
            }
            echo '<a class="now-page">'.$page.'</a>';
            echo '<a class="other-page" href="ranking.php?p=5">5</a>';
          }elseif($page===5){
            for($page=1; $page<=4; $page++){
              echo '<a class="other-page" href="ranking.php?p='.$page.'">'.$page.'</a>';
            }
            echo '<a class="now-page">'.$page.'</a>';
          }
        ?>
      </div>

    </div>

    <footer>

    </footer>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/image.js"></script>

  </body>
</html>
