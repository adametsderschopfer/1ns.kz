<main class="main">
    <section class="plate">
        <?php 

          include('include/_menu.php'); 

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
                            ?>
                                    <option value="<?=$category['id']; ?>"><?=$category['title']; ?></option>
                            <?php
                                } while($category = $db->FetchArray());
                              ?>
                          </select>
                        </p>
                        <p>Фото:<br>
                          <input type="file" id="image">
                        </p>
                        <p>Текст объявления:<br>
                            <textarea id="text" cols="30" rows="10"></textarea>
                        </p>
                        <p>Стоимость:<br>
                          <input type="text" id="price" >
                        </p>
                        <p>Контактный телефон:<br>
                          <input type="text" id="phone" >
                        </p>
                      <input type="button" id='addannbutton' value="Отправить">
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
(function($){

var files; // переменная. будет содержать данные файлов

// заполняем переменную данными файлов, при изменении значения file поля
$('#image').on('change', function(){
    files = this.files;
});


// обработка и отправка AJAX запроса при клике на кнопку upload_files
$('#addannbutton').on( 'click', function( event ){

event.stopPropagation(); // остановка всех текущих JS событий
    event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

    // ничего не делаем если files пустой

    var image = $("#image").val();

    var data = new FormData();

    if(image == '') {
      var valimg = '1';
      data.append('image', valimg);
    } else {
      $.each( files, function( key, value ){
        data.append( key, value );
      });
    }

    // добавим переменную идентификатор запроса

    var category = $('#category').val();
     var price = $('#price').val();
     var phone = $('#phone').val();
    var text = CKEDITOR.instances['text'].getData();


    data.append( 'my_file_upload', 1 );
    data.append('category', category);
    data.append('phone', phone);
    data.append('price', price);
    data.append('text', text);

    // AJAX запрос
    $.ajax({
        url         : '/admin/lib/ajax.ann.add.php',
        type        : 'POST',
        data        : data,
        cache       : false,
        dataType    : 'html',
        // отключаем обработку передаваемых данных, пусть передаются как есть
        processData : false,
        // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
        contentType : false,
        // функция успешного ответа сервера
        success     : function( respond, status, jqXHR ){

          location.reload();
        },
        // функция ошибки ответа сервера
        error: function( jqXHR, status, errorThrown ){
            console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
        }

    });

});


})(jQuery)


  window.onload = function() {
    CKEDITOR.replace( 'text' );
  };



  
</script>



