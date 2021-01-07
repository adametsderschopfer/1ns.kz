<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['catid']) && $_POST['catid'] != '') {
        $catid = $_POST['catid'];

        $title = $_POST['title'];


        $db->query("UPDATE companyes_cat SET `title` = '$title' WHERE id = '$catid'");

    }



?>