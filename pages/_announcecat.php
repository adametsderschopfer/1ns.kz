<?php
    if(isset($_GET['id']) && $_GET['id'] != '') {
      $cat_id = $_GET['id'];
      $cat_id = intval($cat_id);

      $db->query("SELECT * FROM announce_cat WHERE id = '$cat_id'");
      if($db->NumRows() > 0) {
        $cates = $db->FetchArray();
      }

        
    }
?>



<div id="left-cont">
  <div id="top_bar">
                <ul>
                    <li>
                        <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 1 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 1)");
                        $ads = $db->FetchArray();

                    ?>
                    <a href="<?=$ads['url']; ?>" target='_blank'><img style="width: 458px; height: 70px;" src="<?=$ads['img']; ?>"></a>
                    </li>
                    <li>
                        <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 6 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 1)");
                        $ads = $db->FetchArray();

                    ?>
                    <a href="<?=$ads['url']; ?>" target='_blank'><img style="width: 458px; height: 70px;" src="<?=$ads['img']; ?>"></a>

                    </li>
                </ul>

            </div>
   <?php
    

    
?>
  <div id="category">
    <div class="title">
      <span><?=$cates['title']; ?></span> 
    </div>
  <div class="cont">

    

    <div class="search">
      <form action='' method='POST' id='search_announce'>
        <input name='query' type="text" class="search_bar_two"><br>
        <div class="cat_and_serch">
          <select name="category">
        <option value='all' selected>Все категории</option>
        <?php
        $db->query("SELECT * FROM announce_cat ORDER BY id");

        $listcats = $db->FetchArray();
   
        do{
          $catid = $listcats['id'];
          $db->query("SELECT * FROM announce WHERE cat_id = '$catid' AND act = 1");
          $ancount = $db->NumRows();
        ?>
        <option value="<?=$listcats['id']; ?>"><?=$listcats['title']; ?> (<?=$ancount; ?>)</option>
        <?php
        $db->query("SELECT * FROM announce_cat WHERE id > '$catid' ORDER BY id");
        } while ($listcats = $db->FetchArray());
        ?>
      </select>

      <input id='go_search' type="button" value="Найти">
    </div>
    </form>
      </div>
      <div class="categories">
        <div class="items">
          <?php
            $db->query("SELECT * FROM announce_cat ORDER BY id");

            $listcats = $db->FetchArray();

            do{
              $catid = $listcats['id'];
              $db->query("SELECT * FROM announce WHERE cat_id = '$catid' AND act = 1");
              $ancount = $db->NumRows();
          ?>
          <div class="item"><a href="/announcecat/<?=$listcats['id']; ?>"><?=$listcats['title']; ?> (<?=$ancount; ?>)</a></div>
          <?php
          $db->query("SELECT * FROM announce_cat WHERE id > '$catid' ORDER BY id");
            } while ($listcats = $db->FetchArray());
          ?>
      </div>
    </div>



      <br>



    <div class="content">

    

<a href="/addannounce" style="float: right; font-weight: 700; color: black; font-size: 1em;">Добавить объявление</a><br>
 <div class="items" style="margin-top: 10px;">
        <?php

        
          $db->query("SELECT * FROM announce WHERE act = 1 AND cat_id = '$cat_id' ORDER BY id DESC LIMIT 30");
        if($db->NumRows() > 0) {
        
        $announce = $db->FetchArray();

    do { 
?>
        
          <div class="item" style="display: flex;">
            <img width="60px" class="minimized" style="margin: 5px;" height="60px" src="<?=$announce['photo']; ?>" alt=""> 
            <div class="desc">
              <span class="news_date_sm">
                <?=date("d-m-Y H:i:s", $announce['date']); ?>  
              </span>
              <br>
              <span style="display: block; width: 85%;" class="main_bg_blc5_1">
                <?=$announce['text']; ?> 
              </span>
              <h4><?=$announce['phone']; ?></h3>
              <div class="price"><?=$announce['price']; ?></div>
            </div>
          </div>
            
          <?php
            }while($announce = $db->FetchArray());
          } else {
            echo "Тут пока нету объявлений!";
          }
          ?>
        </div>
    </div>
  </div>
  <br>
</div>
</div>







<script>
  $(function(){
  $('.minimized').click(function(event) {
    var i_path = $(this).attr('src');
    $('body').append('<div id="overlay"></div><div id="magnify"><img src="'+i_path+'"><div id="close-popup"><i></i></div></div>');
    $('#magnify').css({
      left: ($(document).width() - $('#magnify').outerWidth())/2,
      // top: ($(document).height() - $('#magnify').outerHeight())/2 upd: 24.10.2016
            top: ($(window).height() - $('#magnify').outerHeight())/2
    });
    $('#overlay, #magnify').fadeIn('fast');
  });
  
  $('body').on('click', '#close-popup, #overlay', function(event) {
    event.preventDefault();
 
    $('#overlay, #magnify').fadeOut('fast', function() {
      $('#close-popup, #magnify, #overlay').remove();
    });
  });
});
</script>

