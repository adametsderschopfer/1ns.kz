<?php
  if(isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
    header("LOCATION: /");
    exit();
  } 

  if(isset($_POST['login'])) {
    if (isset($_POST['login']) && $_POST['login'] != '') {
      $login = $_POST['login'];
      $login = trim($login);
      $login = htmlspecialchars($login);
      if(isset($_POST['password']) && $_POST['password'] != '') {
        $password = $_POST['password'];
        $password = trim($password);
        $password = htmlspecialchars($password);
        $password = md5($password);

        $db->query("SELECT * FROM users WHERE login = '$login' LIMIT 1");
        if($db->NumRows() == 1) {
          $user = $db->FetchArray();
          $userpass = $user['password'];
          

          if($password == $userpass) {
            $userid = $user['id'];
            $_SESSION['userid'] = $userid;
            header("LOCATION: /forum/");
            exit();
          } else {
            $error = 'Вы ввели неверный пароль!';
          }

        } else {
          $error = 'Данный пользователь не существует!';
        }
      } else {
        $error = 'Вы не ввели Пароль';
      }

    } else {
      $error = 'Вы не ввели Логин';
    }
  }

 
?>
<div id="left-cont">
  <div id="signup">
    <div class="title">
      <span>Авторизация</span> 
    </div>
    <div class="content">
      <?php
        if(isset($_GET['succes']) && $_GET['succes'] == 'true') {
          header("LOCATION: /forum/");
          exit();   
        }
      ?>
      <span style="color: red;"><?=$error; ?></span>
      <form action="/login/" method="POST">
        <p>Логин:<br>
        <input type="text" name="login"></p>
        <p>Пароль:<br>
        <input type="password" name="password"></p>
        
       
        <input type="submit" value="Войти">
      </form>
    </div>
  </div>
</div>









