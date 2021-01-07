<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['annid']) && $_POST['annid'] != '') {
        
        $annid = $_POST['annid'];

        $db->query("SELECT cat_id FROM announce WHERE id = '$annid'");
        $fetch = $db->FetchArray();

        $category = $fetch['cat_id'];

        $db->query("UPDATE announce SET `act` = 1 WHERE id = '$annid'");

        $db->query("UPDATE announce_cat SET count = count + 1 WHERE id = '$category'");



    }

?>