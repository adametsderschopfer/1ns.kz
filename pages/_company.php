<?php
  if(isset($_GET['id']) && $_GET['id'] != '') {
    $companyid = $_GET['id'];
  } else {
    unset($companyid);
  }
  $db->query("SELECT * FROM companyes WHERE id = '$companyid'");
  $company = $db->FetchArray();

  $cat_id = $company['cat_id'];

  $db->query("SELECT * FROM companyes_cat WHERE id = '$cat_id'");
  $cats = $db->FetchArray();

?>

<div id="left-cont">
  <div id="top_bar">
                <ul>
                    <li>
                        <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 1 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 1)");
                        $ads = $db->FetchArray();

                    ?>
                    <a href="<?=$ads['url']; ?>" target='_blank'><img style="width: 458px; height: 70px;" src="<?=$ads['img']; ?>"></a>
                    </li>
                    <li>
                        <?php
                        $db->query("SELECT * FROM ads WHERE cat_id = 6 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 1)");
                        $ads = $db->FetchArray();

                    ?>
                    <a href="<?=$ads['url']; ?>" target='_blank'><img style="width: 458px; height: 70px;" src="<?=$ads['img']; ?>"></a>

                    </li>
                </ul>

            </div>
  <div id="show_news">
    <div class="title"><span>Компании - <?=$cats['title']; ?></span></div>
    <div class="content">
      <div class="date_news"><?=$company['date']; ?> 13:23:00</div>
      <h1><?=$company['title']; ?></h1>
      <p class="annot"><strong><?=$company['description']; ?></strong></p>


      <div class="text">
        <?=$company['text']; ?>
      </div>
      <i>Источник: <a href="/" class="sourge" target="_blank">1ns.kz</a></i>
      <br>
      <div class="form_commet">Узнавайте новости первыми с нашим <a href="https://t.me/yk1kz" target="_blank" class="pod_menu_l">Telegram-каналом</a>. Будьте в курсе!</div>
    </div>
  </div>
</div>





   




