<?php

$debug_flg = true;
//デバッグログ関数
function debug($str){
    global $debug_flg;
    if(!empty($debug_flg)){
        error_log('デバッグ：'.$str);
    }
}


ini_set('log_errors','on');  //ログを取るか
ini_set('error_log','php.log');  //ログの出力ファイルを指定
session_start(); //セッション使う
ini_set("display_errors", "On");
?>


<!DOCTYPE html>
<html>
    
 <head>
        <meta charset="utf-8">
        <title>ブラック企業からの脱出</title>
        <link rel="stylesheet" type="text/css" href="style.css">
 </head>
    <h2>ゲーム：ブラック企業からの脱出</h2>
  <body>
   
      <div class="main">
          <h1>テスト</h1>
          <img src="img/sekuhara.jpeg" style="padding-left:163px;">
 
      <p>脱出まであと：<?php ?>/5人</p>
   <p>HP：<?php ?>/500</p>
   <div class="main_command">
   <p></p>
   <form action="post">
      <input type="submit" name='attack' value='▶︎攻撃する'>
      <input type="submit" name='escape' value='▶︎逃げる'>
       <input type="submit" name='next' value='▶︎次へ'>
   </form>
          </div>
      </div>
  </body>
</html>