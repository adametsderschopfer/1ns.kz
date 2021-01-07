<?php
if(isset($_SESSION['userid']) && $_SESSION['userid'] != '') {

  $userid = $_SESSION['userid'];

  $db->query("SELECT * FROM users WHERE id='$userid' LIMIT 1");
  $user = $db->FetchArray();

  if(isset($_GET['set'])){
    $page = strval($_GET['set']);
    switch($page){
      case '404': include('pages/_404.php'); break;


      default: @include('pages/_404.php'); break;
    }
  }else{
      include('pages/account/_index.php');
  }
} else {
  header("LOCATION: /");
  exit();
}
?>
