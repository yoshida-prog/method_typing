<?php
//共通変数・関数の読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　結果反映　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

if(isset($_POST['speed']) && isset($_POST['miss'])){

  $speed = $_POST['speed'];
  $miss = $_POST['miss'];

  //DB接続
  $dbh = dbConect();
  //SQL文
  $sql = 'SELECT best FROM users WHERE id = :id';
  $data = array(':id' => $_SESSION['user_id']);
  //SQL実行
  $stmt = queryPost($dbh, $sql, $data);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if(!empty($result)){
    if($result['best'] < $speed){
      //SQL文
      $sqlUpdate = 'UPDATE users SET best = :best, rank = :rank WHERE id = :id';
      switch($speed){
        case $speed > 11.00:
          $updateData = array(':best' => $speed, ':rank' => 'UNKNOWN', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 11.50:
          $updateData = array(':best' => $speed, ':rank' => 'INVINCIBLE', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 11.00:
          $updateData = array(':best' => $speed, ':rank' => 'ZEUS', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 10.50:
          $updateData = array(':best' => $speed, ':rank' => 'ADAM', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 10.00:
          $updateData = array(':best' => $speed, ':rank' => 'BUDDHA', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 9.50:
          $updateData = array(':best' => $speed, ':rank' => 'SATAN', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 9.00:
          $updateData = array(':best' => $speed, ':rank' => 'DEMON', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 8.50:
          $updateData = array(':best' => $speed, ':rank' => 'EMPEROR', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 8.00:
          $updateData = array(':best' => $speed, ':rank' => 'ALMIGHTY', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 7.50:
          $updateData = array(':best' => $speed, ':rank' => 'MONSTER', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 7.00:
          $updateData = array(':best' => $speed, ':rank' => 'KING', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 6.50:
          $updateData = array(':best' => $speed, ':rank' => 'MASTER', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 6.00:
          $updateData = array(':best' => $speed, ':rank' => 'PROFESSIONAL', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 5.50:
          $updateData = array(':best' => $speed, ':rank' => 'TECHNICIAN', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 5.00:
          $updateData = array(':best' => $speed, ':rank' => 'SENIOR', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 4.50:
          $updateData = array(':best' => $speed, ':rank' => 'VETERAN', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 4.00:
          $updateData = array(':best' => $speed, ':rank' => 'ENGINEER', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 3.50:
          $updateData = array(':best' => $speed, ':rank' => 'ACE', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 3.00:
          $updateData = array(':best' => $speed, ':rank' => 'INTERMEDISTE', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 2.50:
          $updateData = array(':best' => $speed, ':rank' => 'ROOKIE', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        case $speed > 2.00:
          $updateData = array(':best' => $speed, ':rank' => 'COMMON', ':id' => $_SESSION['user_id']);
          queryPost($dbh, $sqlUpdate, $updateData);
          break;
        default:
          break;
      }
    }
  }

}

?>
