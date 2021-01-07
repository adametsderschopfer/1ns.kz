<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['newsid']) && $_POST['newsid'] != '') {
        $newsid = $_POST['newsid'];

        $db->query("DELETE FROM news WHERE id = '$newsid'");
        $db->query("DELETE FROM news_comments WHERE news_id = '$newsid'");
    }

?>