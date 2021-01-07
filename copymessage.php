<?php
	@session_start();

	@ob_start();

	function __autoload($name){ include('classes/_class.'.$name.'.php');}

	$config = new config;

	$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

	if(isset($_POST['message']) && $_POST['message'] != '') {
		$id = $_POST['message'];

		$db->query("SELECT message FROM forum_messages WHERE id = '$id'");
		$message = $db->FetchArray();
	}

	
?>

<blockquote>
	<?=$message['message']; ?>
</blockquote>