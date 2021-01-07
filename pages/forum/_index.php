
  <div class="title_forum">Форум: <span>Основной</span></div>
<div class="forum_cont">  
  <div class="forum"> 
    <div class="forum_title"> 
        <div class="forum_column1"><span>Подразделы:</span></div>
        <div class="forum_column2"><span>Тем/Сообщений:</span></div>
        <div class="forum_column3"><span>Последнее сообщение:</span></div>
    </div>
    <?php
      $db->query("SELECT * FROM forum_razds ORDER BY id");
      $razds = $db->FetchArray();
      do {

      
    ?>
    <div class="forum_conten">  
        <div class="forum_items"> 
              <div class="forum_item">
                  <div class="forum_column1">  
                      <div class="min_img"><img src="/img/forum.png" alt=""></div>
                      <div class="forum_item_cont"> 
                          <div class="forum_item_cont_title"><a href="/forum/theme/<?=$razds['id']; ?>"><?=$razds['title']; ?></a></div>
                          <div class="forum_item_cont_desc"><?=$razds['description']; ?></div>
                      </div>
                  </div> 
                  <div class="forum_column2"> 
                      <div class="forum_item_count_theme">Тем: <?=$razds['themes']; ?></div>
                      <div class="forum_item_count_messages">Сообщений: <?=$razds['messages']; ?></div>
                  </div>
                  <div class="forum_column3"> 
                      <div class="forum_item_last_title"><a href=''>Находки и поиск</a> от <a href="">Admin</a></div>
                      <div class="forum_item_last_date">13.10.2019, 19:29</div>
                  </div>
              </div>
        </div>
    </div>
    <?php
  } while($razds = $db->FetchArray());

  ?>

    
    
  </div>
    



</div>