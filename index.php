<?php
	@session_start();

	@ob_start();

	$_OPTIMIZATION = array();
	$_OPTIMIZATION['title'] = 'Главная страница';
	$_OPTIMIZATION['description'] = 'Описание сайта';
	$_OPTIMIZATION['keywords'] = 'Ключевые слова сайта';

	function __autoload($name){ include('classes/_class.'.$name.'.php');}

	$config = new config;

	$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

	include('include/_header.php');

	if(isset($_GET['page'])){
	    $page = strval($_GET['page']);
	    switch($page){
	        case '404': include('pages/_404.php'); break;
	        case 'signup': include('pages/_signup.php'); break;
	        case 'about': include('pages/_about.php'); break;
	        case 'login': include('pages/_login.php'); break;
	        case 'news': include('pages/_news.php'); break;
	        case 'dir': include('pages/_dir.php'); break;
	        case 'companyes': include('pages/_companyes.php'); break;
	        case 'company': include('pages/_company.php'); break;
	        case 'companyescat': include('pages/_companyescat.php'); break;
	        case 'announcecat': include('pages/_announcecat.php'); break;
	        case 'city': include('pages/_city.php'); break;
	        case 'forum': include('pages/_forum.php'); break;
	        case 'category': include('pages/_category.php'); break;
					case 'account': include('pages/_account.php'); break;
	        case 'announce': include('pages/_announce.php'); break;
	        case 'addannounce': include('pages/_addannounce.php'); break;
	        case 'viewnews': include('pages/_viewnews.php'); break;
	        case 'showdir': include('pages/_showdir.php'); break;

	        default: @include('pages/_404.php'); break;
	    }
	}else{
	    include('pages/_index.php');
	}
	include('include/_right.php');
	include('include/_footer.php');

	$content = ob_get_contents();

	ob_end_clean();

	$content = str_replace('{!TITLE!}',$_OPTIMIZATION['title'],$content);
	$content = str_replace('{!DESCRIPTION!}',$_OPTIMIZATION['description'],$content);
	$content = str_replace('{!KEYWORDS!}',$_OPTIMIZATION['keywords'],$content);

	echo $content;
?>
