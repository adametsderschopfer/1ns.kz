<main class="main">
    <section class="plate">
        <?php 

          include('include/_menu.php'); 

        ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <p>Название категории:<br>
                          <input type="text" id="title" >
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


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.cats.add.php",
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