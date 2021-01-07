<?php
if (isset($_GET['id']) && $_GET['id'] != '') {
	$newsid = $_GET['id'];
	$db->query("UPDATE news SET views = views + 1 WHERE id = '$newsid'");
} else {
	unset($newsid);
	echo "нету";
}
$db->query("SELECT * FROM news WHERE id = '$newsid'");
$news = $db->FetchArray();

$cat_id = $news['cat_id'];

$db->query("SELECT * FROM news_cat WHERE id = '$cat_id'");
$cats = $db->FetchArray();

?>

<div id="left-cont">
	<div id="top_bar">
		<ul>
			<li>
				<?php
				$db->query("SELECT * FROM ads WHERE cat_id = 1 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 1)");
				$ads = $db->FetchArray();

				?>
				<a href="<?= $ads['url']; ?>" target='_blank'><img style="width: 458px; height: 70px;" src="<?= $ads['img']; ?>"></a>
			</li>
			<li>
				<?php
				$db->query("SELECT * FROM ads WHERE cat_id = 6 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 1)");
				$ads = $db->FetchArray();

				?>
				<a href="<?= $ads['url']; ?>" target='_blank'><img style="width: 458px; height: 70px;" src="<?= $ads['img']; ?>"></a>

			</li>
		</ul>

	</div>
	<div id="show_news">
		<div class="title"><span>Новости - <?= $cats['title']; ?></span></div>
		<div class="content">
			<div class="date_news"> <?= date("d-m-Y, H:i:s", intval($news['date'])); ?></div>
			<h1><?= $news['title']; ?></h1>
			<p class="annot"><strong><?= $news['description']; ?></strong></p>


			<div class="text">
				<?php
				if ($news['video'] != '0' and $news['video'] != '') {
				?>
					<video style="width: 100%;" preload="none" controls="controls" poster="">
						<source src="<?= $news['video']; ?>" type="video/mp4">
					</video>
				<?php
				}
				?>

				<?= $news['text']; ?>
			</div>
			<br>
			<div class="form_commet" id="view_comments">Узнавайте новости первыми с нашим <a href="#" target="_blank" class="pod_menu_l">Telegram-каналом</a>. Будьте в курсе!</div>
			<div class='news_comments'>
				<div class='news_comments_title'>Комментарии:</div>
				<div class='news_comments_inotation'>
					Владельцы сайта не несут ответственности за содержание комментариев читателей. Вся ответственность за содержание комментариев возлагается на комментаторов.
				</div>
				<br>
				<div class='news_comments_content' id="refreshaddcom">

					<div class='news_comments_items' id="refresh_comments">
						<?php
						$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = 0 ORDER BY id");
						if ($db->NumRows() > 0) {
							$comments = $db->FetchArray();
							do {
						?>
								<div class='news_comments_item border_com' id="comment_<?= $comments['id']; ?>">
									<div class='news_comments_item_title'>
										<img width="28" height="28" src="/img/commentava.png"><a href="mailto:<?= $comments['email']; ?>"><?= $comments['name']; ?></a>, <span class="date_new_comment"><?= date('j.m.Y, H:i:s', intval($comments['date'])); ?></span>
									</div>
									<div class='news_comments_item_text'>
										<span class="block_text_comment"><?= $comments['text']; ?></span><br> [<a href='#addcomment' onclick='$("#number-otvet").val(<?= $comments['id']; ?>)'>Ответить</a>] <span> [<font color="red" onclick="comminus(<?= $comments['id']; ?>, <?= $newsid; ?>)">-</font>] </span>[

										<?php
										$comrat = intval($comments['rating']);
										if ($comrat > 0) {
										?>
											<font color="green"><?= $comrat; ?></font>
										<?php
										} elseif ($comrat < 0) {
										?>
											<font color="red"><?= $comrat; ?></font>
										<?php
										} else {
										?>
											<font><?= $comrat; ?></font>
										<?php
										}
										?>


										]<span> [<font color="green" onclick="complus(<?= $comments['id']; ?>, <?= $newsid; ?>)">+</font>]</span>
									</div>
									<div class="news_comments_item_otvet">
										<?php
										$comment_id = $comments['id'];
										$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = '$comment_id' ORDER BY id");

										if ($db->NumRows() > 0) {
											$oneotvet = $db->FetchArray();
											do {
										?>
												<div class='news_comments_item' id='comment_<?= $oneotvet['id']; ?>'>
													<div class='news_comments_item_title'>
														<img width="28" height="28" src="/img/commentava.png"><a href="mailto:<?= $oneotvet['email']; ?>"><?= $oneotvet['name']; ?></a>, <span class="date_new_comment"><?= date('j.m.Y, H:i:s', intval($oneotvet['date'])); ?></span>
													</div>
													<div class='news_comments_item_text'>
														<span class="block_text_comment"><?= $oneotvet['text']; ?></span><br>[<a href='#addcomment' onclick='$("#number-otvet").val(<?= $oneotvet['id']; ?>)'>Ответить</a>]<span> [<font color="red" onclick="comminus(<?= $oneotvet['id']; ?>, <?= $newsid; ?>)">-</font>] </span>[

														<?php
														$comrat = intval($oneotvet['rating']);
														if ($comrat > 0) {
														?>
															<font color="green"><?= $comrat; ?></font>
														<?php
														} elseif ($comrat < 0) {
														?>
															<font color="red"><?= $comrat; ?></font>
														<?php
														} else {
														?>
															<font><?= $comrat; ?></font>
														<?php
														}
														?>

														]<span> [<font color="Green" onclick="complus(<?= $oneotvet['id']; ?>, <?= $newsid; ?>)">+</font>] </span>





													</div>
													<div class="news_comments_item_otvet">
														<?php
														$oneotvet_id = $oneotvet['id'];
														$db->query("SELECT * FROM news_comments WHERE news_id = '$newsid' AND comment_id = '$oneotvet_id' ORDER BY id");
														if ($db->NumRows() > 0) {
															$twootvet = $db->FetchArray();
															do {
														?>
																<div class='news_comments_item' id='comment_<?= $twootvet['id']; ?>'>
																	<div class='news_comments_item_title'>
																		<img width="28" height="28" src="/img/commentava.png"><a href="mailto:<?= $twootvet['email']; ?>"><?= $twootvet['name']; ?></a>, <span class="date_new_comment"><?= date('j.m.Y, H:i:s', intval($twootvet['date'])); ?></span>
																	</div>
																	<div class='news_comments_item_text'>
																		<span class="block_text_comment"><?= $twootvet['text']; ?></span><br><span> [<font color="red" onclick="comminus(<?= $twootvet['id']; ?>, <?= $newsid; ?>)">-</font>] </span>[

																		<?php
																		$comrat = intval($twootvet['rating']);
																		if ($comrat > 0) {
																		?>
																			<font color="green"><?= $comrat; ?></font>
																		<?php
																		} elseif ($comrat < 0) {
																		?>
																			<font color="red"><?= $comrat; ?></font>
																		<?php
																		} else {
																		?>
																			<font><?= $comrat; ?></font>
																		<?php
																		}
																		?>

																		]<span> [<font color="Green" onclick="complus(<?= $twootvet['id']; ?>, <?= $newsid; ?>)">+</font>]</span>
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
											} while ($oneotvet = $db->FetchArray());
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
					</div>


				</div>

			</div>



			<?php
			if (isset($_SESSION['phone']) && $_SESSION['phone'] != '') {
			?>
				<div id="addcomment" class='add_news_comments'>
					<div class='add_news_comments_title'>Добавить комментарий:</div>
					<p>После добавления комментария ваш номер телефона, IP адрес и время активности на этой странице будут записаны в БД. Оставляя комментарий, вы соглашаетесь с тем, что можете быть привлечены к ответственности в соответствии с законодательством РК, а также даёте свое согласие на сбор и обработку ваших персональных данных. Если Вы не согласны с любым из этих пунктов, вы можете выйти, тем самым аннулируя это соглашение по вашим дальнейшим действиям. Спасибо за понимание.</p>
					<div class='add_news_comments_content'>

						<h4 class="text-author">Вы авторизированы на сайте с вашим номером телефона и можете писать комментарии. Ваш телефон не виден никому, кроме администратора сайта.</h4><a class="logout-button" href="/logout">Выход</a>
						<form id='form_comment' method='post'>
							<p>Ответ на комментарий №: <br><input id='number-otvet' type="text" name="otvet"></p>
							<p>Ваше имя: * <br><input type='text' name='author'></p>
							<p>Ваш Email: * <br><input type='text' name='email'></p>
							<p>Текст комментария: * <br><textarea rows="7" name='text'></textarea></p>
							<input type="hidden" value="<?= $newsid; ?>" name='newsid'>
						</form>
						<p> * Все поля обязательны к заполнению!</p>
						<a href="#refreshaddcom" id='send_comment'>Отправить комментарий</a>
					</div>
				</div>

			<?php
			} else {
			?>
				<div class="phone-verification">
					<div id="ver1" class="ver-message">
						Согласно закону об информатизации для написания комментариев необходимо пройти авторизацию на сайте. Для этого следует выполнить несколько простых действий.
						<br><br>
						<button id="verbut1">Начать</button>
					</div>
					<div id="ver2" class="ver-message" style="display: none;">
						<form id="verification" action="" method="POST">
							Введите ваш номер телефона:
							<br>
							<br>
							+7 <input type="text" name="phone">
							<br><br>
						</form>
						<button id="verbut2">Отправить</button>
					</div>
				</div>

				<script>
					$(document).ready(function() {
						$("#verbut1").click(
							function() {
								$("#ver2").show();
								$("#ver1").hide();
							}
						);

						$("#verbut2").click(
							function() {
								VerSendForm('ver2', 'ver3', 'verification');
								return false;
							}
						);


					});


					function VerSendForm(s1, s2, ajax_form) {
						$.ajax({
							url: "/phonever.php", //url страницы (action_ajax_form.php)
							type: "POST", //метод отправки
							dataType: "html", //формат данных
							data: $("#" + ajax_form).serialize(), // Сеарилизуем объект
							success: function(response) { //Данные отправлены успешно
								$(".phone-verification").html(response);
							},
							error: function(response) { // Данные не отправлены
								$(".phone-verification").html(response);
							}
						});
					}
				</script>

			<?php
			}
			?>


			<script>
				$("#send_comment").click(
					function() {
						sendform('ver2', 'ver3', 'verification');
						return false;
					}
				);


				function sendform(s1, s2, ajax_form) {
					$.ajax({
						url: "/addcomment.php", //url страницы (action_ajax_form.php)
						type: "POST", //метод отправки
						dataType: "html", //формат данных
						data: $("#form_comment").serialize(), // Сеарилизуем объект
						success: function(dateadd) { //Данные отправлены успешно
							$(".news_comments_items").html(dateadd);
						},
						error: function(dateadd) { // Данные не отправлены
							$(".news_comments_items").html(dateadd);
						}
					});
				}

				function comminus(id, newsid) {
					$.ajax({
						type: "POST",
						url: "/comrate.php",
						data: {
							minus: id,
							newsid: newsid
						},
						dataType: 'html',
						success: function(html) {
							$(".news_comments_items").html(html);
						}
					});
				}

				function complus(id, newsid) {
					$.ajax({
						type: "POST",
						url: "/comrate.php",
						data: {
							plus: id,
							newsid: newsid
						},
						dataType: 'html',
						success: function(html) {
							$(".news_comments_items").html(html);
						}
					});
				}
			</script>

		</div>
	</div>
</div>