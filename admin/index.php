<?php
@session_start();

@ob_start();

$_OPTIMIZATION = array();
$_OPTIMIZATION['title'] = 'Главная страница';
$_OPTIMIZATION['description'] = 'Описание сайта';
$_OPTIMIZATION['keywords'] = 'Ключевые слова сайта';

function __autoload($name)
{
	include('classes/_class.' . $name . '.php');
}

$config = new config;

$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

include('include/_header.php');

if ($_SESSION['adminid'] && $_SESSION['adminid'] != '') {
	if (isset($_GET['page'])) {
		$page = strval($_GET['page']);

		switch ($page) {
			case '404':
				include('pages/_404.php');
				break;

			case 'newslist':
				include('pages/_newslist.php');
				break;
			case 'editnews':
				include('pages/_editnews.php');
				break;
			case 'addnews':
				include('pages/_addnews.php');
				break;
			case 'newscats':
				include('pages/_newscats.php');
				break;
			case 'editcat':
				include('pages/_editcat.php');
				break;
			case 'editann':
				include('pages/_editann.php');
				break;
			case 'addcat':
				include('pages/_addcat.php');
				break;
			case 'infolist':
				include('pages/_infolist.php');
				break;
			case 'addann':
				include('pages/_addann.php');
				break;
			case 'annlist':
				include('pages/_annlist.php');
				break;
			case 'anncats':
				include('pages/_anncats.php');
				break;
			case 'addanncat':
				include('pages/_addanncat.php');
				break;
			case 'editanncat':
				include('pages/_editanncat.php');
				break;
			case 'delanncat':
				include('pages/_delanncat.php');
				break;
			case 'comlist':
				include('pages/_comlist.php');
				break;
			case 'addcom':
				include('pages/_addcom.php');
				break;
			case 'editcom':
				include('pages/_editcom.php');
				break;
			case 'comcats':
				include('pages/_comcats.php');
				break;
			case 'editcomcat':
				include('pages/_editcomcat.php');
				break;
			case 'addcomcat':
				include('pages/_addcomcat.php');
				break;
			case 'addinfo':
				include('pages/_addinfo.php');
				break;
			case 'comments':
				include('pages/_comments.php');
				break;
			case 'kino':
				include('pages/_kino.php');
				break;
			case 'themes':
				include('pages/_themes.php');
				break;
			case 'razds':
				include('pages/_razds.php');
				break;
			case 'users':
				include('pages/_users.php');
				break;
			case 'recovery':
				include('pages/_recovery.php');
				break;
			case 'messages':
				include('pages/_messages.php');
				break;
			case 'ads':
				include('pages/_ads.php');
				break;
			case 'editads':
				include('pages/_editads.php');
				break;
			case 'addads':
				include('pages/_addads.php');
				break;
			case 'addkino':
				include('pages/_addkino.php');
				break;
			case 'editkino':
				include('pages/_editkino.php');
				break;

			default:
				@include('pages/_404.php');
				break;
		}
	} else {
		include('pages/_index.php');
	}

	if ($_GET['logout'] == true) {
		session_destroy();
		header("LOCATION: /");
		exit;
	}
} else {
	include('pages/_login.php');
}
include('include/_footer.php');

$content = ob_get_contents();

ob_end_clean();

$content = str_replace('{!TITLE!}', $_OPTIMIZATION['title'], $content);
$content = str_replace('{!DESCRIPTION!}', $_OPTIMIZATION['description'], $content);
$content = str_replace('{!KEYWORDS!}', $_OPTIMIZATION['keywords'], $content);

echo $content;
