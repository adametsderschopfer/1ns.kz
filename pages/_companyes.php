
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
  <div id="announce">
    <div class="title">
      <span>Каталог компаний</span> 
    </div>
    <div class="content">
      <div class="top_companyes">
        <h4>1NS.KZ Рекомендует:</h4>
        <div class="items">
           <?php
            $db->query("SELECT * FROM companyes WHERE top = 1 ORDER BY id LIMIT 5");

            $comp = $db->FetchArray();

            do{
            ?>
          <div class="item">
            <a href="/company/<?=$comp['id']; ?>"><b><?=$comp['title']; ?></b></a> <?=$comp['descr']; ?>
          </div>
          <br>

          <?php
            } while ($comp = $db->FetchArray());
          ?>
        </div>
      </div>
      <div class="search">
        <b>Поиск:</b><br>
        <input type="text" class='search_bar'><br>
        <div class="block_search_comp">
        <select name="">
          <option selected>Выбрать категорию</option>
          <?php
            $db->query("SELECT * FROM companyes_cat ORDER BY id");

            $listcats = $db->FetchArray();

            do{
          ?>
          <option value="<?=$listcats['id']; ?>"><?=$listcats['title']; ?> (<?=$listcats['count']; ?>)</option>
          <?php
            } while ($listcats = $db->FetchArray());
          ?>
        </select>

        <input type="submit" value="Найти" class="sub_search ">
        </div>
      </div>
      <div class="categories">
        <div class="items">


<?php
  $alp = array();

  $db->query("SELECT * FROM companyes_cat ORDER BY title");
  $listcats = $db->FetchArray();

  do {
    $word = $listcats['title'];
    $word = mb_substr($word, 0, 1, 'UTF-8');
    if (in_array($word, $alp)) {
  ?>
      <div class="item"><a href="/companyescat/<?=$listcats['id']; ?>"><?=$listcats['title']; ?> (<?=$listcats['count']; ?>)</a></div>
  <?php
    } else {
      array_push($alp, $word);
  ?>
      <span style="display: block; font-weight: bold; font-size: 1.5em; width: 45%;"><?=$word; ?></span>
      <div class="item"><a href="/companyescat/<?=$listcats['id']; ?>"><?=$listcats['title']; ?> (<?=$listcats['count']; ?>)</a></div>
  <?php
    }

  } while ($listcats = $db->FetchArray());

?>




        </div>
      </div>



    </div>
  </div>
  <br>

</div>









