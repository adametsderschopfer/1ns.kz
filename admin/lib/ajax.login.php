<?php
@session_start();

@ob_start();

function __autoload($name)
{
    include('../classes/_class.' . $name . '.php');
}

$err_message = "";
$login_successful = false;

$config = new config;

$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);

if (isset($_POST['login']) && $_POST['login'] != '') {
    if (isset($_POST['password']) && $_POST['password'] != '') {
        $login = trim($_POST['login']);
        $password = md5($_POST['password']);

        $db->query("SELECT * FROM admin WHERE login = '$login'");
        if ($db->NumRows() > 0) {
            $logindb = $db->FetchArray();
            $password2 = $logindb['pass'];
            if ($password == $password2) {
                $_SESSION['adminid'] = $logindb['id'];
                $time = time();
                $db->query("UPDATE admin SET last_login = '$time'");

                $login_successful = true;
                $err_message = "Вы успешно авторизированы!";
            } else {
                $err_message = "Пароль не верный!";
            }
        } else {
            $err_message = "Данного пользователя не существует!";
        }
    } else {
        $err_message = "Вы не ввели пароль!";
    }
} else {
    $err_message = "Вы не ввели логин!";
}
?>

<form>
    <?php
    if (strlen($err_message) > 0) {
    ?>
        <span>
            <font color="<?= $login_successful == true ? "green" : "red" ?>"><?= $err_message ?></font>
        </span>
    <?php
    }
    ?>

    <input id="inputlogin" type="login" class="auth_data brs1" placeholder="Имя пользователя">
    <input id="inputpassword" type="password" class="auth_data brs2" placeholder="Пароль">
    <button type="button" id="signin-button" class="signin">Войти</button>

    <?php
    if ($login_successful == true) {
    ?>
        <script type="text/javascript">
            setTimeout(() => location.reload(), 1000);
        </script>
    <?php
    }
    ?>
</form>

<script>
    $('#signin-button').click(function() {
        var login = $('#inputlogin').val();
        var password = $('#inputpassword').val();

        $.ajax({
            url: "/admin/lib/ajax.login.php",
            method: "POST",
            dataType: "html",
            data: {
                "login": login,
                "password": password
            },
            success: function(html) {
                $('#block_auth').html(html);
            },
            error: function(html) {
                $('#block_auth').html(html);
            }
        });
    });
</script>