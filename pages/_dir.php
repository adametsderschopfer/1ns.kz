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
      <span>Справочник</span>
    </div>
    <div class="content">
      <?php
      $db->query("SELECT * FROM dir_cat ORDER BY id LIMIT 10");
      $dir_cat = $db->FetchArray();

      do {
      ?>
        <div class="categories">
          <div class="dirblock1" style=""><img src="<?= $dir_cat['pic']; ?>" alt="<?= $dir_cat['title']; ?>"></div>
          <div class="dirblock2" style="display: inline-block;">

            <h4><?= $dir_cat['title']; ?></h4>
            <ul>
              <?php
              $dirc = $dir_cat['id'];

              $db->query("SELECT * FROM dir WHERE cat_id = '$dirc' ORDER BY id LIMIT 10");
              $dirs = $db->FetchArray();

              do {
              ?>
                <li><a href="/showdir/<?= $dirs['id']; ?>"><?= $dirs['title']; ?></a></li>
              <?php
              } while ($dirs = $db->FetchArray());
              ?>
            </ul>
          </div>
        </div>

      <?php
        $db->query("SELECT * FROM dir_cat WHERE id > '$dirc' ORDER BY id LIMIT 10");
      } while ($dir_cat = $db->FetchArray());
      ?>
    </div>
  </div>
</div>