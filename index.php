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


abstract class Creature{
    protected $name;
    protected $hp;
    protected $attackMin;
    protected $attackMax;
    abstract public function sayCry();
   
    public function setName(){
        $this->name = $str;
    }
    public function getName(){
        return $this->name;
    }
    public function setHp($num){
        $this->hp =$num;
    }

    public function getHp(){
        return $this->hp;
    }

    public function attack($targetObj){
        $attackPoint = mt_rand($this->attackMin,$this->attackMax);

        if(!mt_rand(0,9)){
            $attackPoint = $attackPoint * 1.5;
            $attackPoint = (int)$attackPoint;
            History::set($this->getName().'のクリティカルヒット！');
        }
        $targetObj->setHp($targetObj->getHp()-$attackPoint);
        History::set($attackPoint>'ポイントのダメージ');
    }

}
class Human extends Creature{
    public function __construct($name,$hp,$attackMin,$attackMax) {
        $this->name = $name;
        $this->hp = $hp;
        $this-> attackMin = $attackMin;
        $this->attackMax = $attackMax;
}
    public function sayCry(){
    
    }
}

class Enemy extends Creature{
    // プロパティ
    protected $img;
    // コンストラクタ
    public function __construct($name, $hp, $img, $attackMin, $attackMax) {
        $this->name = $name;
        $this->hp = $hp;
        $this->img = $img;
        $this->attackMin = $attackMin;
        $this->attackMax = $attackMax;
    }
    // ゲッター
    public function getImg(){
        return $this->img;
    }
    public function sayCry(){
        History:set($this->name.が叫ぶ);
    }
}

interface HistoryInterface{
    public static function set($str);
    public static function clear();
}

class History implements HistoryInterface{
    public static function set($str){
        // セッションhistoryが作られてなければ作る
        if(empty($_SESSION['history'])) $_SESSION['history'] = '';
        // 文字列をセッションhistoryへ格納
        $_SESSION['history'] .= $str.'<br>';
    }
    public static function clear(){
        unset($_SESSION['history']);
    }
}

$human = new Human('主人公',500,40,120);
$enemys[] = new Enemy( 'パワハラ上司',400,'img/pawahara1.pbg.jpg',40,80);

$enemys[] = new Enemy( 'セクハラ先輩',200,'img/sekuhara.jpeg',-40,10);
$enemys[] = new Enemy( 'モラハラ同期',300,'img/morahara.jpeg',30,60);

function createEnemy(){
    global $enemys;

    $enemy = $enemys[mt_rand(0,2)];
    History::set($enemy->getName().'が現れた！');
    $_SESSION['enemy'] = $enemy;

}

function createHuman(){
    global $human;
        $_SESSION['human']= $human;
}
function init(){
    History::clear();
    History::set('初期化します！');
    $_SESSION['knockDownCount']=0;
    createHuman();
    createEnemy();
}
function gameOver(){
    $_SESSION = array();
}

$_SESSION = array();

if(!empty($_POST)){
$attackFlg = (!empty($_POST['attack'])) ? true :false;
$nextFlg = (!empty($_POST['next'])) ? true : false;
$escapeFlg = (!empty($_POST['escape']))?true:false;
error_log('POSTされた！');
    
if($escapeFlg){
init();
    
}else{
    if($attackFlg){
        debug('$attackFlgある？：'.print_r($attackFlg,true));
        History::set($_SESSION['human']->getName().'の攻撃！');
        $_SESSION['human']->attack($_SESSION['enemy']);
        $_SESSION['enemy']->sayCry();
        if($_SESSION['human']->getHp() <= 0){
            gameOver();  }
        else{
            if($_SESSION['enemy']->getHp() <= 0){

                History::set($_SESSION['human']->getName().'の攻撃！');
                $_SESSION['human']->attack($_SESSION['enemy']);
                $_SESSION['enemy']->sayCry();
                $_SESSION['knockDownCount'] = $_SESSION['knockDownCount']+1;
            }}}
    else{ 
        //逃げるを押した場合
        History::set('逃げた！');
        condition::set('逃げた！');
        createMonster();
    }}
$_POST = array();
}
$test=0;
debug('$_SESSION：'.print_r($_SESSION,true));

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
         
         
          <?php if(empty($_SESSION)){ ?>
          <div class="opening"   style="height:500px;"></div>
          <form method="post">
              <input type="submit" name='escape' value='▶︎脱出する'>
          </form>
          <?php }else{ ?>
          <h1><?php echo $_SESSION['enemy']->getName().'が現れた!!'; ?></h1>
          <img src="<?php echo $_SESSION['enemy']->getImg();?>" style="padding-left:163px;">
          <p style="font-size:14px; text-align:center;">モンスターのHP：<?php echo $_SESSION['human']->getHp(); ?></p>
          <p>脱出まであと：<?php echo $_SESSION['knockDownCount'];  ?>/5人</p>
   <p>HP：<?php ?>/500</p>
   <div class="main_command">
       <p>  <?php echo (!empty($_SESSION['history'])) ? $_SESSION['history'] : ''; ?></p>
   <form action="post">
    
     
       <input type="submit" name='attack' value='▶︎攻撃する'>
      
       <input type="submit" name='escape' value='▶︎逃げる'>
       <?php if( ( $test==5)){ ?>
       <input type="submit" name='next' value='▶︎次へ'> <?php }  ?>
   </form>
       <?php }  ?>
       <div style="position:absolute; right:-350px; top:0; color:black; width: 300px;">
           <p><?php echo (!empty($_SESSION['history'])) ? $_SESSION['history'] : ''; ?></p>
       </div>
          </div>
      </div>
  </body>
</html>