<?php
    @session_start();
    @ob_start();
    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
    $config = new config;
    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);
    if(isset($_POST['comid']) && $_POST['comid'] != '') {
        $comid = $_POST['comid'];
        $db->query("SELECT * FROM news_comments WHERE id = '$comid'");
        $comments = $db->FetchArray();
        $newid = $comments['news_id'];
        $db->query("UPDATE news SET count = count - 1 WHERE id = '$newid'");
        $db->query("DELETE FROM news_comments WHERE id = '$comid'");
    }
?>