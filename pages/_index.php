<script>
  function slideSwitch() {
    var $elements = $('#slideshow div');

    var $active = $('#slideshow div.active');

    if ($elements.length == 1) return;

    if ($active.length == 0) $active = $('#slideshow div:last');

    var $next = $active.next().length ? $active.next() :
      $('#slideshow div:first');

    $active.css({
        opacity: 1.0
      })
      .addClass('last-active')
      .animate({
        opacity: 0.0
      }, 1000, function() {});

    $next.css({
        opacity: 0.0
      })
      .addClass('active')
      .animate({
        opacity: 1.0
      }, 1000, function() {
        $active.removeClass('active last-active');
        $(this).css('filter', '');

      });

  }


  $(document).ready(function() {
    setInterval("slideSwitch()", 8000);
    $('#scrollbox').scrollbox({
      autoPlay: false,
    });

    $('.prev').click(function() {
      $('#scrollbox').trigger('backward');
    });

    $('.next').click(function() {
      $('#scrollbox').trigger('forward');
    });
  });
</script>
<div id="obsh">

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


  <div class="pbsh-2">
    <div id="left-columns">
      <div class="top_news">
        <div class="title"><span>Топ-новости</span></div>
        <div class="content">
          <div id="slideshow">
            <?php
            $db->query("SELECT * FROM news WHERE top = 1 ORDER BY id DESC LIMIT 10");
            $news = $db->FetchArray();

            do {
            ?>

              <div>
                <img class="image_slide" src="<?= $news['big_img']; ?>" alt="<?= $news['title']; ?>">

                <div class="slide_desc">
                  <a href="/viewnews/<?= $news['id']; ?>" class='main_bg_blc4_4'>
                    <strong>
                      <?= $news['title']; ?>
                    </strong>
                  </a>
                  <br>

                  <p class="main_bg_blc4_3"><?= $news['top_description']; ?> </p>

                </div>
              </div>
            <?php
            } while ($news = $db->FetchArray());
            ?>
          </div>

          <div class="footer">

          </div>
        </div>

      </div>

      <br>

      <div class="last_news">
        <div class="title">
          <div class="bl1"></div>
          <div class="bl2"><span>Последние новости</span></div>
          <div class="last_social">
            <ul>
              <li><a href=""><img src="img_f/wa.png" width="16" height="16" align="left" border="0" /></a></li>
              <li><a href=""><img src="img_f/tl.png" width="16" height="16" align="left" border="0" /></a></li>
              <li><a href=""><img src="img_f/vk.png" width="16" height="16" align="left" border="0" /></a></li>
              <li><a href=""><img src="img_f/face.png" width="16" height="16" align="left" border="0" /></a></li>
              <li><a href=""><img src="img_f/ok.png" width="16" height="16" align="left" border="0" /></a></li>
              <li><a href=""><img src="img_f/inst.png" width="16" height="16" align="left" border="0" /></a></li>
              <li><a href=""><img src="img_f/you.png" width="16" height="16" align="left" border="0" /></a></li>
              <li><a href=""><img src="img_f/rss.png" width="16" height="16" align="left" border="0" /></a></li>
            </ul>
          </div>
        </div>
        <div class="content">
          <div class="scrollable vertical" id="scrollbox">
            <div class="items">
              <?php
              $db->query("SELECT * FROM news ORDER BY id DESC LIMIT 13");
              $news = $db->FetchArray();
              do {
              ?>
                <div class="item">
                  <div class="pic">
                    <img src="<?= $news['small_img']; ?>" alt="<?= $news['title']; ?>">
                  </div>
                  <div class="desc">
                    <span class="news_date_sm">
                      <?= date("d-m-Y, H:i:s", intval($news['date'])); ?> | <?= $news['views']; ?>
                      <a href="/viewnews/<?= $news['id']; ?>#view_comments">
                        (<?= $news['count']; ?>)
                      </a>
                    </span>
                    <br>
                    <span class="main_bg_blc5_1">
                      <a href="/viewnews/<?= $news['id']; ?>">
                        <?= $news['title']; ?>
                      </a>
                    </span>
                    <br />
                    <div class="news-desc">
                      <wbr><?= $news['description']; ?></wbr>
                    </div>
                  </div>
                </div>
              <?php
              } while ($news = $db->FetchArray());
              ?>
            </div>
          </div>
          <div class="buttons">
            <div class='but-next'><a class="next news_last_bt"><img src="img_f/news_last_do.gif" width="25" height="24" border="0" /></a></div>
            <div class='but-prev'><a class="prev news_last_bt"><img src="img_f/news_last_up.gif" width="25" height="24" border="0" /></a></div>
          </div>
          <a href="/news/" class="main_bg_blc2_3"><img src="img_f/main_blc_str.gif" alt="" width="11" height="15" border="0" />Все новости</a>
        </div>
      </div>

      <br>

      <div class="halyk_news">
        <div class="title">
          <div class="bl1"></div>
          <div class="bl2"><span>Народные новости</span></div>
        </div>
        <div class="content">
          <span class="main_bg_blc5_1">
            <a href="/category/892">
              Все народные новости за неделю
            </a>
          </span>
          <br />
          Уважаемые посетители сайта, предлагаем Вам другой формат новостей. Вы сами можете писать новости.
        </div>
      </div>
      <br>
      <div class="halyk_news">
        <div class="title">
          <div class="bl1"></div>
          <div class="bl2"><span>Наши люди</span></div>
        </div>
        <div class="content">
          <span class="main_bg_blc5_1">
            <a href="/category/893">
              Все новости о том как живут люди
            </a>
          </span>
        </div>
      </div>
    </div>

    <div id="left-columns-two">
      <div id="dop" class="main_bg_blc_1">
        <div class="title">
          <span>Дополнительно</span>
        </div>
        <div class="content main_bg_blc_2">
          <ul>
            <li>
              <a href="/showdir/9" class="main_bg_blc_3">Киноафиша</a><br>
              <div class="desc">
                Рейтинг фильмов
              </div>
            </li>
            <li>
              <a href="/showdir/1" class="main_bg_blc_3">Телефонный справочник</a><br>
              <div class="desc">
                Все телефоны первой необходимости
              </div>
            </li>
            <li>
              <a href="/companyes" class="main_bg_blc_3">Каталог компаний</a><br>
              <div class="desc">
                Каталог компаний с удобным поиском
              </div>
            </li>
            <li>
              <a href="/category/2" class="main_bg_blc_3">Популярные новости</a><br>
              <div class="desc">
                Самые просматриваемые новости за последний месяц
              </div>
            </li>
            <li>
              <a href="" class="main_bg_blc_3">Лидерам бизнеса</a><br>
              <div class="desc">
                Информация для руководителей и pr менеджеров компаний.
              </div>
            </li>
          </ul>


        </div>
      </div>

      <div class="obj">
        <div class="title">
          <div class="bl1"></div>
          <div class="bl2"><span>Объявления</span></div>
        </div>
        <div class="content">
          <div class="ads">





            <?php
            $limit = 8;
            $db->query("SELECT * FROM announce WHERE act = 1 ORDER BY id DESC LIMIT $limit");
            $announce = $db->FetchArray();



            do {
              $announceid = $announce['id'];
            ?>
              <div class="item">
                <span class="main_bg_blc2_4">
                  <?= date("d-m-Y H:i:s", $announce['date']); ?> </span><br />


                <?php
                $cat_id = $announce['cat_id'];

                $db->query("SELECT * FROM announce_cat WHERE id = '$cat_id'");
                $cate = $db->FetchArray();
                ?>
                <a href="/announcecat/<?= $cate['id']; ?>" class="main_bg_blc2_5"><?= $cate['title']; ?></a><br>



                <p><?= $announce['text']; ?></p>
              </div>


            <?php
              $limit = $limit - 1;
              $db->query("SELECT * FROM announce WHERE act = 1 AND id < '$announceid' ORDER BY id DESC LIMIT $limit");
            } while ($announce = $db->FetchArray());

            ?>

          </div>
          <a href="/addannounce/"><img src="img_f/main_blc_str.gif" width="11" height="15" border="0" />Добавить объявление</a> <br />
        </div>
      </div>
      <br>
      <div class="forum_news">
        <div class="title">
          <div class="bl1"></div>
          <div class="bl2"><span>Новое на форуме</span></div>
        </div>
        <div class="content">
          <a href="/forum/showthread.php?t=15320">
            21 сентября 2019, Название новости </a><br />
          <span class="main_bg_blc3_1">Автор:
            <a href="/forum/member.php?u=9855" class="main_bg_blc3_2">
              Автор </a>
            <br />
            <br /></span>
          <a href="/forum/showthread.php?t=15320">
            21 сентября 2019, Название новости </a><br />
          <span class="main_bg_blc3_1">Автор:
            <a href="/forum/member.php?u=9855" class="main_bg_blc3_2">
              Автор </a>
            <br />
            <br /></span>



          <a href="/forum/"><img src="img_f/main_blc_str.gif" alt="" width="11" height="15" border="0" />Форум</a>
        </div>
      </div>
    </div>
  </div>
</div>