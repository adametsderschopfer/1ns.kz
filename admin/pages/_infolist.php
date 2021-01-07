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
                                $db->query("SELECT * FROM coms");
                                $posts = $db->NumRows();
                                $total = intval(($posts - 1) / $num) + 1;
                                $page = intval($page);
                                if(empty($page) or $page < 0) $page = 1;
                                if($page > $total) $page = $total;
                                $start = $page * $num - $num;
                                $db->query("SELECT * FROM coms ORDER BY id DESC LIMIT $start, $num");
                                $annlist = $db->FetchArray();
                                do{
                                	$annid = $annlist['id'];
                            ?>
                            <div class="item">
                                <div class="info-news"><?=$annlist['title']; ?></div>
                                <div class="info-text"><?=$annlist['des']; ?></div>
                                <div class="panel-news">
                                  <a href="javascript:void(0)" onclick="deleteann(<?=$annlist['id']; ?>)"><font color="red"> Удалить</font></a></div>
                            </div>

                            <?php
                                } while($annlist = $db->FetchArray());
                                
                            ?>

                            <div class="nav_pages">
<?php
  if($page != 1) {
?>
  <a href="/admin/infolist/1"><<</a>
  <a href="/admin/infolist/<?=$page - 1; ?>"><</a>
<?php
  }

  if($page - 2 > 0) {
?>
  <a href="/admin/infolist/<?=$page - 2; ?>"><?=$page - 2; ?></a>

<?php
  }
   if($page - 1 > 0) {
?>
  <a href="/admin/infolist/<?=$page - 1; ?>"><?=$page - 1; ?></a>

<?php
  }

  echo "<b>$page</b>";

  
   if($page + 1 <= $total) {
?>
  <a href="/admin/infolist/<?=$page + 1; ?>"><?=$page + 1; ?></a>

<?php
  }
  if($page + 2 <= $total) {
?>
  <a href="/admin/infolist/<?=$page + 2; ?>"><?=$page + 2; ?></a>

<?php
  }

  if($page != $total) {
?>
  <a href="/admin/infolist/<?=$page + 1; ?>">></a>
  <a href="/admin/infolist/<?=$total; ?>">>>></a>
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
	function deleteann(comid) {
		$.ajax({
			url: "/admin/lib/ajax.comm.delete.php",
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