<div id="left-cont">
  <div id="top_bar">
    <ul>
      <li>
        <?php
        $db->query("SELECT * FROM ads WHERE cat_id = 1 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 1)");
        $ads = $db->FetchArray();

        ?>
        <a href="<?= $ads['url']; ?>" target='_blank'><img style="width: 458px; height: 70px;" src="<?= $ads['img']; ?>"></a>
      </li>
      <li>
        <?php
        $db->query("SELECT * FROM ads WHERE cat_id = 6 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 1)");
        $ads = $db->FetchArray();

        ?>
        <a href="<?= $ads['url']; ?>" target='_blank'><img style="width: 458px; height: 70px;" src="<?= $ads['img']; ?>"></a>

      </li>
    </ul>

  </div>
  <div id="announce">
    <div class="title">
      <span>Объявления</span>
    </div>
    <div class="content">

      <div class="search">
        <form action='' method='POST' id='search_announce'>
          <b>Поиск:</b><br>
          <input name='query' type="text"><br>
          <select name="category">
            <option value='all' selected>Все категории</option>
            <?php
            $db->query("SELECT * FROM announce_cat ORDER BY id");

            $listcats = $db->FetchArray();

            do {
            ?>
              <option value="<?= $listcats['id']; ?>"><?= $listcats['title']; ?> (<?= $listcats['count']; ?>)</option>
            <?php
            } while ($listcats = $db->FetchArray());
            ?>
          </select>

          <input id='go_search' type="button" value="Найти">
        </form>
      </div>
      <div class="categories">
        <div class="items">
          <?php
          $db->query("SELECT * FROM announce_cat ORDER BY id");

          $listcats = $db->FetchArray();

          do {
          ?>
            <div class="item"><a href="/announcecat/<?= $listcats['id']; ?>"><?= $listcats['title']; ?> (<?= $listcats['count']; ?>)</a></div>
          <?php
          } while ($listcats = $db->FetchArray());
          ?>
        </div>
      </div>



      <br>
      <div class="last-title">Добавление объявления</div>

      <div id='search_result' class="items" style="margin-top: 10px;">
        <h4></h4>
        <p><b>Правила добавления объявлений или «Почему моё объявление не выходит?»</b></p>
        <p>Возможно, вы что-то делаете не правильно. Есть правила, при соблюдении которых ваше объявление обязательно появится на сайте.</p>
        <p>
          <ul>
            <li>Объявление добавляется после просмотра модератором и автоматически удаляется через неделю.
              Не нужно добавлять объявление несколько раз в час в разные разделы или повторять его каждый день. В этом случае все ваши объявления будут удаляться. Не стоит злоупотреблять оказываемым Вам доверием. Объявления можно давать повторно раз в неделю.</li>
            <li>Прежде, чем повторно добавить объявление, убедитесь, что старого нет на сайте (воспользуйтесь поиском). Если вам нужно изменить цену или другие параметры, удалите старое объявление (с помощью специального кода, который даётся при добавлении), дайте новое.</li>
            <li>Не нужно писать ЗАГЛАВНЫМИ БУКВАМИ, даже если вы пишете «капсом» только одно слово. Такие объявления выходить не будут. Исключения составляют только аббревиатуры и некоторые названия.</li>
            <li>Объявления рекламного и коммерческого характера удаляются; это относится и к агентствам недвижимости, и к сдаче квартир на сутки. Является ли объявление «коммерческим» - решает модератор.</li>
            <li>В поле для контактов оставляйте именно ваши контакты, а не ваше имя или любую другую информацию.</li>
            <li>Используйте элементарные правила оформления текста: после запятых и точек ставится пробел, предложения начинаются с заглавной буквы и т.д.</li>
            <li>Не засоряйте раздел, не добавляйте несколько объявлений, если все необходимое можно написать в одном.</li>
            <li>Для вашего же удобства в объявлениях существуют разделы. Выбирайте правильный раздел, потому что в противном случае ваши объявления будут удаляться.</li>
            <li>К объявлению можно добавить фотографию, её размер не должен превышать 800х600 пикселей.</li>
            <li>Не нужно пытаться обмануть модератора, злоупотребляя вышеперечисленными правилами и пытаться доказать свою правоту.</li>
            <li>Помните, что это – бесплатный раздел, услуга предоставляется Вам «как есть», и любое объявление может быть удалено на усмотрение модератора. В противном случае Вы добьётесь только того, что ваши объявления не появятся на сайте вообще никогда.</li>
            <li>В объявлениях о приеме на работу запрещено указывать пол и возраст в соответствии с дополнениями в кодекс об административных правонарушениях (введения штрафных санкций за размещение информации о вакансиях для приема на работу, содержащие требования дискриминационного характера в сфере труда.).</li>
            <li>Согласно приказу №720 от 22 января 2016 года, подавая объявление о продаже автомобилей, запчастей, недвижимости и других товаров и услуг, продавцам необходимо указывать стоимость не в долларах США, евро или российских рублях, а только в тенге.</li>
            <li>После добавления объявления ваш номер телефона, IP адрес и время активности на этой странице будут записаны в БД. Оставляя комментарий, вы соглашаетесь с тем, что можете быть привлечены к ответственности в соответствии с законодательством РК, а также даёте свое согласие на сбор и обработку ваших персональных данных. Если Вы не согласны с любым из этих пунктов, Вы можете выйти, тем самым аннулируя это соглашение по Вашим дальнейшим действиям. Спасибо за понимание.</li>
          </ul>
        </p>
        <?php
        if (isset($_SESSION['phone']) && $_SESSION['phone'] != '') {
        ?>
          <div id="addcomment" class='add_news_comments'>

            <div class='add_news_comments_content'>

              <h4 class="text-author">Вы авторизированы на сайте с вашим номером телефона и можете добавлять объявления. Ваш телефон не виден никому, кроме администратора сайта.</h4><a class="logout-button" href="/logout">Выход</a>
              <form id='form_comment' method='post'>
                <p>Раздел: <br>
                  <select name="category" id="category">
                    <option value='' selected>Выбор категории</option>
                    <?php
                    $db->query("SELECT * FROM announce_cat ORDER BY id");

                    $listcats = $db->FetchArray();

                    do {
                    ?>
                      <option value="<?= $listcats['id']; ?>"><?= $listcats['title']; ?> (<?= $listcats['count']; ?>)</option>
                    <?php
                    } while ($listcats = $db->FetchArray());
                    ?>
                  </select>
                </p>
                <div id="add_file_announce">
                  <input type="file" id='image'>

                </div>
                <div class="input-50-proc">
                  <p>Контактный телефон: * (в формате +77771112233) <br><input type='text' id="phone" class="announce_input" name='contact'></p>
                  <p>Цена: <br><input id="price" class="announce_input" type="text"></p>
                </div>
                <p>Текст объявления: * <br><textarea id='text' rows="7" name='text'></textarea></p>
              </form>
              <p> * Все поля обязательны к заполнению!</p>
              <a href="#refreshaddcom" id='send_announce'>Подать объявление</a>
            </div>
          </div>

        <?php
        } else {
        ?>
          <div class="phone-verification">
            <div id="ver1" class="ver-message">
              Согласно закону об информатизации, для добавления объявлений вам необходимо пройти авторизацию на сайте. Для этого необходимо выполнить несколько простых действий.
              <br><br>
              <button id="verbut1">Начать</button>
            </div>
            <div id="ver2" class="ver-message" style="display: none;">
              <form id="verification" action="" method="POST">
                Введите ваш номер телефона:
                <br>
                <br>
                +7 <input type="text" name="phone">
                <br><br>
              </form>
              <button type="button" id="verbut2">Отправить</button>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
  <br>

</div>

<script>
  $(document).ready(function() {
    $("#go_search").click(
      function() {
        sendAjaxForm('search_announce', 'announce_search.php');
        return false;
      }
    );
  });

  function sendAjaxForm(ajax_form, url) {
    $.ajax({
      url: url, //url страницы (action_ajax_form.php)
      type: "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("#" + ajax_form).serialize(), // Сеарилизуем объект
      success: function(result) { //Данные отправлены успешно

        $('#search_result').html(result);
      },
      error: function(result) { // Данные не отправлены
        $('#search_result').html('Ошибка. Данные не отправлены.');
      }
    });
  }


  $(document).ready(function() {
    $("#verbut1").click(
      function() {
        $("#ver2").show();
        $("#ver1").hide();
      }
    );

    $("#verbut2").click(
      function() {
        VerSendForm('ver2', 'ver3', 'verification');
        return false;
      }
    );


  });








  function VerSendForm(s1, s2, ajax_form) {
    $.ajax({
      url: "/phonever.php", //url страницы (action_ajax_form.php)
      type: "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("#" + ajax_form).serialize(), // Сеарилизуем объект
      success: function(response) { //Данные отправлены успешно
        $(".phone-verification").html(response);
      },
      error: function(response) { // Данные не отправлены
        $(".phone-verification").html(response);
      }
    });
  }


  (function($) {

    var files; // переменная. будет содержать данные файлов

    // заполняем переменную данными файлов, при изменении значения file поля
    $('#image').on('change', function() {
      files = this.files;
    });


    // обработка и отправка AJAX запроса при клике на кнопку upload_files
    $('#send_announce').on('click', function(event) {

      event.stopPropagation(); // остановка всех текущих JS событий
      event.preventDefault(); // остановка дефолтного события для текущего элемента - клик для <a> тега

      // ничего не делаем если files пустой

      var image = $("#image").val();

      var data = new FormData();

      if (image == '') {
        var valimg = '1';
        data.append('image', valimg);
      } else {
        $.each(files, function(key, value) {
          data.append(key, value);
        });
      }

      var price = $('#price').val();
      var text = CKEDITOR.instances['text'].getData();
      var category = $('#category').val();
      var phone = $('#phone').val();


      data.append('my_file_upload', 1);
      data.append('category', category);
      data.append('text', text);
      data.append('price', price);
      data.append('phone', phone);

      // AJAX запрос
      $.ajax({
        url: '/addannounce.php',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'html',
        // отключаем обработку передаваемых данных, пусть передаются как есть
        processData: false,
        // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
        contentType: false,
        // функция успешного ответа сервера
        success: function(html) {

          $('.add_news_comments_content').html(html);

        },
        // функция ошибки ответа сервера
        error: function(jqXHR, status, errorThrown) {
          console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
        }

      });

    });


  })(jQuery)


  window.onload = function() {
    CKEDITOR.replace('text');
  };
</script>