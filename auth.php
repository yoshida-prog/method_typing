<?php

//================================
// ログイン認証・自動ログアウト
//================================
// ログインしている場合
if(!empty($_SESSION['login_date'])){
  debug('ログイン済みのユーザーです。');

  //現在日時が最終ログイン日時＋有効期限を超えている場合
  if(($_SESSION['login_date'] + $_SESSION['login_limit']) < time()){
    debug('ログイン有効期限オーバーです。');
    //セッションを削除してログアウト
    session_destroy();
    //ログインページへ
    header("Location:login.php");
  }else{
    debug('ログイン有効期限内です。');
    //最終ログイン日時を現在日時に更新する
    $_SESSION['login_date'] = time();
    //下のelse文でログインページへ遷移したとき、このファイルによるループを防ぐ
    if(basename($_SERVER['PHP_SELF']) === 'login.php'){
      debug('マイページへ移動します。');
      header("Location:mypage.php");
    }
  }
}else{
  debug('未ログインユーザーです。');
  if(basename($_SERVER['PHP_SELF']) !== 'login.php'){
    header("Location:login.php");
  }
}

?>
