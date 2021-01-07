<?php
    if(isset($_GET['id']) && $_GET['id'] != '') {
      $cat_id = $_GET['id'];
      $cat_id = intval($cat_id);

      $db->query("SELECT * FROM companyes_cat WHERE id = '$cat_id'");
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
    <div class="content">
      <div class="items">
        <?php

        
          $db->query("SELECT * FROM companyes WHERE cat_id = '$cat_id' ORDER BY id DESC LIMIT 20");
        
        $companyes = $db->FetchArray();

    do { 
?>
        
          <div class="item">
            <div class="pic">
              <img src="<?=$companyes['logo']; ?>" alt="<?=$companyes['title']; ?>">
            </div>
            <div class="desc">
              
              <br>
              <span class="main_bg_blc5_1">
                <a href="/company/<?=$companyes['id']; ?>">
                  <?=$companyes['title']; ?>        
                </a>
              </span>
              <br />
              <?=$companyes['descr']; ?>
            </div>
          </div>
          <?php
            }while($companyes = $db->FetchArray());
          ?>
        </div>
    </div>
  </div>
  <br>

</div>









