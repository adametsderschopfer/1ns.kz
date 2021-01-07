<?php
  if(isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
    header("LOCATION: /");
    exit();
  }


  if(isset($_POST['login'])) {
    if(isset($_POST['login']) && $_POST['login'] != '') {
      $login = $_POST['login'];
      $login = trim($login);
      $login = htmlspecialchars($login);
      if(isset($_POST['password']) && $_POST['password'] != '') {
        $password = $_POST['password'];
        $password = trim($password);
        $password = htmlspecialchars($password);
        $password = md5($password);

        if(isset($_POST['password2']) && $_POST['password2'] != '') {
          $password2 = $_POST['password2'];
          $password2 = trim($password2);
          $password2 = htmlspecialchars($password2);
          $password2 = md5($password2);

          if($password == $password2) {
            if(isset($_POST['email']) && $_POST['email'] != '') {
              $email = $_POST['email'];
              $email = trim($email);
              $email = htmlspecialchars($email);
              if(isset($_POST['phone']) && $_POST['phone'] != '') {
                $phone = $_POST['phone'];
                $avatar = '/img/noavatar.png';
                $db->query("INSERT INTO users (`login`, `password`, `email`, `avatar`, `phone`) VALUES ('$login','$password','$email','$avatar','$phone')");
                header("LOCATION: /login/succes");
                exit();
              } else {
                $error = 'Вы не ввели номер телефона!';
              }
            } else {
              $error = 'Вы не ввели E-mail!';
            }
          } else {
            $error = 'Пароли не совпадают!';
          }
        } else {
          $error = 'Вы не повторили Ваш пароль!';
        }
      } else {
        $error = 'Вы не ввели Пароль!';
      }
    } else {
      $error = 'Вы не ввели Логин!';
    }
  }
?>
<div id="left-cont">
  <div id="signup">
    <div class="title">
      <span>Регистрация</span>
    </div>
    <div class="content">
      <span style="color: red;"><?=$error; ?></span>
      <form action="/signup/" method="POST">
        <p>Логин:<br>
        <input type="text" name="login"></p>
        <p>Пароль:<br>
        <input type="password" name="password"></p>
        <p>Повторите пароль:<br>
        <input type="password" name="password2"></p>
        <p>E-mail:<br>
        <input type="email" name="email"></p>
        <p>Номер телефона:<br>
        <input type="text" id="phone" name="phone"></p>

        <input type="submit" value="Отправить">
      </form>


      <script>
      </script>
    </div>
  </div>
</div>
