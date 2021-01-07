<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['adsid']) && $_POST['adsid'] != '') {
        $adsid = $_POST['adsid'];

        $db->query("DELETE FROM ads WHERE id = '$adsid'");
    }

?>