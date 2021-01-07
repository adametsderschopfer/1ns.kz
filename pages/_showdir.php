<?php
    if(isset($_GET['id']) && $_GET['id'] != '') {
      $dirid = $_GET['id'];
    } else {
      $dirid = 1;
    }
    $query = "SELECT * FROM dir WHERE id = '$dirid'";
    $db->query($query);
    $dir = $db->FetchArray();
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
      <span>
        <?php
      if($dir['type'] == 'phone') {
        echo "Телефонный справочник";
      } elseif($dir['type'] == 'page') {
        echo $dir['title'];
      } elseif($dir['type'] == 'com') {
        echo "Список компаний";
      }
      ?>
        
      </span> 
    </div>
    <div class="content">

     <?php
      if($dir['type'] == 'phone') {
        echo "<h1>".$dir['title']."</h1>";
      ?>
        <div style="margin: 5px; padding: 5px;">
          <p style="display: flex;"><b style="width: 80%;">Служба</b><span style="width: 20%; text-align: center;"><b>Телефон</b></span></p>
          <?php
            $db->query("SELECT * FROM phones WHERE cat = '$dirid'");
            $phone = $db->FetchArray();
            do{
          ?>
          <p style="display: flex;"><span style="width: 80%;"><?=$phone['title']; ?></span><span style="width: 20%; text-align: center;"><?=$phone['phone']; ?></span></p>
          <?php
            } while($phone = $db->FetchArray());
          ?>
        </div>
      <?php
      } elseif($dir['type'] == 'page') {
        $text = $dir['text']; 
        $handle = fopen("cache/".md5( $query ).".inc", "w+");
        fwrite($handle, $text); 
        fclose($handle);
        require "cache/".md5( $query ).".inc";
      } elseif($dir['type'] == 'com') {
        echo "<h1>".$dir['title']."</h1>";
        $db->query("SELECT * FROM coms WHERE cat = '$dirid'");
        $com = $db->FetchArray();
        do{
      ?>
          <div style="margin: 5px; padding: 5px; border-bottom: 1px dashed #ccc;">
              <h2><?=$com['title']; ?></h2>
              <p><?=$com['des']; ?></p>
              <p style="display: flex;">
                <span style="width: 40%;"><?=$com['phone']; ?></span>
                <span style="width: 60%;"><?=$com['adres']; ?></span>
              </p>
              <p style="display: flex;">
                <span style="width: 40%;"><a href="emailto:<?=$com['email']; ?>"><?=$com['email']; ?></a></span>
                <span style="width: 60%;"><a href="<?=$com['site']; ?>"><?=$com['site']; ?></a></span>
              </p>
          </div>

      <?php
        } while ($com = $db->FetchArray());
      }

      
   
    ?>
    
    

     



    
	</div>
</div>
</div>









