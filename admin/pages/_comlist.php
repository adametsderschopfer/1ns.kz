<main class="main">
    <section class="plate">
        <?php include('include/_menu.php'); ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <div class="items">
                            <?php
                                $page = $_GET['pages'];
                                $num = 10;
                                $db->query("SELECT * FROM companyes");
                                $posts = $db->NumRows();
                                $total = intval(($posts - 1) / $num) + 1;
                                $page = intval($page);
                                if(empty($page) or $page < 0) $page = 1;
                                if($page > $total) $page = $total;
                                $start = $page * $num - $num;
                                $db->query("SELECT * FROM companyes ORDER BY id DESC LIMIT $start, $num");
                                $comlist = $db->FetchArray();
                                do{
                                	$comid = $comlist['id'];
                            ?>
                            <div class="item">
                                <div class="title-news">
                                    <span><a href="/admin/editcom/<?=$comlist['id']; ?>"><?=$comlist['title']; ?></a> </span>
                                </div>
                                <div class="info-news"><?=$comlist['descr']; ?></div>
                                <div class="panel-news"><a href="/admin/editcom/<?=$comlist['id']; ?>">Редактировать </a><a href="javascript:void(0)" onclick="deletecom(<?=$comlist['id']; ?>)"><font color="red"> Удалить</font></a></div>
                            </div>

                            <?php
                                } while($comlist = $db->FetchArray());
                                
                            ?>

                            <div class="nav_pages">
<?php
  if($page != 1) {
?>
  <a href="/admin/comlist/1"><<</a>
  <a href="/admin/comlist/<?=$page - 1; ?>"><</a>
<?php
  }

  if($page - 2 > 0) {
?>
  <a href="/admin/comlist/<?=$page - 2; ?>"><?=$page - 2; ?></a>

<?php
  }
   if($page - 1 > 0) {
?>
  <a href="/admin/comlist/<?=$page - 1; ?>"><?=$page - 1; ?></a>

<?php
  }

  echo "<b>$page</b>";

  
   if($page + 1 <= $total) {
?>
  <a href="/admin/comlist/<?=$page + 1; ?>"><?=$page + 1; ?></a>

<?php
  }
  if($page + 2 <= $total) {
?>
  <a href="/admin/comlist/<?=$page + 2; ?>"><?=$page + 2; ?></a>

<?php
  }

  if($page != $total) {
?>
  <a href="/admin/comlist/<?=$page + 1; ?>">></a>
  <a href="/admin/comlist/<?=$total; ?>">>>></a>
<?php
  }



?>

        </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
	function deletecom(comid) {
		$.ajax({
			url: "/admin/lib/ajax.com.delete.php",
			dataType: "html",
			data: {"comid": comid},
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