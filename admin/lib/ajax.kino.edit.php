<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['kinoid']) && $_POST['kinoid'] != '') {
        $kinoid = $_POST['kinoid'];

        $title = $_POST['title'];
        $desc = $_POST['desc'];


        $db->query("UPDATE kinoafish SET `title` = '$title', `desc` = '$desc' WHERE id = '$kinoid'");

    }



?>