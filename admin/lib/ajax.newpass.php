<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    $pass = $_POST['pass'];
    $pass = md5($pass);
    $db->query("UPDATE admin SET pass = '$pass' WHERE id = 1");
    echo "Пароль успешно изменен!";
?>