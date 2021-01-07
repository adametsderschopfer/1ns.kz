<?php
    @session_start();
    @ob_start();
    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
    $config = new config;
    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);
    if(isset($_POST['themeid']) && $_POST['themeid'] != '') {
        $themeid = $_POST['themeid'];
        $db->query("SELECT * FROM forum_themes WHERE id = '$themeid'");
        $theme = $db->FetchArray();
        $mescount = $theme['otvets'];
        $razd_id = $theme['razd_id'];
        $db->query("DELETE FROM forum_messages WHERE theme_id = '$razd_id'");
        $db->query("UPDATE forum_razds SET themes = themes - 1, messages = messages - '$mescount' WHERE id = '$razd_id'");
        $db->query("DELETE FROM forum_themes WHERE id = '$themeid'");
    }
?>