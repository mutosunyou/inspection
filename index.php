<?php
//初期==============================================
session_start();
require_once('master/prefix.php');

//ログイン処理======================================
$sql = "SELECT * FROM employee";
$rst = selectData('master',$sql);
if (isset($_SESSION["login_name"])){
  $sessionCounter = 0;
  for($i = 0; $i < count($rst); $i++) {
    if ($_SESSION["login_name"] == $rst[$i]["person_name"]){
      $sessionCounter = $sessionCounter + 1;
    }
  }
  if ($sessionCounter == 0){
    header("Location: index.php");
    exit;
  }
  $_SESSION['loginid']=userIDFromName($_SESSION["login_name"]);
}else{
  header("Location: ../portal/index.php");
  exit;
}
$_SESSION['expires'] = time();
if ($_SESSION['expires'] < time() - 7) {
  session_regenerate_id(true);//sessionIDを生成しなおす
  $_SESSION['expires'] = time();
}

//ナビバー=========================================
$body='<nav class="navbar navbar-default navbar-fixed-top" role="navigation">';
$body.='<div class="container-fluid">';
$body.='<div class="navbar-header">';
$body.='<!-- 
  メニューボタン 
  data-toggle : ボタンを押したときにNavbarを開かせるために必要
  data-target : 複数navbarを作成する場合、ボタンとナビを紐づけるために必要
  -->
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-menu-1">
  <span class="sr-only">Toggle navigation</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  </button>';
$body.='<a class="navbar-brand" href="/php/menu" tabindex="-1"><img alt="Brand" src="./master/favicon.ico"></a>'; 
$body.='</div>';
$body.='<div class="collapse navbar-collapse" id="nav-menu-1">';

//左側
$body.='<ul class="nav navbar-nav">';
$body.='<li id="listrun" class="bankmenu"><a tabindex="-1">点検報告書作成システム</a></li>';
$body.='<li id="list" class="active applymenu"><a href="#" tabindex="-1">新規作成</a></li>';


$body.='</ul>';

//右側
$body.='<ul class="nav navbar-nav pull-right">';
$body.='<li><a href="./master/logout.php">ログアウト</a></li>';
$body.='<li><a tabindex="-1">'.$_SESSION['login_name'].'</a></li>';
$body.='</ul>';

$body.='</div>';
$body.='</div>';
$body.='</nav>';

//隙間調整=========================================
$body.='<div id="topspace" style="height:70px;"></div>';

//クラスと変数=====================================
$body.='<input id="userID" class="hidden" value="'.$_SESSION['loginid'].'">';

//本文/////////////////////////////////////////////
//タイトル=========================================
$body.='<div class="container-fluid">';
$body.='<div class="container">';
$body.='<h2 class="toptitle">';
$body.='回覧 新規作成';
$body.='</h2><hr />';

//一番上のエリア
$body.='<div style="width:900px;">';

//フォーム=========================================
$body.='<h3>伝達事項<small>　伝達内容を記入してください</small></h3>';

$body.='<div class="input-group input-group-sm">';
$body.='<span class="input-group-addon">タイトル</span>';
$body.='<input type="text" id="title" style="font-size:13px;" class="form-control">';
$body.='</div>';

$body.='<div class="input-group input-group-sm">';
$body.='<span class="input-group-addon">内　　容</span>';
$body.='<textarea class="form-control" id="cont" rows="5" cols="90" style="height:150px;"></textarea>';
$body.='</div>';

$body.='</div>';//一番上のエリア終わり







//送信ボタン=========================================
$body.='<button id="sendbtn" class="btn btn-sm btn-success pull-right" disabled="disabled">送信内容確認</button>';

$body.='<div id="ppp"></div>';//デバッグ用

$body.='</div>';//container


//ヘッダー===========================================
$header ='<script type="text/javascript" src="index.js"></script>';
$header.='<style type="text/css">';
$header.='<!--
  .input-group{
  margin:5px 10px 5px 0;
  }
  -->';
$header.='</style>';

//HTML作成===========================================
echo html('回覧板',$header, $body);
