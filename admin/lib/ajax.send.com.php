<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['title']) && $_POST['title'] != '') {

        $title = $_POST['title'];
        $des = $_POST['des'];
        $cat = $_POST['cat'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $site = $_POST['site'];
        $adres = $_POST['adres'];

        $db->query("INSERT INTO coms (`title`, `des`, `cat`, `email`, `phone`, `site`, `adres`) VALUES ('$title', '$des', '$cat', '$email', '$phone', '$site', '$adres')");

    }



?>