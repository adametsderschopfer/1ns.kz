<main class="main">
    <section class="plate">
        <?php include('include/_menu.php'); ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="news-categories">
                      <div class="title">Список категорий</div>
                      <ul style="padding: 0;">
                        <?php
                          $db->query("SELECT * FROM companyes_cat  ORDER BY id");
                          $cat = $db->FetchArray();

                          do{
                        ?>
                        <li style="border: 1px solid #ccc; padding: 15px; width: 100%; height: 20px;"><a style="float: left; line-height: 0px;" href="/admin/editcomcat/<?=$cat['id']; ?>"><?=$cat['title']; ?></a><a href="javascript:void(0);" onclick="deletecat(<?=$cat['id']; ?>);" style="float: right; line-height: 0px;"><font color="red">Удалить</font></a></li>
                        <?php
                          } while($cat = $db->FetchArray());
                        ?>
                        <li style="border: 1px solid #ccc; padding: 15px; width: 100%; height: 20px;"><a style="float: left; color: green; font-weight: bold;  line-height: 0px;" href="/admin/addcomcat">Добавить категорию</a></li>
                      </ul>
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
	function deletecat(catsid) {
		$.ajax({
			url: "/admin/lib/ajax.comcats.delete.php",
			dataType: "html",
			data: {"catsid": catsid},
			method: "POST",
			success: function(html) {
				location.reload();
			},
			error: function(html) {
				location.reload();
			}
		});
	}
</script>