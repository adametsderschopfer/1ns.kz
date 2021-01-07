<?php
if(isset($_GET['page']) && $_GET['page'] == 'forum') {

} else {
?>
<div id="right-column">

  
  <br>
  <div id="search">
    <form action="/search/" method="post" name="search">
      <div class="input-search">
        <input name="search" type="text" placeholder='Поиск по сайту'>
      </div>
      <br>
      <input class="input_no100" type="image" name="imageField2" src="/img_f/but_seash.gif" />
    </form>
  </div>
  <br>
  <div class="baner-160">
    <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 3 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 3)");
                        $ads = $db->FetchArray();

                    ?>
   <a href="<?=$ads['url']; ?>" target='_blank'><img src="<?=$ads['img']; ?>"></a>
  </div>
  <br>



  <div class="kinoafish">
    <div class="title"><span>Рейтинг фильмов</span></div>
    <div class="content">
      <div class="items">
        <?php
          $db->query("SELECT * FROM kinoafish ORDER BY id DESC LIMIT 5");
          $kino = $db->FetchArray();
          do{
        ?>
        <div class="item">
          <b style="color:#4291ff; display: block;" ><?=$kino['title']; ?></b>
          
           Рейтинг: <span onclick="minus_rate(<?=$kino['id']; ?>)" class="minus"> - </span> 
           <b>
            <?php
              if($kino['rating'] > 0) {
            ?>
              <font color="green"> <b><?=$kino['rating']; ?></b>  </font>
            <?php
              } elseif($kino['rating'] < 0) {
            ?>
              <font color="red"> <b><?=$kino['rating']; ?></b> </font>
            <?php
              } else {
                echo $kino['rating'];
              }
            ?>

              
            </b> <span onclick="plus_rate(<?=$kino['id']; ?>)" class="plus"> + </span> <br>(оценило: <?=$kino['count']; ?> чел.)
        </div>
        <?php
          } while ($kino = $db->FetchArray());
        ?>
      </div>
    </div>
  </div>

  <script>
    function minus_rate(id) {
      $.ajax({
        type: "POST",
        url: "/rate.php",
        data: "minus=" + id,
        dataType: 'html',
        success: function(html){
          location.reload();
        }
      });
    }

    function plus_rate(id) {
      $.ajax({
        type: "POST",
        url: "/rate.php",
        data: "plus=" + id,
        dataType: 'html',
        success: function(html){
          location.reload();
        }
      });
    }
  </script>

  <br>
  <div class="baner-80">
   <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 4 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 4)");
                        $ads = $db->FetchArray();

                    ?>
   <a href="<?=$ads['url']; ?>" target='_blank'><img src="<?=$ads['img']; ?>"></a>
  </div>
  <br>
  <div id="weather">
    <div id="m-booked-weather-bl250-68762"> <div class="booked-wzs-250-175 weather-customize" id="weather-customize" style="background-color:#137AE9;width:100%;" id="width1"> <div class="booked-wzs-250-175_in"> <div class="booked-wzs-250-175-data"> <div class="booked-wzs-250-175-left-img wrz-06"> <a target="_blank" href="#"> <img src="//s.bookcdn.com/images/letter/logo.gif" alt="" /> </a> </div> <div class="booked-wzs-250-175-right"> <div class="booked-wzs-day-deck"> <div class="booked-wzs-day-val"> <div class="booked-wzs-day-number"><span class="plus">+</span>19</div> <div class="booked-wzs-day-dergee"> <div class="booked-wzs-day-dergee-val">&deg;</div> <div class="booked-wzs-day-dergee-name">C</div> </div> </div> <div class="booked-wzs-day"> <div class="booked-wzs-day-d">H: <span class="plus">+</span>20&deg;</div> <div class="booked-wzs-day-n">L: <span class="plus">+</span>12&deg;</div> </div> </div> <div class="booked-wzs-250-175-info"> <div class="booked-wzs-250-175-city">Астана </div> <div class="booked-wzs-250-175-date">Суббота, 05 Октябрь</div> <div class="booked-wzs-left"> <span class="booked-wzs-bottom-l">Прогноз на неделю</span> </div> </div> </div> </div> <a target="_blank" href="https://nochi.com/weather/astana-w1465"> <table cellpadding="0" cellspacing="0" class="booked-wzs-table-250"> <tr> <td>Вс</td> <td>Пн</td> <td>Вт</td> <td>Ср</td> <td>Чт</td> <td>Пт</td> </tr> <tr> <td class="week-day-ico"><div class="wrz-sml wrzs-01"></div></td> <td class="week-day-ico"><div class="wrz-sml wrzs-01"></div></td> <td class="week-day-ico"><div class="wrz-sml wrzs-01"></div></td> <td class="week-day-ico"><div class="wrz-sml wrzs-01"></div></td> <td class="week-day-ico"><div class="wrz-sml wrzs-03"></div></td> <td class="week-day-ico"><div class="wrz-sml wrzs-03"></div></td> </tr> <tr> <td class="week-day-val"><span class="plus">+</span>19&deg;</td> <td class="week-day-val"><span class="plus">+</span>21&deg;</td> <td class="week-day-val"><span class="plus">+</span>22&deg;</td> <td class="week-day-val"><span class="plus">+</span>20&deg;</td> <td class="week-day-val"><span class="plus">+</span>20&deg;</td> <td class="week-day-val"><span class="plus">+</span>7&deg;</td> </tr> <tr> <td class="week-day-val"><span class="plus">+</span>10&deg;</td> <td class="week-day-val"><span class="plus">+</span>10&deg;</td> <td class="week-day-val"><span class="plus">+</span>11&deg;</td> <td class="week-day-val"><span class="plus">+</span>11&deg;</td> <td class="week-day-val"><span class="plus">+</span>11&deg;</td> <td class="week-day-val"><span class="plus">+</span>4&deg;</td> </tr> </table> </a> </div></div> </div><script type="text/javascript"> var css_file=document.createElement("link"); css_file.setAttribute("rel","stylesheet"); css_file.setAttribute("type","text/css"); css_file.setAttribute("href",'/css/book.css?v=0.0.1'); document.getElementsByTagName("head")[0].appendChild(css_file); function setWidgetData(data) { if(typeof(data) != 'undefined' && data.results.length > 0) { for(var i = 0; i < data.results.length; ++i) { var objMainBlock = document.getElementById('m-booked-weather-bl250-68762'); if(objMainBlock !== null) { var copyBlock = document.getElementById('m-bookew-weather-copy-'+data.results[i].widget_type); objMainBlock.innerHTML = data.results[i].html_code; if(copyBlock !== null) objMainBlock.appendChild(copyBlock); } } } else { alert('data=undefined||data.results is empty'); } } </script> <script type="text/javascript" charset="UTF-8" src="https://widgets.booked.net/weather/info?action=get_weather_info&ver=6&cityID=w1465&type=3&scode=124&ltid=3539&domid=589&anc_id=15392&cmetric=1&wlangID=20&color=137AE9&wwidth=250&header_color=ffffff&text_color=333333&link_color=08488D&border_form=1&footer_color=ffffff&footer_text_color=333333&transparent=0"></script>
    <script>
      $( document ).ready(function() {
        $('#width1').width('100%');    
      });
    </script>
  </div>
 <br>
  <div class="baner-160">
   <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 7 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 3)");
                        $ads = $db->FetchArray();

                    ?>
   <a href="<?=$ads['url']; ?>" target='_blank'><img src="<?=$ads['img']; ?>"></a>
  </div>
  <br>
    <div class="baner-80">
   <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 9 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 4)");
                        $ads = $db->FetchArray();

                    ?>
   <a href="<?=$ads['url']; ?>" target='_blank'><img src="<?=$ads['img']; ?>"></a>
  </div>
  <br>
  <div id="informer">
    <a title="Курс валют в Казахстане на сегодня"><img src="https://storage.ifin.kz/informer/informer220.png" alt="Курс валют в Казахстане"></a>
  </div>
