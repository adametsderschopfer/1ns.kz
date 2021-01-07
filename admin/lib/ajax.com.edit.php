<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['title']) && $_POST['title'] != '') {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $desc = $_POST['desc'];
        $category = $_POST['category'];
        $comid = $_POST['comid'];
        $top = $_POST['top'];

        $db->query("SELECT cat_id FROM companyes WHERE id = '$comid'");
        $fetch = $db->FetchArray();

        $mcategory = $fetch['cat_id'];

        $db->query("UPDATE companyes_cat SET count = count - 1 WHERE id = '$mcategory'");


        $db->query("UPDATE companyes SET `text` = '$text', `title` = '$title', `cat_id` = '$category', `descr` = '$desc', `top` = '$top' WHERE id = '$comid'");

        $db->query("UPDATE companyes_cat SET count = count + 1 WHERE id = '$category'");



    }

?>