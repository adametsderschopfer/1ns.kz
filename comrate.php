<?php
	@session_start();

	@ob_start();

	function __autoload($name){ include('classes/_class.'.$name.'.php');}

	$config = new config;

	$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

	$newsid = $_POST['newsid'];

	if(isset($_POST['minus']) && $_POST['minus'] != '') {
		$id = $_POST['minus'];
		if(isset($_SESSION['comminus'.$id]) || isset($_SESSION['complus'.$id])) {
		} else {
			
			$db->query("UPDATE news_comments SET rating = rating - 1 WHERE id = '$id'");

			$db->query("SELECT rating FROM news_comments WHERE id = '$id'");
			$ratenews = $db->FetchArray();

			if($ratenews['rating'] <= -10) {
				$db->query("UPDATE news_comments SET `text` = 'комментарий удален из за отрицательного рейтинга', name = 'Администрация сайта 1NS.KZ', email = 'support@1ns.kz' WHERE id = '$id'");
			}

			$_SESSION['comminus'.$id] = '1';
		}
	}

	if(isset($_POST['plus']) && $_POST['plus'] != '') {
		$id = $_POST['plus'];

		if(isset($_SESSION['comminus'.$id]) || isset($_SESSION['complus'.$id])) {

		} else {
			$db->query("UPDATE news_comments SET rating = rating + 1 WHERE id = '$id'");
			$_SESSION['complus'.$id] = '1';
		}
	}

						$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = 0 ORDER BY id");
						if($db->NumRows() > 0) {
						$comments = $db->FetchArray();
						do{
					?>
					<div class='news_comments_item border_com' id="comment_<?=$comments['id']; ?>">
						<div class='news_comments_item_title'>
						<img width="28" height="28" src="/img/commentava.png"><a href=''><?=$comments['name']; ?></a>, <span class="date_new_comment"><?=date('j.m.Y, H:i:s', intval($comments['date'])); ?></span>
						</div>
						<div class='news_comments_item_text'>
							<span class="block_text_comment"><?=$comments['text']; ?></span><br> [<a href='#addcomment' onclick='$("#number-otvet").val(<?=$comments['id']; ?>)'>Ответить</a>] <span>  [<font color="red" onclick="comminus(<?=$comments['id']; ?>, <?=$newsid; ?>)">-</font>] </span>[

<?php
	$comrat = intval($comments['rating']);
	if($comrat > 0) {
?>
	<font color="green"><?=$comrat; ?></font>
<?php
	} elseif ($comrat < 0) {
?>
	<font color="red"><?=$comrat; ?></font>
<?php
	} else {
?>
	<font><?=$comrat; ?></font>
<?php
	}
?>


							 ]<span> [<font color="green" onclick="complus(<?=$comments['id']; ?>, <?=$newsid; ?>)">+</font>] </span>
						</div>
						<div class="news_comments_item_otvet"> 
							<?php
								$comment_id = $comments['id'];
								$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = '$comment_id' ORDER BY id");
								
								if($db->NumRows() > 0) {
									$oneotvet = $db->FetchArray();
									do{
							?>
							<div class='news_comments_item' id='comment_<?=$oneotvet['id']; ?>'>
								<div class='news_comments_item_title'>
								<img width="28" height="28" src="/img/commentava.png"><a href=''><?=$oneotvet['name']; ?></a>, <span class="date_new_comment"><?=date('j.m.Y, H:i:s', intval($comments['date'])); ?></span>
								</div>
								<div class='news_comments_item_text'>
									<span class="block_text_comment"><?=$oneotvet['text']; ?></span><br>[<a href='#addcomment' onclick='$("#number-otvet").val(<?=$oneotvet['id']; ?>)'>Ответить</a>]<span>  [<font color="red" onclick="comminus(<?=$oneotvet['id']; ?>, <?=$newsid; ?>)">-</font>] </span>[

<?php
	$comrat = intval($oneotvet['rating']);
	if($comrat > 0) {
?>
	<font color="green"><?=$comrat; ?></font>
<?php
	} elseif ($comrat < 0) {
?>
	<font color="red"><?=$comrat; ?></font>
<?php
	} else {
?>
	<font><?=$comrat; ?></font>
<?php
	}
?>

									 ]<span> [<font color="green" onclick="complus(<?=$oneotvet['id']; ?>, <?=$newsid; ?>)">+</font>]</span>
									




								</div>
								<div class="news_comments_item_otvet">
									<?php
										$oneotvet_id = $oneotvet['id'];
										$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = '$oneotvet_id' ORDER BY id");
										if($db->NumRows() > 0) {
											$twootvet = $db->FetchArray();
											do {											
									?>
												<div class='news_comments_item' id='comment_<?=$twootvet['id']; ?>'>
													<div class='news_comments_item_title'>
													<img width="28" height="28" src="/img/commentava.png"><a href=''><?=$twootvet['name']; ?></a>, <span class="date_new_comment"><?=date('j.m.Y, H:i:s', intval($comments['date'])); ?></span>
													</div>
													<div class='news_comments_item_text'>
														<span class="block_text_comment"><?=$twootvet['text']; ?></span><br><span> [<font color="red" onclick="comminus(<?=$twootvet['id']; ?>, <?=$newsid; ?>)">-</font>] </span>[

<?php
	$comrat = intval($twootvet['rating']);
	if($comrat > 0) {
?>
	<font color="green"><?=$comrat; ?></font>
<?php
	} elseif ($comrat < 0) {
?>
	<font color="red"><?=$comrat; ?></font>
<?php
	} else {
?>
	<font><?=$comrat; ?></font>
<?php
	}
?>

														 ]<span> [<font color="green" onclick="complus(<?=$twootvet['id']; ?>, <?=$newsid; ?>)">+</font>]</span>
													</div>
												</div>
									<?php
												$twootvetid = $twootvet['id'];
												$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = '$oneotvet_id' AND id > '$twootvetid' ORDER BY id");
											} while ($twootvet = $db->FetchArray());
										}
									?>
								</div>
							</div>
							<?php
									$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = '$comment_id' AND id > '$oneotvet_id' ORDER BY id");
									} while($oneotvet = $db->FetchArray());
								}
							?>
						</div>
					</div>
					<?php
						$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = 0 AND id > '$comment_id'  ORDER BY id");
						} while ($comments = $db->FetchArray());
					} else {
						echo "Будьте первым, кто оставит комментарий!";
					}
					?>

<script>
	function comminus(id, newsid) {
	$.ajax({
        type: "POST",
        url: "/comrate.php",
        data: { minus: id, newsid: newsid },
        dataType: 'html',
        success: function(html){
          $(".news_comments_items").html(html);
        }
    });
}

function complus(id, newsid) {
	$.ajax({
        type: "POST",
        url: "/comrate.php",
        data: { plus: id, newsid: newsid },
        dataType: 'html',
        success: function(html){
          $(".news_comments_items").html(html);
        }
    });
}
</script>