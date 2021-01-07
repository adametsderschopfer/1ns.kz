<?php
    if(isset($_GET['id']) && $_GET['id'] != '') {
      $cat_id = $_GET['id'];
      $cat_id = intval($cat_id);

      $db->query("SELECT * FROM news_cat WHERE id = '$cat_id'");
      if($db->NumRows() > 0) {
        $cates = $db->FetchArray();
      }

        
    }
?>


<div id="top-news-nav">
  <ul>
    <li><a href="/news" class="pod_menu_big_l">Все</a></li>
    <li><a href="/category/1">Обсуждаемые</a></li>
    <li><a href="/category/2">Популярные</a></li>

    <?php
      $db->query("SELECT * FROM news_cat WHERE id != 1 && id != 2 && id != 3 ORDER BY id LIMIT 10");


      $cats = $db->FetchArray();

      do { 
    ?>

        <li><a href="/category/<?=$cats['id']; ?>"><?=$cats['title']; ?></a></li>

    <?php
      }while ($cats = $db->FetchArray());
    ?>

    <li><a href="/category/3">Архив</a></li>
  </ul>
</div>
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
    <div class="content">
      <div class="items">
        <?php
        
        $page = $_GET['pages'];

        $num = 10;

        if($cat_id == 1) {
          $db->query("SELECT * FROM news");
        } elseif($cat_id == 2) {
          $db->query("SELECT * FROM news");
        } elseif($cat_id == 3) {
          $db->query("SELECT * FROM news WHERE archive = 1");
        } else {
          $db->query("SELECT * FROM news WHERE cat_id = '$cat_id'");
        }

        $posts = $db->NumRows();

        $total = intval(($posts - 1) / $num) + 1;

        $page = intval($page);

        if(empty($page) or $page < 0) $page = 1;
        if($page > $total) $page = $total;

        $start = $page * $num - $num;

        if($cat_id == 1) {
          $db->query("SELECT * FROM news ORDER BY count DESC LIMIT $start, $num");
        } elseif($cat_id == 2) {
          $db->query("SELECT * FROM news ORDER BY views DESC LIMIT $start, $num");
        } elseif($cat_id == 3) {
          $db->query("SELECT * FROM news WHERE archive = 1 ORDER BY id DESC LIMIT $start, $num");
        } else {
          $db->query("SELECT * FROM news WHERE cat_id = '$cat_id' ORDER BY id DESC LIMIT $start, $num");
        }
        
        $news = $db->FetchArray();

    do { 
?>
        
          <div class="item">
            <div class="pic">
              <img src="<?=$news['small_img']; ?>" alt="<?=$news['title']; ?>">
            </div>
            <div class="desc">
              <span class="news_date_sm">
               <?=date("d-m-Y, H:i:s", intval($news['date'])); ?> | <?=$news['views']; ?>
                <a href="/viewnews/<?=$news['id']; ?>#view_comments">
                  (<?=$news['count']; ?>)
                </a>
              </span>
              <br>
              <span class="main_bg_blc5_1">
                <a href="/viewnews/<?=$news['id']; ?>">
                  <?=$news['title']; ?>        
                </a>
              </span>
              <br />
              <?=$news['description']; ?>
            </div>
          </div>
          <?php
            }while($news = $db->FetchArray());
          ?>
        </div>

        <div class="nav_pages">
<?php
  if($page != 1) {
?>
  <a href="/category/<?=$cat_id; ?>/1"><<</a>
  <a href="/category/<?=$cat_id; ?>/<?=$page - 1; ?>"><</a>
<?php
  }

  if($page - 2 > 0) {
?>
  <a href="/category/<?=$cat_id; ?>/<?=$page - 2; ?>"><?=$page - 2; ?></a>

<?php
  }
   if($page - 1 > 0) {
?>
  <a href="/category/<?=$cat_id; ?>/<?=$page - 1; ?>"><?=$page - 1; ?></a>

<?php
  }

  echo "<b>$page</b>";

  
   if($page + 1 <= $total) {
?>
  <a href="/category/<?=$cat_id; ?>/<?=$page + 1; ?>"><?=$page + 1; ?></a>

<?php
  }
  if($page + 2 <= $total) {
?>
  <a href="/category/<?=$cat_id; ?>/<?=$page + 2; ?>"><?=$page + 2; ?></a>

<?php
  }

  if($page != $total) {
?>
  <a href="/category/<?=$cat_id; ?>/<?=$page + 1; ?>">></a>
  <a href="/category/<?=$cat_id; ?>/<?=$total; ?>">>>></a>
<?php
  }



?>

        </div>
    </div>
  </div>
  <br>

</div>









