<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['price']) && $_POST['price'] != '') {
        $text = $_POST['text'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $phone = $_POST['phone'];
        $annid = $_POST['annid'];

        $db->query("SELECT cat_id FROM announce WHERE id = '$annid'");
        $fetch = $db->FetchArray();

        $mcategory = $fetch['cat_id'];

        if($fetch['act'] == 1) {

            $db->query("UPDATE announce_cat SET count = count - 1 WHERE id = '$mcategory'");
            $db->query("UPDATE announce_cat SET count = count + 1 WHERE id = '$category'");
        }

        $db->query("UPDATE announce SET `text` = '$text', `price` = '$price', `cat_id` = '$category', `phone` = '$phone' WHERE id = '$annid'");

        



    }

?>