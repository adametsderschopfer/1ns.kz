<?php
if (isset($_POST['change_avatar'])) {
  $date = date("Y-m-d");
  $date_post = date("Y-m-d, H:i:s");
  mkdir('../img/avatars/' . $date . '/', 0777);
  $target_dir = 'img/avatars/' . $date . '/';
  $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
  $uploadOk = 1;
  $type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["avatar"]["tmp_name"]);

  if ($check !== false) {
    if (file_exists($target_file)) {
      echo "Выбранный файл уже существует.";
      $uploadOk = 0;
    } else {
      if ($_FILES["avatar"]["size"] > 500000) {
        echo "Извините, размер файла слишком велик.";
        $uploadOk = 0;
      } else {
        if ($type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif") {
          echo "Поддерживаемые форматы изображения: .jpg, .jpeg, .gif, .png .";
          $uploadOk = 0;
        } else {
          if ($type == 'jpg' || $type == 'jpeg') {
            $newnameimg = time() . '.jpg';
            $target_file = $target_dir . basename($newnameimg);
          } elseif ($type == 'png') {
            $newnameimg = time() . '.png';
            $target_file = $target_dir . basename($newnameimg);
          } elseif ($type == 'gif') {
            $newnameimg = time() . '.gif';
            $target_file = $target_dir . basename($newnameimg);
          }

          if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $ava = '/' . $target_file;
            $db->query("UPDATE users SET `avatar` = '$ava' WHERE id = '$userid'");
            header("LOCATION: /account/");
            exit();
          } else {
            echo "Извините, произошла ошибка, попробуйте позже.";
          }
        }
      }
    }
  } else {
    echo "Файл не является картинкой.";
    $uploadOk = 0;
  }
}

?>
<div id="left-cont">
  <div id="show_news">
    <div class="title"><span>Личный кабинет</span></div>
    <div class="content">
      <div class="top_account">
        <ul>
          <li><a href="/account/myannounce">Мои объявления</a></li>
          <li><a href="/account/mycompanies">Мои компании</a></li>
          <li><a href="/account/myannounce">Верификация</a></li>
          <li><a href="/account/myannounce">Безопасность аккаунта</a></li>
        </ul>
      </div>

      <div class="info_account">
        <div class="title_info_account"><strong>Данные:</strong></div>
        <div class="content_account">
          <div class="content_info_account">
            <p><b>Дата регистрации:</b> <span>17.10.2019, 16:54</span></p>
            <p><b>Последний вход:</b> <span>17.10.2019, 22:10</span></p>
            <p><b>Сообщений на форуме:</b> <span><a href='/account/mytopics'>15</a></span></p>
            <p><b>Новых сообщений:</b> <span><a href='/account/mymessages'>0</a></span></p>
            <p><b>Объявлений поддано:</b> <span><a href='/account/myannounce'>3</a></span></p>
            <p><b>Объявлений в избранном:</b> <span><a href='/account/myfavannounce'>3</a></span></p>
            <p><b>Компаний поддано:</b> <span><a href='/account/mycompanies'>3</a></span></p>
            <p><b>Компаний в избранном:</b> <span><a href='/account/myfavcompanies'>3</a></span></p>
            <p><b><a href='/account/myfavcompanies'>Написать сообщение</a></b> <span><a href='/account/myfavcompanies'><b>Входящие</b></a></span></p>
          </div>
          <div class="content_info_account">
            <p><b>Ваш логин:</b><br><input type="text" name="login" value="<?= $user['login']; ?>"></p>
            <p><b>Ваш Аватар:</b><br>
              <div class="account_avatar">
                <img src="<?= $user['avatar']; ?>" alt="">
              </div>
              <form action="/account" method="post" enctype="multipart/form-data">
                <input type="file" name="avatar" value="">
                <input type="submit" name="change_avatar" value="Изменить">
              </form>
          </div>
        </div>
      </div>



    </div>
  </div>
</div>