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
                        
                      <input type="button" onclick="refreshcats()" value="Отправить">
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
  function refreshcats() {
    var title = $('#title').val();
    

    var fd = new FormData;

    fd.append('title', title);


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.comcats.add.php",
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