<main class="main">
    <section class="plate">
        <?php 

          include('include/_menu.php'); 

          $kinoid = $_GET['id'];
          $db->query("SELECT * FROM kinoafish WHERE id = '$kinoid'");
          $kino = $db->FetchArray();
        ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <p>Название:<br>
                          <input type="text" id="title" value="<?=$kino['title']; ?>">
                        </p>
                        <p>
                        Описание:<br>
                        <textarea id="desc" cols="30" rows="10"><?=$kino['desc']; ?></textarea>
                      </p>
                        
                      <input type="button" onclick="refreshcats(<?=$kinoid; ?>)" value="Отправить">
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
  function refreshcats(kinoid) {
    var title = $('#title').val();
    var desc = CKEDITOR.instances['desc'].getData();
    

    var fd = new FormData;

    fd.append('title', title);
    fd.append('desc', desc)
    fd.append('kinoid', kinoid);


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.kino.edit.php",
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

  window.onload = function() {
    CKEDITOR.replace( 'desc' );
  };

</script>