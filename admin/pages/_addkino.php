<main class="main">
    <section class="plate">
        <?php 
          include('include/_menu.php'); 
        ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <p>Название:<br>
                          <input type="text" id="title">
                        </p>
                        
                        <p>Изображение:<br>
                          <input type="file" id="image">
                        </p>
                       
                       

                        <p>
                        Описание:<br>
                        <textarea id="desc" cols="30" rows="10"></textarea>
                      </p>
                      <input type="button" id="addcombutton" value="Отправить">
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
$('#addcombutton').on( 'click', function( event ){

    event.stopPropagation(); // остановка всех текущих JS событий
    event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

    // ничего не делаем если files пустой
    if( typeof files == 'undefined' ) return;

    // создадим данные файлов в подходящем для отправки формате
    var data = new FormData();
    $.each( files, function( key, value ){
        data.append( key, value );
    });

    // добавим переменную идентификатор запроса

    var title = $('#title').val();
    var desc = CKEDITOR.instances['desc'].getData();


    data.append( 'my_file_upload', 1 );
    data.append('title', title);
    data.append('desc', desc);

    // AJAX запрос
    $.ajax({
        url         : '/admin/lib/ajax.kino.add.php',
        type        : 'POST',
        data        : data,
        cache       : false,
        dataType    : 'json',
        // отключаем обработку передаваемых данных, пусть передаются как есть
        processData : false,
        // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
        contentType : false,
        // функция успешного ответа сервера
        success     : function( respond, status, jqXHR ){

            // ОК
            if( typeof respond.error === 'undefined' ){
                // файлы загружены, делаем что-нибудь

                // покажем пути к загруженным файлам в блок '.ajax-reply'

                var files_path = respond.files;
                var html = '';
                $.each( files_path, function( key, val ){
                     html += val +'<br>';
                } )

                location.reload();
            }
            // error
            else {
                console.log('ОШИБКА: ' + respond.error );
            }
        },
        // функция ошибки ответа сервера
        error: function( jqXHR, status, errorThrown ){
            console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
        }

    });

});


})(jQuery)


  window.onload = function() {
    CKEDITOR.replace( 'desc' );
  };



  
</script>