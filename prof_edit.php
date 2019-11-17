<?php

require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　エディット画面　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

if(!empty($_FILES)){
  $img = (!empty($_FILES['img']['name'])) ? upLoadImg($_FILES['img']) : '';
  $dbh = dbConect();
  $delete = 'DELETE FROM img WHERE user_id = :user_id';
  $delete_data = array(':user_id' => $_SESSION['user_id']);
  $delete_stmt = queryPost($dbh, $delete, $delete_data);
  $sql = 'INSERT INTO img (user_id, user_img) VALUES (:user_id, :user_img)';
  $data = array(':user_id' => $_SESSION['user_id'], ':user_img' => $img);
  $stmt = queryPost($dbh, $sql, $data);
}
$img_id = (!empty($_GET['id'])) ? $_GET['id'] : '';
$dbFormData = (!empty($img_id)) ? getImg($_SESSION['user_id']) : '';
if(!empty($img_id) && empty($dbFormData)){
  debug('ダメです');
  header('Location:prof_edit.php');
}

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
      <form class="icon-change-form" action="prof_edit.php<?php if(!empty($dbFormData['user_img'])) echo '?id='.$_SESSION['user_id']; ?>" method="post" enctype="multipart/form-data">
        <div class="img-box">
          <input type="file" name="img" class="input-img">
          <img src="<?php if(!empty($dbFormData)) echo $dbFormData['user_img']; ?>" class="icon" style="<?php if(empty($dbFormData['user_img'])) 'display:none;' ?>">
          画像をドロップ
        </div>
        <input type="submit" class="icon-change-submit" value="画像を変更">
      </form>
    </div>

    <footer>

    </footer>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/image.js"></script>

  </body>
</html>
