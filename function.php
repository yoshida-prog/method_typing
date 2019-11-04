<?php

//=============================
// ログ
//=============================
//ログを取るか
ini_set('log_errors','on');
//ログの出力ファイルを指定
ini_set('error_log','php.log');

//=============================
// デバッグ
//=============================
//デバッグフラグ
$debug_flg = true;
//デバッグログ関数
function debug($str){
  global $debug_flg;
  if(!empty($debug_flg)){
    error_log('デバッグ：'.$str);
  }
}

//=============================
// セッション準備
// セッション有効期限を延長
//=============================
//セッションファイルの置き場を変更する(/var/tmp/以下に置くと30日は削除されない)
session_save_path("/var/tmp/");
//ガーベージコレクションが削除するセッションの有効期限を設定(30日以上経過しているものに対してだけ100分の1の確率で削除)
ini_set('session.gc_maxlifetime', 60*60*24*30);
//ブラウザを閉じても削除されないようにクッキー自体の有効期限を延ばす
ini_set('session.cookie_lifetime', 60*60*24*30);
//セッションスタート
session_start();
//現在のセッションIDを新しく生成したものと置き換える(なりすましのセキュリティ対策)
session_regenerate_id();

//=============================
// 画面表示処理開始ログ吐き出し関数
//=============================
function debugLogStart(){
  debug('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 画面表示処理開始');
  debug('セッションID：'.session_id());
  debug('セッション変数の中身：'.print_r($_SESSION, true));
  debug('現在日時のタイムスタンプ：'.time());
  if(!empty($_SESSION['login_date']) && !empty($_SESSION['login_limit'])){
    debug('ログイン期限日時タイムスタンプ：'.($_SESSION['login_date'] + $_SESSION['login_limit']));
  }
}

//=============================
// 定数
//=============================
//メッセージを定数に設定
define('MSG01', '入力必須です');
define('MSG02', '半角英数字で入力してください');
define('MSG03', '8文字以上で入力してください');
define('MSG04', '登録済みのIDまたはPASSWORDです');
define('MSG05', 'エラーが発生しました。しばらく経ってからもう一度お試しください。');
define('MSG06', 'IDまたはパスワードが違います。');

//=============================
// グローバル変数
//=============================
//エラーメッセージ格納用の配列
$err_msg = array();

//=============================
// バリデーション関数
//=============================
//バリデーション関数(未入力チェック)
function validRequired($str, $key){
  if(empty($str)){
    global $err_msg;
    $err_msg[$key] = MSG01;
  }
}
//バリデーション関数(ID形式チェック)
function validId($str, $key){
  if(!preg_match("/^[A-Za-z0-9]*$/", $str)){
    global $err_msg;
    $err_msg[$key] = MSG02;
  }
}
//バリデーション関数(PASSWORD形式チェック)
function validPassword($str, $key){
  if(!preg_match("/^[a-zA-Z0-9!#$%&()*+,.:;=?@\[\]^_{}-]+$/", $str)){
    global $err_msg;
    $err_msg[$key] = MSG02;
  }
}
//バリデーション関数(ID・PASSWORD入力文字数チェック)
function validStrLength($str, $key){
  if(strlen($str) < 8){
    global $err_msg;
    $err_msg[$key] = MSG03;
  }
}

//=============================
// データバース
//=============================
//DB接続関数
function dbConect(){
  //DB接続準備
  $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
  $db['dbname'] = ltrim($db['path'], '/');
  $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
  $user = $db['user'];
  $password = $db['pass'];
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
  );
  //PDOオブジェクト生成をしてDBへ接続する
  $dbh = new PDO($dsn, $user, $password, $options);
  return $dbh;
}
//SQL実行関数
function queryPost($dbh, $sql, $data){
  //クエリー作成
  $stmt = $dbh->prepare($sql);
  //$sql内のプレースホルダに値をセットしてSQL文を実行
  $stmt->execute($data);
  return $stmt;
}
//ユーザー情報の取得
function getUser($u_id){
  debug('ユーザー情報を取得します。');
  //例外処理
  try{
    //DB接続
    $dbh = dbConect();
    //SQL文
    $sql = 'SELECT * FROM users WHERE id = :u_id';
    $data = array(':u_id' => $u_id);
    //SQL実行
    $stmt = queryPost($dbh, $sql, $data);

    //クエリ成功したかをデバッグで吐き出す
    if($stmt){
      debug('クエリ成功。');
    }else{
      debug('クエリ失敗。');
    }
  }catch(Exception $e){
    error_log('エラー発生：'.$e->getMessage());
  }
  //クエリ結果を戻す
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
