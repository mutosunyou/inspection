<?php
//初期==============================================
session_start();
require_once('master/prefix.php');

$_SESSION['loginid']=10042;
$_SESSION['login_name']="武藤　一徳";

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
$body.='点検結果';
$body.='</h2><hr />';
/*
////////////////////////////////////////////////////////////
$body.='<div style="float:left;background:silver;">';
$rst_category=selectData(DB_NAME,'select * from element');
//$body.='<h5>カテゴリー</h5>';
$body.='<select id="categ" multiple class="form-control form-inline">';
for($i=0;$i<count($rst_category);$i++){
  $body.='<option value="'.$rst_category[$i]['id'].'">'.$rst_category[$i]['content'].'</option>';
}
$body.='</select>';
$body.='</div>';

////////////////////////////////////////////////////////////
$body.='<div id="check"></div>';
////////////////////////////////////////////////////////////
$body.='<div id="pon"></div>';
////////////////////////////////////////////////////////////
$body.='<div id="condition"></div>';
////////////////////////////////////////////////////////////
$body.='<div id="response"></div>';
////////////////////////////////////////////////////////////
$body.='<div id="emerge"></div>';
////////////////////////////////////////////////////////////

$body.='<div class="clearfix"></div>';
$body.='<hr>';
//送信ボタン=========================================
$body.='<button id="sendbtn" class="btn btn-sm btn-success pull-right">追加</button>';
////////////////////////////////////////////////////////////
$body.='<div id="message"></div>';
////////////////////////////////////////////////////////////
*/

//ここからまた違う手法===================================================================
$body.='<table class="table table-bordered">';
$body.='<tr>';
$body.='<th>点検部</th>';
$body.='<th>点検項目</th>';
$body.='<th>作業項目</th>';
$body.='<th>c点検</th>';
$body.='</tr>';
$body.='<tr>';
$body.='<th rowspan="5">ラジエーター関係</th>';
$body.='<td>151</td>';
$body.='<td>冷却水入替及び清掃</td>';
$body.='<td>';
$body.='<select id="151" class="form-control form-inline" style="width:50px;"><option value="0">○</option><option value="1">×</option></select>';
$body.='</td>';
$body.='</tr>';
$body.='<tr>';
$body.='<td>152</td>';
$body.='<td>コアーの掃除、ゴムホース交換</td>';
$body.='<td>';
$body.='<select id="152" class="form-control form-inline" style="width:50px;"><option value="0">○</option><option value="1">×</option></select>';
$body.='</td>';
$body.='</tr>';
$body.='<tr>';
$body.='<td>153</td>';
$body.='<td>ファンの羽根取付鋲の緩み点検</td>';
$body.='<td>';
$body.='<select id="153" class="form-control form-inline" style="width:50px;"><option value="0">○</option><option value="1">×</option></select>';
$body.='</td>';
$body.='</tr>';
$body.='<tr>';
$body.='<td>154</td>';
$body.='<td>ファンベルト緩み点検</td>';
$body.='<td>';
$body.='<select id="154" class="form-control form-inline" style="width:50px;"><option value="0">○</option><option value="1">×</option></select>';
$body.='</td>';
$body.='</tr>';
$body.='<tr>';
$body.='<td>155</td>';
$body.='<td>スパイダー谷底部点検</td>';
$body.='<td>';
$body.='<select id="155" class="form-control form-inline" style="width:50px;"><option value="0">○</option><option value="1">×</option></select>';
$body.='</td>';
$body.='</tr>';
$body.='</table>';
//$body.='<button id="sendbtn2" class="btn btn-sm btn-success pull-right">出力</button>';
$body.='<h4>報告内容</h4>';
$body.='<div class="well" id="message2"></div>';

$body.='</div>';//container
$body.='</div>';//

//ヘッダー===========================================
$header ='<script type="text/javascript" src="index2.js"></script>';
$header.='<style type="text/css">';
$header.='<!--
  .input-group{
  margin:5px 10px 5px 0;
  }
  -->';
$header.='</style>';

//HTML作成===========================================
echo html('点検',$header, $body);
