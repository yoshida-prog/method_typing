//windowオブジェクトを取得
var window_obj = window;

//問題文と意味
const WORDS = [
  //HTML
  ['<input type="submit">', 'HTML: 送信ボタンを作成'],
  ['<tr></tr>', 'HTML: 行'],
  ['<table></table>', 'HTML: 表'],
  ['<select></select>', 'HTML: セレクトボックス'],
  ['<input type="radio">', 'HTML: ラジオボックス'],
  //CSS
  ['margin: 0;', 'CSS: 要素のボーダーより外側の上下左右の余白を0にする'],
  ['padding: 10px;', 'CSS: 要素のボーダーより内側の上下左右の余白を10pxにする'],
  ['border-radius: 5px;', 'CSS: 要素の境界の外側の角を5px丸める'],
  ['color: #ffffff;', 'CSS: 文字の色を#ffffffに変える'],
  ['font-weight: bold;', 'CSS: 文字を太文字にする'],
  ['line-height: 150%;', 'CSS: 行の高さを150%に指定する'],
  ['text-align: center;', 'CSS: ブロックコンテナ内の行の揃え位置・均等割付を中央に指定する'],
  ['word-spacing: 2px;', 'CSS: 文字の間隔を2pxに指定する'],
  ['min-height: 1080px;', 'CSS: 高さの最小値を1080pxに指定する'],
  ['display: none;', 'CSS: 要素の表示形式をnoneにする'],
  ['z-index: 0;', 'CSS: 重なりの順序を指定する'],
  ['cursor: pointer;', 'CSS: リンクカーソルを指定'],
  ['a:hover{background-color: #333;}', 'CSS: aタグにカーソルが乗った時、背景色を#333にする'],
  //js
  ['Math.floor(Math.random()*10)', 'js: 0から9までの数字をランダムで取得'],
  ['var i=0; i++;', 'js: 変数iに1足す'],
  ['var window_obj = window;', 'js: 変数window_objにwindowオブジェクトを格納'],
  ['console.log();', 'js: 引数の値を出力テストする'],
  //jQuery
  ['$().click()', 'jQuery: 対象をクリック時にイベント発火'],
  ['$(window).keydown()', 'jQuery: キーを押した時発火'],
  ['$("p").show("slow");', 'jQuery: pタグを緩やかに表示状態にする'],
  ['$(document).ready(function(){}', 'jQuery: DOMがロードされたタイミングで関数を実行'],
  ['$(window).keydown(function(){}', 'jQuery: キーボードの何かのキーが押し込まれた際に関数を実行'],
  ['$(window).keyup(function(){}', 'jQuery: キーボードのキーが押され、上がった際に関数を実行'],
  ['$(p).text()', 'jQuery: 指定した要素が持つテキストノードを結合したものを返す'],
  ['$(option).val()', 'jQuery: 指定した要素が持つvalue属性を返す'],
  ['$("p").append("hello")', 'jQuery: 指定した要素の末尾に文字列のhelloを追加する'],
  //PHP
  ['empty();', 'PHP: 引数が空か調べる'],
  ["define('NAME', VALUE);", "PHP: 定数定義('定数名', 値)"],
  ['preg_match();', 'PHP: 正規表現によるマッチング'],
  ['session_start();', 'PHP: セッションスタート'],
  ['$box = array();', 'PHP: 配列定義'],
  ['strlen($str)', 'PHP: 引数$strの長さを返す'],
  ['$_POST[]', 'PHP: POST送信で来た値を取得'],
  ['echo "str";', 'PHP: １つ以上の文字列を出力する'],
  ['var_dump($str);', 'PHP: 構造化された引数の情報を返す'],
  ['<?php ?>', 'PHP: HTML内でPHPを実行'],
  ['require("test.php");', 'PHP: test.phpファイルを読み込む'],
  ["unset($_SESSION['err_msg']);", 'PHP: 引数の値を破棄する']
];

