<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['catsid']) && $_POST['catsid'] != '') {
        $catsid = $_POST['catsid'];

        $db->query("DELETE FROM companyes WHERE cat_id = '$catsid'");
        $db->query("DELETE FROM companyes_cat WHERE id = '$catsid'");
    }

?>