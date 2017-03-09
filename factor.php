<?php

require_once('master/prefix.php');
$sql='select * from response';
$rst=selectData(DB_NAME,$sql);

if($rst!=null){
$body.='<div style="float:left;">';
$body.='<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="margin:0 20px 0 20px;"></span>';
$body.='</div>';

$body.='<div style="float:left;background:silver;">';

$body.='<select multiple id="res" class="form-control form-inline" style="float:left;">';
for($i=0;$i<count($rst);$i++){
  $body.='<option>'.$rst[$i]['res_item'].'</option>';
}
  $body.='</select>';



$body.='</div>';

}
echo $body;
