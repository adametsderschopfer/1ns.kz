<main class="main">
    <section class="plate">
        <?php 

          include('include/_menu.php'); 

          $newsid = $_GET['id'];
          $db->query("SELECT * FROM news WHERE id = '$newsid'");
          $news = $db->FetchArray();

          $catid = $news['cat_id'];
        ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <p>Название новости:<br>
                          <input type="text" id="title" value="<?=$news['title']; ?>">
                        </p>
                        <p>Категория:<br>
                          <select id="category">
                            <?php
                              $db->query("SELECT * FROM news_cat WHERE id != 1 AND id != 2 AND id != 3 ORDER BY id");
                              $category = $db->FetchArray();
                              do {
                                if($category['id'] == $catid) {
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

                        <p>Ссылка на видео:<br>
                          <input type="text" id="title" value="<?=$news['video']; ?>">
                        </p>
                       
                        <p>Отображать в слайдере:<br>
                        <select id="slide">
                          <?php
                            if($news['top'] == 1) {
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
                      <?php
                        if($news['top'] == 1) {
                      ?>
                          <p id="slideblockdesc">
                      <?php
                        } else {
                      ?>
                        <p id="slideblockdesc" style="display: none;">
                      <?php
                        }
                      ?>
                        Описание в слайдере:<br>
                        <textarea id="slideDesc" cols="30" rows="10"><?=$news['top_description']; ?></textarea>
                      </p>

                      <p>
                        Описание новости:<br>
                        <textarea id="desc" cols="30" rows="10"><?=$news['description']; ?></textarea>
                      </p>

                      <p>
                        Полный текст:<br>
                        <textarea id="text" cols="30" rows="10"><?=$news['text']; ?></textarea>
                      </p>
                      <input type="button" onclick="refreshnews(<?=$newsid; ?>)" value="Отправить">
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
  function refreshnews(newsid) {
    var title = $('#title').val();
    var desc = CKEDITOR.instances['desc'].getData();
    var text = CKEDITOR.instances['text'].getData();
    var slide = $('#slide').val();
    var slideDesc = CKEDITOR.instances['slideDesc'].getData();
    var category = $('#category').val();

    var fd = new FormData;

    fd.append('title', title);
    fd.append('desc', desc);
    fd.append('text', text);
    fd.append('slide', slide);
    fd.append('slideDesc', slideDesc);
    fd.append('newsid', newsid);
    fd.append('category', category);


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.news.edit.php",
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
    CKEDITOR.replace( 'slideDesc' );
    CKEDITOR.replace( 'desc' );
    CKEDITOR.replace( 'text' );
  };

  $( "#slide" ).change(function() {
    if($("#slide").val() == 1) {
      $('#slideblockdesc').show();
    }

    if($("#slide").val() == 0) {
      $('#slideblockdesc').hide();
    }
  });
</script>