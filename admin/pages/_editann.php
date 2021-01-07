<main class="main">
    <section class="plate">
        <?php 

          include('include/_menu.php'); 

            if(isset($_GET['id']) && $_GET['id'] != '') {
                $annid = $_GET['id'];

                $db->query("SELECT * FROM announce WHERE id = '$annid'");
                $ann = $db->FetchArray();
            }

        ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <p>Категория:<br>
                          <select id="category">
                              <?php
                                $db->query("SELECT * FROM announce_cat ORDER BY id");
                                $category = $db->FetchArray();

                                do{
                                  if($category['id'] == $ann['cat_id']) {
                            ?>
                                    <option selected value="<?=$category['id']; ?>"><?=$category['title']; ?></option>
                            <?php
                                  } else {
                            ?>
                                    <option value="<?=$category['id']; ?>"><?=$category['title']; ?></option>
                            <?php
                                  }
                            ?>
                                    
                            <?php
                                } while($category = $db->FetchArray());
                              ?>
                          </select>
                        </p>
                        <p>Текст объявления:<br>
                            <textarea id="text" cols="30" rows="10"><?=$ann['text']; ?></textarea>
                        </p>
                        <p>Стоимость:<br>
                          <input type="text" id="price" value="<?=$ann['price']; ?>">
                        </p>
                        <p>Контактный телефон:<br>
                          <input type="text" id="phone" value="<?=$ann['phone']; ?>">
                        </p>
                      <input type="button" onclick="refreshann(<?=$annid; ?>)" value="Отправить">
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
  function refreshann(annid) {
    var category = $('#category').val();
    var phone = $('#phone').val();
    var price = $('#price').val();
    var text = CKEDITOR.instances['text'].getData();
    

    var fd = new FormData;

    fd.append('category', category);
    fd.append('phone', phone);
    fd.append('price', price);
    fd.append('text', text);
    fd.append('annid', annid);


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.ann.edit.php",
     data: fd,
     type: "POST",
     success: function(html) {
        location.reload();
     },
     error: function() {
        location.reload();
     }
    });
  }

  window.onload = function() {
    CKEDITOR.replace( 'text' );
  };

</script>