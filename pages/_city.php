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
      <span>Город</span> 
    </div>
    <div class="content">
      	
        
        	<h4>Нур-Султан (Астана)</h4>
        <ul class="city_ul">
        	<?php

        	$db->query("SELECT * FROM city ORDER BY id LIMIT 10");
        	$city = $db->FetchArray();

    		do {

            if($pageid == $city['id']) {

        ?>

          <li><?=$city['title']; ?></li>
        <?php
            } else {
        ?>
              <li><a href="/city/<?=$city['id']; ?>"><?=$city['title']; ?></a></li>

        <?php
            }

    		?>
          
        	
        	<?php
        	} while ($city = $db->FetchArray());
        	?>
        </ul>
        
        <?php
          

          $db->query("SELECT * FROM city WHERE id = '$pageid' LIMIT 1");
          $cp = $db->FetchArray();

          echo $cp['text'];
        ?>
       

  </div>
</div>
</div>









