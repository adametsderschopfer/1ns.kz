<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['newsid']) && $_POST['newsid'] != '') {
        $newsid = $_POST['newsid'];

        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $text = $_POST['text'];
        $slide = $_POST['slide'];
        $slideDesc = $_POST['slideDesc'];
        $category = $_POST['category'];
        $video = $_POST['video'];


        $db->query("UPDATE news SET `title` = '$title', `top` = '$slide', `cat_id` = '$category', `description` = '$desc', `top_description` = '$slideDesc', `text` = '$text', `video` = '$video' WHERE id = '$newsid'");

    }



?>