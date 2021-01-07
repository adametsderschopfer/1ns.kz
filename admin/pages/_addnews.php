<main class="main">
  <section class="plate">
    <?php
    include('include/_menu.php');
    ?>
    <section class="wind news">
      <div class="container fg">

        <div class="blockText">
          <div class="newslist">
            <p>Название новости:<br>
              <input type="text" id="title">
            </p>
            <p>Категория:<br>
              <select id="category">
                <?php
                $db->query("SELECT * FROM news_cat WHERE id != 1 AND id != 2 AND id != 3 ORDER BY id");
                $category = $db->FetchArray();
                do {
                ?>
                  <option value="<?= $category['id']; ?>"> <?= $category['title']; ?></option>
                <?php

                } while ($category = $db->FetchArray());
                ?>

              </select>
            </p>
            <p>Изображение:<br>
              <input type="file" id="image">
            </p>

            <p>Ссылка на видео:<br>
              <input type="text" id="video">
            </p>

            <p>Отображать в слайдере:<br>
              <select id="slide">
                <option value="1">Да</option>
                <option selected value="0">Нет</option>
              </select>
            </p>

            <p id="slideblockdesc" style="display: none;">
              Описание в слайдере:<br>
              <textarea id="slideDesc" cols="30" rows="10"><?= $news['top_description']; ?></textarea>
            </p>

            <p>
              Описание новости:<br>
              <textarea id="desc" cols="30" rows="10"><?= $news['description']; ?></textarea>
            </p>

            <p>
              Полный текст:<br>
              <textarea id="text" cols="30" rows="10"><?= $news['text']; ?></textarea>
            </p>
            <input type="button" id="addnewsbutton" value="Отправить">
          </div>
        </div>
      </div>
    </section>
  </section>
</main>


<script type="text/javascript">
  (function($) {

    var files; // переменная. будет содержать данные файлов

    // заполняем переменную данными файлов, при изменении значения file поля
    $('#image').on('change', function() {
      files = this.files;
    });


    // обработка и отправка AJAX запроса при клике на кнопку upload_files
    $('#addnewsbutton').on('click', function(event) {

      event.stopPropagation(); // остановка всех текущих JS событий
      event.preventDefault(); // остановка дефолтного события для текущего элемента - клик для <a> тега

      // ничего не делаем если files пустой
      if (typeof files == 'undefined') return;

      // создадим данные файлов в подходящем для отправки формате
      var data = new FormData();
      $.each(files, function(key, value) {
        data.append(key, value);
      });

      // добавим переменную идентификатор запроса

      var title = $('#title').val();
      var desc = CKEDITOR.instances['desc'].getData();
      var text = CKEDITOR.instances['text'].getData();
      var slide = $('#slide').val();
      var slideDesc = CKEDITOR.instances['slideDesc'].getData();
      var category = $('#category').val();
      var video = $('#video').val();


      data.append('my_file_upload', 1);
      data.append('title', title);
      data.append('desc', desc);
      data.append('text', text);
      data.append('slide', slide);
      data.append('slideDesc', slideDesc);
      data.append('category', category);
      data.append('video', video);

      // AJAX запрос
      $.ajax({
        url: '/admin/lib/ajax.news.add.php',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        // отключаем обработку передаваемых данных, пусть передаются как есть
        processData: false,
        // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
        contentType: false,
        // функция успешного ответа сервера
        success: function(respond, status, jqXHR) {

          // ОК
          if (typeof respond.error === 'undefined') {
            // файлы загружены, делаем что-нибудь

            // покажем пути к загруженным файлам в блок '.ajax-reply'

            var files_path = respond.files;
            var html = '';
            $.each(files_path, function(key, val) {
              html += val + '<br>';
            })

            location.reload();
          }
          // error
          else {
            console.log('ОШИБКА: ' + respond.error);
          }
        },
        // функция ошибки ответа сервера
        error: function(jqXHR, status, errorThrown) {
          console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
        }

      });

    });


  })(jQuery)


  window.onload = function() {
    CKEDITOR.replace('slideDesc');
    CKEDITOR.replace('desc');
    CKEDITOR.replace('text');
  };

  $("#slide").change(function() {
    if ($("#slide").val() == 1) {
      $('#slideblockdesc').show();
    }

    if ($("#slide").val() == 0) {
      $('#slideblockdesc').hide();
    }
  });

  function deletenews(newsid) {
    $.ajax({
      url: "/admin/lib/ajax.news.delete.php",
      dataType: "html",
      data: {
        "newsid": newsid
      },
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