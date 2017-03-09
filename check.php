<?php

require_once('master/prefix.php');

$body.='<div style="float:left;">';
$body.='<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="margin:0 20px 0 20px;"></span>';
$body.='</div>';
////////////////////////////////////////////////////////////

$body.='<div style="float:left;background:silver;">';

$sql='select * from parts where elementID='.$_POST['item'];
$rst=selectData(DB_NAME,$sql);

$body.='<select id="checker" multiple class="form-control form-inline">';
for($i=0;$i<count($rst);$i++){
  $body.='<option value="'.$rst[$i]['id'].'">'.$rst[$i]['partsname'].'</option>';
}
$body.='</select>';
$body.='</div>';


echo $body;
