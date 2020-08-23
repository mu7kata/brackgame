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
  <body>
   <h1></h1>
   <div>
   <img src="" alt="">
   </div>
   <p></p>
   <p></p>
   <form action="post">
      
   </form>
  
  </body>
</html>