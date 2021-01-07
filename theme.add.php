<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['title']) && $_POST['title'] != '') {
        $text = $_POST['text'];
        $desc = $_POST['desc'];
        $razid = $_POST['razid'];
        $title = $_POST['title'];
        $date = time();
        $userid = $_SESSION['userid'];


        $db->query("INSERT INTO forum_themes (`message`, `title`, `razd_id`, `description`, `date`, `author`) VALUES ('$text', '$title', '$razid', '$desc', '$date', '$userid')");
        $db->query("UPDATE forum_razds SET themes = themes + 1 WHERE id = '$razid'");



    }

?>