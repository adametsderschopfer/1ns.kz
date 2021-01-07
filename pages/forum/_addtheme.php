<?php
  if(!isset($_SESSION['userid']) || $_SESSION['userid'] == '') {
    header("LOCATION: /forum/");
    exit();
  }

  if(isset($_GET['id']) && $_GET['id'] != '') {
    $razid = $_GET['id'];
  }
  
?>
<div id="left-cont" style="width: 100%;">
  <div id="signup">
    <div class="title">
      <span>Новая тема</span>
    </div>
    <div class="content">
        <p>Название темы:<br>
        <input type="text" id="title"></p>
        <p>Описание (не более 255 символов):<br>
        <input type="text" id="desc"></p>
        <p>Текст:<br>
        <textarea id="text" cols="30" rows="10"></textarea>
      </p>

        <input type="button" onclick="newtheme(<?=$razid; ?>);" value="Отправить">


<script>
  window.onload = function() {
    CKEDITOR.replace( 'text' );
  };

  function newtheme(razid) {
    var data = new FormData();

    var title = $('#title').val();
    var desc = $('#desc').val();
    var text = CKEDITOR.instances['text'].getData();

    data.append('title', title);
    data.append('desc', desc);
    data.append('text', text);
    data.append('razid', razid);

    $.ajax({
        url         : '/theme.add.php',
        type        : 'POST',
        data        : data,
        cache       : false,
        dataType    : 'html',
        processData : false,
        contentType : false,
        success     : function(html) {
          $("#signup").html(html);
        },
        error       : function() {

        }
    });
  }

</script>
    </div>
  </div>
</div>
