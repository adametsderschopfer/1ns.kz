<main class="main">
    <section class="plate">
        <?php 
          include('include/_menu.php'); 

          if(isset($_GET['id']) && $_GET['id'] != '') {
            $comid = $_GET['id'];

            $db->query("SELECT * FROM companyes WHERE id = '$comid'");
            $com = $db->FetchArray();
          } 
        ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <p>Наименование компании:<br>
                          <input type="text" id="title" value="<?=$com['title']; ?>">
                        </p>
                        <p>Категория:<br>
                          <select id="category">
                            <?php
                              $db->query("SELECT * FROM companyes_cat ORDER BY id");
                              $category = $db->FetchArray();
                              do {
                                if($com['cat_id'] == $category['id']) {
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
                       
                        <p>Рекомендация:<br>
                        <select id="top">
                                <?php
                                    if($com['top'] == 1) {
                                ?>
                                        <option selected value="1">Да</option>
                                        <option value="0">Нет</option>
                                <?php
                                        
                                    } else {
                                ?>
                                        <option value="1">Да</option>
                                        <option selected value="0">Нет</option>
                                <?php
                                    }
                              ?>
                        </select>
                      </p>

                      <p>
                        Описание:<br>
                        <textarea id="desc" cols="30" rows="10"><?=$com['descr']; ?></textarea>
                      </p>

                      <p>
                        Полный текст:<br>
                        <textarea id="text" cols="30" rows="10"><?=$com['text']; ?></textarea>
                      </p>
                      <input type="button" onclick="refreshcom(<?=$comid; ?>);" value="Отправить">
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
function refreshcom(comid) {
    var title = $('#title').val();
    var desc = CKEDITOR.instances['desc'].getData();
    var text = CKEDITOR.instances['text'].getData();
    var top = $('#top').val();
    var category = $('#category').val();

    var fd = new FormData;

    fd.append('title', title);
    fd.append('desc', desc);
    fd.append('text', text);
    fd.append('top', top);
    fd.append('comid', comid);
    fd.append('category', category);


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.com.edit.php",
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
    CKEDITOR.replace( 'text' );
  };
  
</script>