<main class="main">
    <section class="plate">
        <?php 

          include('include/_menu.php'); 

          $adsid = $_GET['id'];
          $db->query("SELECT * FROM ads WHERE id = '$adsid'");
          $ads = $db->FetchArray();
        ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <p>Название категории:<br>
                          <input type="text" id="title" value="<?=$ads['title']; ?>">
                        </p>
                        <p>Категория:<br>
                          <select id="category">
                            <?php
                              $db->query("SELECT * FROM ads_cat ORDER BY id");
                              $category = $db->FetchArray();
                              do {
                                if($ads['cat_id'] == $category['id']) {
                            ?>
                                    <option selected value="<?=$category['id']; ?>"><?=$category['title']; ?></option>
                            <?php
                                } else {
                            ?>
                                <option value="<?=$category['id']; ?>"><?=$category['title']; ?></option>
                            <?php
                                }
                              } while ($category = $db->FetchArray());
                            ?>
                            
                          </select>
                        </p>
                        <p>Ссылка:<br>
                          <input type="text" id="url" value="<?=$ads['url']; ?>">
                        </p>
                      <input type="button" onclick="refreshcats(<?=$adsid; ?>)" value="Отправить">
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
  function refreshcats(adsid) {
    var title = $('#title').val();
    var category = $('#category').val();
    var url = $('#url').val();
    

    var fd = new FormData;

    fd.append('title', title);
    fd.append('category', category);
    fd.append('url', url);
    fd.append('adsid', adsid);


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.ads.edit.php",
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