//押したキーの正誤をカウントする変数
var successCount = 0;
var missCount = 0;
//打ち込んでいる文字を格納する変数
var typingWord = '';
//問題数(0~)
var numOfQuestions = 10;
//何問目かカウントする変数
var count = 0;
//ゲーム開始時間を取得するための変数
var startTime;
//ランダムで問題を選んで問題欄と意味欄を書き換えるための変数
var randomNumber;
var nowWord;
var nowWordMean;
var enter_flg = true;
var num = 0;

console.log('エンターキーでスタート！！');

function type(e){
  //ゲーム中キーを押す度に実行
  $(window_obj).on('keydown', function(e){

    //押したキーがShiftやコントロールキーなどであればkeydownイベントをスキップ
    if(e.key === 'Shift' || e.key.length > 1){
      return false;
    }else{
      //押したキーを最後尾に追加
      typingWord += e.key;
    }

    //押したキーがお題の文字と合っていれば入力欄に押したキーを追加
    if(typingWord === nowWord.text().slice(0,typingWord.length)){
      $('.your-typing-word').text(typingWord);
      successCount++;
    }else if(typingWord !== nowWord.text().slice(0,typingWord.length) && count !== numOfQuestions){
      //間違っていれば直前に押したキー情報を削除して入力欄を点滅させる
      typingWord = typingWord.slice(0,-1);
      $('.your-typing-word').hide().fadeIn(50);
      missCount++;
    }

    //最後のお題を消化したら処理
    if(typingWord === nowWord.text() && count === numOfQuestions - 1){
      count++;
      //ゲーム終了後からエンターを押して再開できるようにする
      enter_flg = true;
      //終了時刻を取得してゲーム開始から終了までの時間を算出
      var endTime = new Date;
      var totalTime = endTime - startTime;
      //小数点第二位までのかかった時間(秒)と1秒あたりのタイプ数を取得
      var sec = Math.floor(((totalTime)/1000)*Math.pow(10,2))/Math.pow(10,2);
      var typingSpeed = Math.floor((successCount/sec)*Math.pow(10,2))/Math.pow(10,2);
      //画面にリザルトを表示
      $('.word').text('Result');
      $('.your-typing-word').text('Miss typing: ' + missCount);
      $('.mean').text('Your typing speed: ' + typingSpeed + 'type/sec');

      //Ajax通信を開始
      $.ajax({
        url: "data.php",
        type:'POST',
        data:{
          'speed': typingSpeed,
          'miss': missCount
        }
      });


    }else if(typingWord === nowWord.text()){
      //最後のお題以外を消化したときはこちらで問題を再取得
      count++;
      randomNumber = Math.floor(Math.random()*WORDS.length);
      nowWord = $('.word').text(WORDS[randomNumber][0]);
      nowMean = $('.mean').text(WORDS[randomNumber][1]);
      typingWord = '';
      $('.your-typing-word').text(typingWord);
    }
  });
}

$(window_obj).on('keydown', function(e){
  //押したキーのコードがEnterならゲームスタート
  var startCheck = e.keyCode;
  $(this).data('keydown', ++num);
  var click = $(this).data('keydown');
  if(startCheck === 13 && enter_flg === true){
    //ゲーム終了後にエンターを押したら画面が更新される
    //jqueryイベントカウント数の関係でバグがあるためこのような処置を取る
    if(click > 1){
      window.location.reload();
      return false;
    }
    //ゲーム中エンターを押してもゲームが再開しないようにする
    enter_flg = false;
    //入力欄を空にする
    typingWord = '';
    $('.your-typing-word').text('');
    //開始時間を記憶
    startTime = new Date();
    //ランダムで問題を選ぶ
    randomNumber = Math.floor(Math.random()*WORDS.length);
    nowWord = $('.word').text(WORDS[randomNumber][0]);
    nowWordMean = $('.mean').text(WORDS[randomNumber][1]);
    type(e);
  }
});
