//初期動作====================================================
$(function() {

  $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});//カレンダーから日付を選ぶ
  reloadTable();

  //ボタン==================================================




  $('*').change(function(){
    copytoqarray();
    if(checkflg()==1){
      $('#sendbtn').removeAttr('disabled');
    }else{
      $('#sendbtn').attr('disabled', 'disabled');//disabled属性を付与する
    }
  });

  $('*').click(function(){
    copytoqarray();
    if(checkflg()==1){
      $('#sendbtn').removeAttr('disabled');
    }else{
      $('#sendbtn').attr('disabled', 'disabled');//disabled属性を付与する
    }
  });



  //削除ボタン
  $('#qlist').on('click','.delq', function(e){
    copytoqarray();//現状をデータに反映させる。
    qarray.splice($(e.target).attr('delqnum'),1);
    reloadTable();
  });




//関数////////////////////////////////////////////////////////
//アンケートを表示する。
function reloadTable(){
  JSON = $.toJSON(qarray);
  $.post(
    "helper/qlister.php",
    {
      "qarray":JSON
    },
    function(data){
      $('#qlist').html(data);
    }
  );
}

//必須項目入力されているかチェック
function checkflg(){
  var flg=0;
  var n=qarray.length;
  var tmp=0,ready=1;
  //自由解答欄を設けるか、選択肢が１つ作らないといけない
  for(var i=0;i<n;i++){
    if(qarray[i][0]['check']==true || qarray[i].length>1){
      tmp=1;
    }else{tmp=0;}
    ready=ready*tmp;
  }
  if($('#title').val().length>0 && $('#cont').val().length>0 && ($('#enablequestionnaire').prop('checked')==false || ($('#enablequestionnaire').prop('checked')==true && ready==1))) {
    flg=1;
  }
  return flg;
}



