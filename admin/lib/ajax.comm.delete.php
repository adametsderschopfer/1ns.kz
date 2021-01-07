<?php
    @session_start();
    @ob_start();
    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
    $config = new config;
    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);
    if(isset($_POST['comid']) && $_POST['comid'] != '') {
        $comid = $_POST['comid'];
        $db->query("DELETE FROM coms WHERE id = '$comid'");
        
    }
?>