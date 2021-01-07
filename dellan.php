<?php
  @session_start();

  @ob_start();

  function __autoload($name){ include('classes/_class.'.$name.'.php');}

  $config = new config;

  $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    $code = $_POST['code'];
    $delcode = $_POST['delcode'];

    if($delcode == $_SESSION['delcode']) {
      $db->query("SELECT * FROM announce WHERE delcode = '$code'");
      $an = $db->FetchArray();
      $category = $an['cat_id'];

      $db->query("DELETE FROM announce WHERE delcode = '$code'");
      $db->query("UPDATE announce_cat SET count = count - 1 WHERE id = '$category'");
?>
<p>
  <span><font color="green">Успешно удалено</font></span>
  <script type="text/javascript">
    setTimeout(location.reload(), 3000);
  </script>
</p>
<?php

    } else {

?>

<p>
  <span><font color="red">Не верный код</font></span>
  <b>Введите код подтверждения отправленный на СМС:</b><br>
  <input style="border: 1px solid #ccc; width: 200px;" type='text' id="delancode"><button type="button" onclick="delan(<?=$delcode; ?>);">Подтвердить</button>
</p>


<?php
    }
  
?>
<script>
    function delan(code){
        var delcode = $('#delancode').val();
        $.ajax({
           url: "dellan.php",
          type: "POST",
          dataType: "html",
          data: {"code": code, "delcode": delcode},
          success: function(html) {
            $('.del-announce').html(html);
          },
          error: function(html) {

          }
        });
    }
</script>