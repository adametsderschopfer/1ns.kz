<?php
    @session_start();

    @ob_start();

    function __autoload($name){ include('../classes/_class.'.$name.'.php');}
 
    $config = new config;

    $db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

    if(isset($_POST['comid']) && $_POST['comid'] != '') {
        $comid = $_POST['comid'];

        $db->query("SELECT * FROM companyes WHERE id = '$comid'");
        $comcat = $db->FetchArray();

        $cat = $comcat['cat_id'];

        $db->query("DELETE FROM companyes WHERE id = '$comid'");
        $db->query("UPDATE companyes_cat SET count = count - 1 WHERE id = '$cat'");
    }

?>