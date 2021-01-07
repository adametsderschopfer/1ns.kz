<?php
$db->query("SELECT * FROM announce");
if ($db->NumRows() == 0) {
} else {
  $andel = $db->FetchArray();

  $howdate = time();

  do {
    $andate = $andel['date'];
    $resdata = $howdate - $andate;

    if ($resdata > 604800) {
      $anid = $andel['id'];
      $db->query("SELECT * FROM announce WHERE id = '$anid'");
      $an = $db->FetchArray();
      $category = $an['cat_id'];

      $db->query("DELETE FROM announce WHERE id = '$anid'");
      $db->query("UPDATE announce_cat SET count = count - 1 WHERE id = '$category'");
    }
  } while ($andel = $db->FetchArray());
}

?>
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

          <input name='query' type="text" class="search_bar_two"><br>
          <div class="cat_and_serch">
            <select name="category">
              <option value='all' selected>Все категории</option>
              <?php
              $db->query("SELECT * FROM announce_cat ORDER BY id");

              $listcats = $db->FetchArray();

              do {
                $catid = $listcats['id'];
                $db->query("SELECT * FROM announce WHERE cat_id = '$catid' AND act = 1");
                $ancount = $db->NumRows();
              ?>
                <option value="<?= $listcats['id']; ?>"><?= $listcats['title']; ?> (<?= $ancount; ?>)</option>
              <?php
                $db->query("SELECT * FROM announce_cat WHERE id > '$catid' ORDER BY id");
              } while ($listcats = $db->FetchArray());
              ?>
            </select>

            <input id='go_search' type="button" value="Найти">
          </div>
        </form>
      </div>
      <div class="categories">
        <div class="items">
          <?php
          $db->query("SELECT * FROM announce_cat ORDER BY id");

          $listcats = $db->FetchArray();

          do {
            $catid = $listcats['id'];
            $db->query("SELECT * FROM announce WHERE cat_id = '$catid' AND act = 1");
            $ancount = $db->NumRows();
          ?>
            <div class="item"><a href="/announcecat/<?= $listcats['id']; ?>"><?= $listcats['title']; ?> (<?= $ancount; ?>)</a></div>
          <?php
            $db->query("SELECT * FROM announce_cat WHERE id > '$catid' ORDER BY id");
          } while ($listcats = $db->FetchArray());
          ?>
        </div>
      </div>



      <br>
      <div class="last-title"><span>Последние добавленные
        </span>


        <a href="/addannounce">Добавить объявление</a>





      </div>
      <div id='search_result' class="items" style="margin-top: 10px;">
        <?php


        $db->query("SELECT * FROM announce WHERE act = 1 ORDER BY id DESC LIMIT 30");


        $announce = $db->FetchArray();

        do {
        ?>

          <div class="item" style="display: flex;">
            <img width="60px" style="margin: 5px;" class="minimized" height="60px" src="<?= $announce['photo']; ?>" alt="">
            <div class="desc">
              <span class="news_date_sm">
                <?= date("d-m-Y H:i:s", $announce['date']); ?>
              </span>
              <br>
              <span style="display: block; width: 85%; word-wrap: normal;" class="main_bg_blc5_1">
                <p><?= $announce['text']; ?></p>
              </span>
              <h4><?= $announce['phone']; ?></h3>
                <div class="price"><?= $announce['price']; ?></div>
            </div>
          </div>
        <?php
        } while ($announce = $db->FetchArray());
        ?>
      </div>

      <p>Если вы хотите удалить Ваше объявление нажмите <a href="javascript:void(0);" onclick="$('.del-announce').show();">тут</a></p>
      <div class="del-announce" style="text-align: center; display: none;">
        <p><b>Введите код удаления:</b><br><input style="border: 1px solid #ccc; width: 200px;" type='text' id="delancode" name='contact'><button type="button" id="goviewcodedel">Подтвердить</button></p>
      </div>

    </div>
  </div>
  <br>

</div>

<script>
  $(document).ready(function() {

    $('#goviewcodedel').click(function() {
      var delcode = $('#delancode').val();

      $.ajax({
        url: "/dellanncode.php",
        type: "POST",
        dataType: "html",
        data: {
          "delcode": delcode
        },
        success: function(html) {
          $('.del-announce').html(html);
        },
        error: function(html) {

        }
      });
    });


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


  $(function() {
    $('.minimized').click(function(event) {
      var i_path = $(this).attr('src');
      $('body').append('<div id="overlay"></div><div id="magnify"><img src="' + i_path + '"><div id="close-popup"><i></i></div></div>');
      $('#magnify').css({
        left: ($(document).width() - $('#magnify').outerWidth()) / 2,
        // top: ($(document).height() - $('#magnify').outerHeight())/2 upd: 24.10.2016
        top: ($(window).height() - $('#magnify').outerHeight()) / 2
      });
      $('#overlay, #magnify').fadeIn('fast');
    });

    $('body').on('click', '#close-popup, #overlay', function(event) {
      event.preventDefault();

      $('#overlay, #magnify').fadeOut('fast', function() {
        $('#close-popup, #magnify, #overlay').remove();
      });
    });
  });
</script>