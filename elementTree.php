<?php

require_once('master/prefix.php');

class ElementTree(){
  public $id;
  public $companyID;
  public $name;
  
  function initWithID($id)//8桁(期+6桁)の伝票番号で初期化
  {
    $this->id= $id;
    //伝票番号の中で最新の枝番のデータ
    $sql = 'select * from elementTree where id = '.$this->id;
    $rst = selectData(DB_NAME, $sql);
    
    if($rst!=null){

