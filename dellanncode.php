<?php
	@session_start();

	@ob_start();

	function __autoload($name){ include('classes/_class.'.$name.'.php');}

	$config = new config;

	$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    $delcode = $_POST['delcode'];

    $db->query("SELECT * FROM announce WHERE delcode = '$delcode'");
    if($db->NumRows() > 0) {
        $an = $db->FetchArray();

        $phone = $an['phone'];
        $code = rand(1000, 9999);
        $_SESSION['delcode'] = $code;

        $message = 'Код подтверждения 1ns.kz: '.$code;

        file_get_contents("https://smsc.kz/sys/send.php?login=highsystem&psw=Brat5234305&phones=$phone&mes=$message");
?>
        <p>
            <b>Введите код подтверждения отправленный на СМС:</b><br><input style="border: 1px solid #ccc; width: 200px;" type='text' id="delancode"><button type="button" onclick="delan(<?=$delcode; ?>);">Подтвердить</button>
        </p>
<?php
    } else {
        echo "Нет такого номера";
    }
    $an = $db->FetchArray();
?>





<script>
    function delan(code){
        var delcode = $('#delancode').val();
        $.ajax({
           url: "/dellan.php",
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