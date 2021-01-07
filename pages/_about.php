<?php
          if(isset($_GET['id']) && $_GET['id'] != '') {
            $pageid = $_GET['id'];
          } else {
            $pageid = 1;
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
  <div id="announce">
    <div class="title">
      <span>О сайте - 1ns.kz</span> 
    </div>
    <div class="content">
      	
        
        	
        <ul>
        	<?php

        	$db->query("SELECT * FROM about ORDER BY id LIMIT 10");
        	$about = $db->FetchArray();

    		do {

            if($pageid == $about['id']) {

        ?>

          <li><?=$about['title']; ?></li>
        <?php
            } else {
        ?>
              <li><a href="/about/<?=$about['id']; ?>"><?=$about['title']; ?></a></li>

        <?php
            }

    		?>
          
        	
        	<?php


        	} while ($about = $db->FetchArray());
        	?>
        </ul>
        

       <?php
        $db->query("SELECT * FROM about WHERE id = '$pageid'");
        $ab_cont = $db->FetchArray();

       ?>

       <?=$ab_cont['text']; ?>

  </div>
</div>
</div>









