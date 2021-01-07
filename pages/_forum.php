<?php 
    include('pages/forum/_forum_top.php');

    if(isset($_GET['set'])){
      $page = strval($_GET['set']);
      switch($page){
          case '404': include('pages/_404.php'); break;
          case 'theme': include('pages/forum/_theme.php'); break;
          case 'topic': include('pages/forum/_topic.php'); break;
          case 'addtheme': include('pages/forum/_addtheme.php'); break;

         
          default: @include('pages/_404.php'); break;
      }
  }else{
      include('pages/forum/_index.php');
  }
?>