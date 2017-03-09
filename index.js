//初期動作====================================================
$(function() {
    console.log($('#element>option:selected').val());

  //ボタン==================================================
  $('#sendbtn').click(function(){
    var data;
    data=$('#parts>option:selected').val()+'について調査したところ、'+$('#item>option:selected').val()+'に'+$('#cond>option:selected').val()+'が見つかったため、'+$('#emergency>option:selected').val()+'、'+$('#resp>option:selected').val()+'が'+$('#need>option:selected').val();
    $('#ppp').html(data);
  });

});


