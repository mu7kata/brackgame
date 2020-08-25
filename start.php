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

$_SESSION= array();

?>


<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>ブラック企業からの脱出</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            h3{
          color: aliceblue;
                font-size: 40px;
                text-align: center;
                position: absolute;
                left: 79px;
                top: -84px;
                
            }
            h1{
               font-size: 56px;
            
            }
            .title{
              margin-top: 260px;
                position:relative;
            }
            a{
             color: aliceblue;
                font-size: 24px;
                text-align: center;
                display: block;
            }
        </style>
    </head>
   
    <h2>ゲーム：ブラック企業からの脱出</h2>
    <body>

        <div class="main">
           <div class='title'>
            <h3>メンタル弱々くんの</h3>
            <h1>ブラック企業からの脱出</h1>
            </div>
            <div class="btn">
                <a href="index.php">▶︎スタート</a>
            </div>
        </div>
    </body>
</html>