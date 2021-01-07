
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
    $db->query("SELECT * FROM news_cat WHERE id != 1 && id != 2 && id != 3 ORDER BY id LIMIT 10");


    $cats = $db->FetchArray();

    do { 
?>
  <div id="category-news">
    <div class="title">
      <span><?=$cats['title']; ?></span> <div class="all-news-cat">Все новости из категории "<a href="/category/<?=$cats['id']; ?>"><?=$cats['title']; ?></a>"</div>
    </div>
    <div class="content">
      <div class="topnews">
        <div class="content">
        <div class="items">
        <?php

    $cat_new = $cats['id'];

    $db->query("SELECT * FROM news WHERE cat_id = '$cat_new' ORDER BY id DESC LIMIT 3");


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
          <br>
          <?php
            }while($news = $db->FetchArray());
          ?>
          </div>
          </div>
      </div>
      <div class="main_news">
         <?php

    $cat_new = $cats['id'];

    $db->query("SELECT * FROM news WHERE cat_id = '$cat_new' ORDER BY views DESC LIMIT 4");


    $news = $db->FetchArray();

    do { 
?>

<span class="news_date_sm"><?=date("d-m-Y, H:i:s", intval($news['date'])); ?> | <?=$news['views']; ?>
                <a href="/viewnews/<?=$news['id']; ?>#view_comments">
                  (<?=$news['count']; ?>)
                </a></span> <br>
                  <a href="/viewnews/<?=$news['id']; ?>"><?=$news['title']; ?></a> <br> 
                  <?=$news['description']; ?>                                   
               <br>

<?php
            }while($news = $db->FetchArray());
          ?>

      </div>
    </div>
  </div>
  <br>
  <?php
    $last_cat = $cats['id'];
    $db->query("SELECT * FROM news_cat WHERE id > '$last_cat' ORDER BY id LIMIT 10");     
    }while ($cats = $db->FetchArray());
  ?>
</div>









