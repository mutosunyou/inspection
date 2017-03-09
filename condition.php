<?php

require_once('master/prefix.php');
$sql='select * from cond where itemID='.$_POST['item'];
$rst=selectData(DB_NAME,$sql);

if($rst!=null){
  $body.='<div style="float:left;">';
  $body.='<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="margin:0 20px 0 20px;"></span>';
  $body.='</div>';

  $body.='<div style="float:left;background:silver;">';
  if($_POST['item']==4){
    $body.='<input id="inbody" class="form-control form-inline" value="自由記載">';
  }else{


    $body.='<select multiple id="cond" class="form-control form-inline">';
    for($i=0;$i<count($rst);$i++){
      $body.='<option>'.$rst[$i]['cond'].'</option>';
    }
    $body.='</select>';
}
$body.='</div>';
  }

echo $body;
