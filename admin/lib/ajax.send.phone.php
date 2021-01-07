<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['title']) && $_POST['title'] != '') {

        $title = $_POST['title'];
        $phone = $_POST['phone'];
        $cat = $_POST['cat'];

        $db->query("INSERT INTO phones (`title`, `phone`, `cat`) VALUES ('$title', '$phone', '$cat')");

    }



?>