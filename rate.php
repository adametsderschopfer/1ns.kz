<?php
	@session_start();

	@ob_start();

	function __autoload($name){ include('classes/_class.'.$name.'.php');}

	$config = new config;

	$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

	if(isset($_POST['minus']) && $_POST['minus'] != '') {
		$id = $_POST['minus'];
		if(isset($_SESSION['minus'.$id]) || isset($_SESSION['plus'.$id])) {
		} else {
			
			$db->query("UPDATE kinoafish SET rating = rating - 1, count = count + 1 WHERE id = '$id'");
			$_SESSION['minus'.$id] = '1';
		}
	}

	if(isset($_POST['plus']) && $_POST['plus'] != '') {
		$id = $_POST['plus'];

		if(isset($_SESSION['minus'.$id]) || isset($_SESSION['plus'.$id])) {

		} else {
			$db->query("UPDATE kinoafish SET rating = rating + 1, count = count + 1 WHERE id = '$id'");
			$_SESSION['plus'.$id] = '1';
		}
	}
?>

<div class="title"><span>Рейтинг фильмов</span></div>
    <div class="content">
      <div class="items">
        <?php
          $db->query("SELECT * FROM kinoafish ORDER BY id DESC LIMIT 5");
          $kino = $db->FetchArray();
          do{
        ?>
        <div class="item">
        <b style="color:#4291ff; " ><?=$kino['title']; ?></b> Рейтинг: <span onclick="minus_rate(<?=$kino['id']; ?>)" class="minus"> - </span> 
           <b>
            <?php
              if($kino['rating'] > 0) {
            ?>
              <font color="green"> <b><?=$kino['rating']; ?></b>  </font>
            <?php
              } elseif($kino['rating'] < 0) {
            ?>
              <font color="red"> <b><?=$kino['rating']; ?></b> </font>
            <?php
              } else {
                echo $kino['rating'];
              }
            ?>
            </b> <span onclick="plus_rate(<?=$kino['id']; ?>)" class="plus"> + </span> <br>(оценило: <?=$kino['count']; ?> чел.)
        </div>
        <?php
          } while ($kino = $db->FetchArray());
        ?>
      </div>
    </div>