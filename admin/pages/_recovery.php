

<main class="main">
    <section class="plate">
        <?php include('include/_menu.php'); ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                      <p>Введите новый пароль:<br>
                        <input type="text" id="newpass">
                      </p>
                      <p>
                        <input type="button" value="Сменить" onclick="newpass();">
                      </p>
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
	function newpass() {
    var pass = $('#newpass').val();
		$.ajax({
			url: "/admin/lib/ajax.newpass.php",
			dataType: "html",
			data: {"pass": pass},
			method: "POST",
			success: function(html) {
				$('.newslist').html(html);
			},
			error: function(html) {
				location.reload();
			}
		});
	}
</script>