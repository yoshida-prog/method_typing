//windowオブジェクトを取得
var window_obj = window;

//問題文と意味
const WORDS = [
  ['border-radius: 5px;', 'CSS: 要素の境界の外側の角を5px丸める'],
  ['color: #ffffff;', 'CSS: 文字の色を#ffffffに変える'],
  ['<input type="submit">', 'HTML: 送信ボタンを作成'],
  ['Math.floor(Math.random()*10)', 'js: 0から9までの数字をランダムで取得'],
  ['var i=0; i++;', 'js: 変数iに1足す'],
  ['<tr></tr>', 'HTML: 行'],
  ['margin: 0;', 'CSS: 要素のボーダーより外側の上下左右の余白を0にする'],
  ['padding: 10px;', 'CSS: 要素のボーダーより内側の上下左右の余白を10pxにする'],
  ['$().click()', 'jQuery: 対象をクリック時にイベント発火'],
  ['$(window).keydown()', 'jQuery: キーを押した時発火'],
  ['empty()', 'PHP: 引数が空か調べる'],
  ["define('NAME', VALUE)", "PHP: 定数定義('定数名', 値)"],
  ['preg_match()', 'PHP: 正規表現によるマッチング']
];

//押したキーの正誤をカウントする変数
var successCount = 0;
var missCount = 0;
//打ち込んでいる文字を格納する変数
var typingWord = '';
//問題数(0~)
var numOfQuestions = 1;
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
      randomNumber = Math.floor(Math.random()*8);
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
