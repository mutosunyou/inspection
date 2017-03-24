var message;
//初期動作====================================================
$(function() {
message='';
  //ボタン==================================================
  $('#sendbtn').click(function(){
    switch($('#ponpon>option:selected').val()){
      case '1':
        message+="ラジエターベルトの"+$('#res>option:selected').val()+"が";
        if($('#em>option:selected').val()==1){
          message+="必要です";
        }else{
          message+="推奨されます";
        }
        message+="。<br>ベルトに"+$('#cond>option:selected').val()+"が見受けられます。弛み、断裂の要因となりますので"+$('#res>option:selected').val()+"してください。<br><br>";
        break;
      case '2':
        message+="ラジエターキャップの"+$('#res>option:selected').val()+"が";
        if($('#em>option:selected').val()==1){
          message+="必要です";
        }else{
          message+="推奨されます";
        }
        message+="。<br>キャップに"+$('#cond>option:selected').val()+"が見受けられます。水漏れの要因となりますので、"+$('#res>option:selected').val()+"してください。<br><br>";
        break;
      case '3':
        message+="ラジエター冷却水ゴムホースの"+$('#res>option:selected').val()+"が";
        if($('#em>option:selected').val()==1){
          message+="必要です";
        }else{
          message+="推奨されます";
        }
        message+="。<br>ホースに劣化が見受けられます。水漏れの要因となりますので、"+$('#res>option:selected').val()+"してください。<br><br>";
        break;
      case '4':
        message+="ラジエター本体の"+$('#res>option:selected').val()+"が";
        if($('#em>option:selected').val()==1){
          message+="必要です";
        }else{
          message+="推奨されます";
        }
         message+="。<br><br>";
        break;
      }
      $('#message').html(message);
      $('#pon').html('');
      $('#condition').html('');
      $('#response').html('');
      $('#emerge').html('');
    $('#checker>option').removeAttr('selected');
  });

  $('#categ').change(function(){
    $.post(
      "check.php",
      {
        "item":$('#categ>option:selected').val()
      },
      function(dat){
        $('#check').html(dat);
      }
    );
  });

  $('#check').on('change',function(){
    $.post(
      "pon.php",
      {
        "item":$('#checker>option:selected').val()
      },
      function(dat){
        $('#pon').html(dat);
      }
    );
  });

  $('#pon').on('change',function(){
    $.post(
      "condition.php",
      {
        "item":$('#ponpon>option:selected').val()
      },
      function(dat){
        $('#condition').html(dat);
      }
    );
    if($('#ponpon>option:selected').val()>2){
      $.post(
        "factor.php",
        {
        },
        function(dat){
          $('#response').html(dat);
        }
      );
    }
  });

  $('#condition').on('change',function(){
      $.post(
        "factor.php",
        {
        },
        function(dat){
          $('#response').html(dat);
        }
      );
  });

  $('#response').on('change',function(){
      $.post(
        "emergency.php",
        {
        },
        function(dat){
          $('#emerge').html(dat);
        }
      );
  });

  $('#inbody').keypress(function(){
    console.log($('#inbody').val());
  });

  //=====================================================================button2

  $('.form-control').change(function(){
      var message2='';
    if($('#151').val()==1){
      message2+='冷却水の入替が必要です。<br>';
    }
    if($('#152').val()==1){
      message2+='コアーの掃除、ゴムホース交換が必要です。<br>';
    }
    if($('#153').val()==1){
      message2+='ファンの羽根取付鋲の交換が必要です。<br>';
    }
    if($('#154').val()==1){
      message2+='ファンベルトの交換が必要です。<br>';
    }
    if($('#155').val()==1){
      message2+='スパイダーの交換が必要です。<br>';
    }


    $('#message2').html(message2);



      });


});

    //  $(ev.target).attr('desc').removeAttr('disabled');//disabled属性を削除する
    //  $(ev.target).attr('desc').attr('disabled', 'disabled');//disabled属性を付与する
