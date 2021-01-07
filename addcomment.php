<?php
	@session_start();

	@ob_start();

	function __autoload($name){ include('classes/_class.'.$name.'.php');}

	$config = new config;

	$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

	if(isset($_POST['otvet']) && $_POST['otvet'] != '') {
		$otvet = intval($_POST['otvet']);
	} else {
		$otvet = 0;
	}

	$newsid = $_POST['newsid'];


	if(isset($_POST['author']) && $_POST['author'] != '') {
		if(isset($_POST['email']) && $_POST['email'] != '') {
			if(isset($_POST['text']) && $_POST['text'] != '') {
				$author = $_POST['author'];
				$email = $_POST['email'];
				$text = $_POST['text'];
				
				$datetime = time();
				$phone = $_SESSION['phone'];

				$db->query("INSERT INTO news_comments (`news_id`, `comment_id`, `date`, `name`, `text`, `phone`, email) VALUES ('$newsid', '$otvet', '$datetime', '$author', '$text', '$phone', '$email')");
				$db->query("UPDATE news SET count = count + 1 WHERE id = '$newsid'");
				echo '<span align="center"><font color="green">Комментарий успешно оставлен!</font></span>';

			} else {
				echo '<span align="center"><font color="red">Ошибка, вы не ввели текст комментария!</font></span>';
			}

		} else {
			echo '<span align="center"><font color="red">Ошибка, вы не ввели Email!</font></span>';
		}
	} else {
		echo '<span align="center"><font color="red">Ошибка, вы не ввели свое имя!</font></span>';
	}

						$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = 0 ORDER BY id");
						$comments = $db->FetchArray();
						do{
					?>
					<div class='news_comments_item border_com' id="comment_<?=$comments['id']; ?>">
					<img width="28" height="28" src="/img/commentava.png"><div class='news_comments_item_title'>
							<a href=''><?=$comments['name']; ?></a>, <span class="date_new_comment"><?=date('j.m.Y, H:i:s', intval($comments['date'])); ?></span>
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
							<img width="28" height="28" src="/img/commentava.png"><div class='news_comments_item_title'>
									<a href=''><?=$oneotvet['name']; ?></a>, <span class="date_new_comment"><?=date('j.m.Y, H:i:s', intval($comments['date'])); ?></span>
								</div>
								<div class='news_comments_item_text'>
									<span class="block_text_comments"><?=$oneotvet['text']; ?></span><br> [<a href='#addcomment' onclick='$("#number-otvet").val(<?=$comments['id']; ?>)'>Ответить</a>] <span>  [<font color="red" onclick="comminus(<?=$comments['id']; ?>, <?=$newsid; ?>)">-</font>] </span>[

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
										$oneotvet_id = $oneotvet['id'];
										$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = '$oneotvet_id' ORDER BY id");
										if($db->NumRows() > 0) {
											$twootvet = $db->FetchArray();
											do {											
									?>
												<div class='news_comments_item' id='comment_<?=$twootvet['id']; ?>'>
												<img width="28" height="28" src="/img/commentava.png"><div class='news_comments_item_title'>
														<a href=''><?=$twootvet['name']; ?></a>, <span class="date_new_comment"><?=date('j.m.Y, H:i:s', intval($comments['date'])); ?></span>
													</div>
													<div class='news_comments_item_text'>
														<span class="block_text_comments"><?=$twootvet['text']; ?></span><br> [<a href='#addcomment' onclick='$("#number-otvet").val(<?=$comments['id']; ?>)'>Ответить</a>] <span>  [<font color="red" onclick="comminus(<?=$comments['id']; ?>, <?=$newsid; ?>)">-</font>] </span>[

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
					?>