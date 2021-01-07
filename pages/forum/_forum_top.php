
<div id="authoriz">
	
    <?php
      if(isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
        $userid = $_SESSION['userid'];
        $db->query("SELECT * FROM users WHERE id = '$userid'");
        $user = $db->FetchArray();
?>
	<div class="author-login">
		Вы зашли как, <a href='/account/'><?=$user['login']; ?></a>
		<a href='/logout/'>Выйти</a>
	</div>
<?php

      } else {
    ?>
    <form action="/login/" method="POST">
      Логин:<input name="login" type="text" >
      Пароль:<input name="password" type="password" >

      <input type="submit" value="Войти">
      <a href="/signup/">Регистрация</a>
    </form>

    <?
      }

    ?>

  </div>

<div class="forum_message">Ознакомьтесь с <a href=''>информацией</a> для новичков форума. Рекомендуется к обязательному прочтению.</div>