<br>
    <div class="baner-400">
   <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 5 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 5)");
                        $ads = $db->FetchArray();

                    ?>
   <a href="<?=$ads['url']; ?>" target='_blank'><img src="<?=$ads['img']; ?>"></a>
  </div>
  <br>

  <div class="new_companyes">
    <div class="title"><span>Новое в каталоге компаний</span></div>
    <div class="content">
      <div class="items"> 
        <?php
          $db->query("SELECT * FROM companyes ORDER BY id");
          $companyes = $db->FetchArray();

          do{
            $companyid = $companyes['id'];
            $companycat = $companyes['cat_id'];
            $db->query("SELECT * FROM companyes_cat WHERE id = '$companycat'");
            $catcompany = $db->FetchArray();
        ?>
            <div class="item">
              <a href="/company/<?=$companyes['id']; ?>"><?=$companyes['title']; ?></a><br>
              <span>Раздел: <a href="/companyescat/<?=$catcompany['id']; ?>"><?=$catcompany['title']; ?></a></span>
            </div>
        <?php
            $db->query("SELECT * FROM companyes WHERE id > '$companyid' ORDER BY id");
          } while ($companyes = $db->FetchArray());
        ?>
      </div>
      <a href="/companyes"><img src="img_f/main_blc_str.gif" alt="" width="11" height="15" border="0" />Каталог компаний</a>
    </div>
  </div>
  <br>
  <div class="baner-160">
   <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 8 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 3)");
                        $ads = $db->FetchArray();

                    ?>
   <a href="<?=$ads['url']; ?>" target='_blank'><img src="<?=$ads['img']; ?>"></a>
  </div>

<br>
</div>

<?php
}
?>
