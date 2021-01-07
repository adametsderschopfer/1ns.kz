<main class="main">
    <section class="plate">
        <?php 

          include('include/_menu.php'); 

          $catid = $_GET['id'];
          $db->query("SELECT * FROM companyes_cat WHERE id = '$catid'");
          $cat = $db->FetchArray();
        ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <p>Название категории:<br>
                          <input type="text" id="title" value="<?=$cat['title']; ?>">
                        </p>
                        
                      <input type="button" onclick="refreshcats(<?=$catid; ?>)" value="Отправить">
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
  function refreshcats(catid) {
    var title = $('#title').val();
    

    var fd = new FormData;

    fd.append('title', title);
    fd.append('catid', catid);


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.comcats.edit.php",
     data: fd,
     type: "POST",
     success: function() {
        location.reload();
     },
     error: function() {
        location.reload();
     }
    });
  }



</script>