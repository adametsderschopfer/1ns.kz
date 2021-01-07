<?php
@session_start();

@ob_start();

function __autoload($name)
{
	include('classes/_class.' . $name . '.php');
}

$config = new config;

$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

if (isset($_POST['phone']) && $_POST['phone'] != '') {
	$phone = $_POST['phone'];
	$code = rand(1000, 9999);
	$phone = '7' . $phone;
	$_SESSION['code'] = $code;
	$_SESSION['no-phone'] = $phone;

	$message = 'Код подтверждения 1ns.kz: ' . $code;

	file_get_contents("https://smsc.kz/sys/send.php?login=highsystem&psw=Brat5234305&phones=$phone&mes=$message");
?>

	<div id="ver3" class="ver-message">
		<form id="verification2" action="" method="POST">
			Введите четырёхзначный код из SMS:

			<br>
			<br>
			<input type="text" name="code">
			<br><br>
		</form>
		<button id="verbut3">Отправить</button>
	</div>


	<script type="text/javascript">
		$("#verbut3").click(
			function() {
				VerSendForm('ver3', 'ver4', 'verification2');
				return false;
			}
		);
	</script>
	<?php
}

if (isset($_POST['code']) && $_POST['code'] != '') {
	$code = $_POST['code'];
	if ($code == $_SESSION['code']) {
		$_SESSION['phone'] = $_SESSION['no-phone'];
	?>
		<div id="ver4" class="ver-message">
			Вы успешно авторизованы. Ваш номер телефона будет использоваться в ваших комментариях или объявлениях, но будет виден только администратору сайта. Для того, чтобы начать писать комментарии или объявления, нажмите "Начать".
			<br><br>
			<button id="verbut4">Начать</button>
		</div>

		<script>
			$("#verbut4").click(
				function() {
					location.reload();
				}
			);
		</script>

	<?php
	} else {
	?>
		<div id="ver3" class="ver-message">
			<form id="verification2" action="" method="POST">
				<font color="red">Неверный код!</font><br>
				Введите четырёхзначный код из SMS:
				<br>
				<br>
				<input type="text" name="code">
				<br><br>
			</form>
			<button id="verbut3">Отправить</button>
		</div>

		<script type="text/javascript">
			$("#verbut3").click(
				function() {
					VerSendForm('ver3', 'ver4', 'verification2');
					return false;
				}
			);
		</script>

<?php
	}
}
