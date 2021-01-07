<?php
	@session_start();

	@ob_start();

	function __autoload($name){ include('classes/_class.'.$name.'.php');}

	$config = new config;

	$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

	if(isset($_POST['query']) && $_POST['query'] != '') {
		if(isset($_POST['category']) && $_POST['category'] != '') {
			$category = $_POST['category'];
			$query = $_POST['query'];
		}
		
	}


        if($category == 'all') {
			$db->query("SELECT * FROM announce WHERE text LIKE '%$query%'");
		} else {
			$db->query("SELECT * FROM announce WHERE text LIKE '%$query%' AND cat_id = '$category'");
		}
		
		if($db->NumRows() > 0) {
			
        
        $announce = $db->FetchArray();

    do { 
?>
        
          <div class="item">
            <div class="desc">
              <span class="news_date_sm">
                <?=$announce['date']; ?>  
              </span>
              <br>
              <span class="main_bg_blc5_1">
                  <?=$announce['text']; ?> 
              </span><br>
              <h4><?=$announce['phone']; ?></h3>
              <div class="price"><?=$announce['price']; ?></div>
            </div>
            
          </div>
          <?php
            }while($announce = $db->FetchArray());
		} else {
			echo 'Поиск не дал результатов!';
		}
          ?>