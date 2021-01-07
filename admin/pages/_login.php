<?php
    if(isset($_SESSION['adminid']) && $_SESSION['adminid'] != '') {
        header("LOCATION: /");
        exit();
    } 
?>
    <main class="main">
        <div class="container form_auth">
            <h1 class="title_auth">Добро пожаловать, <br> Admin!</h1>
            <section id="block_auth" class="block_auth">
                <form>
                    <input id="inputlogin" type="login" class="auth_data brs1" placeholder="Имя пользователя">
                    <input id="inputpassword" type="password" class="auth_data brs2" placeholder="Пароль">
                    <button type="button" id="signin-button" class="signin">Войти</button>
                </form>
            </section>
        </div>
    </main>

<script>
    $('#signin-button').click(function(){
        var login = $('#inputlogin').val();
        var password = $('#inputpassword').val();

        $.ajax({
            url: "/admin/lib/ajax.login.php",
            method: "POST",
            dataType: "html",
            data: {"login": login, "password": password},
            success: function(html) {
                $('#block_auth').html(html);
            },
            error: function(html) {
                $('#block_auth').html(html);
            }
        });
    });
</script>










