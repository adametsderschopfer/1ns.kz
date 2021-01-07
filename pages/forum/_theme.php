<?php
  if(isset($_GET['id']) && $_GET['id'] != '') {
    $razd_id = $_GET['id'];
  }

  $db->query("SELECT title FROM forum_razds WHERE id = '$razd_id'");
  $razd = $db->FetchArray();
?>

  <div class="title_forum">Форум: <span>Основной</span> > <span><?=$razd['title']; ?></span></div>
<div class="forum_cont">  
  <div class="forum"> 
    <div class="forum_title"> 
        <div class="forum_column1"><span>Название / Автор:</span></div>
        <div class="forum_column2"><span>Ответов / Просмотров:</span></div>
        <div class="forum_column3"><span>Последнее сообщение:</span></div>
    </div>
    <?php
      $db->query("SELECT * FROM forum_themes WHERE razd_id = '$razd_id' ORDER BY id DESC");
      $topic = $db->FetchArray();
      do {
        $topicid = $topic['id'];
      
    ?>
    <div class="forum_conten">  
        <div class="forum_items"> 
              <div class="forum_item">
                  <div class="forum_column1">  
                      <div class="min_img"><img src="/img/topic.png" alt=""></div>
                      <div class="forum_item_cont"> 
                          <?php
                              $authorid = $topic['author'];
                              $db->query("SELECT login FROM users WHERE id = '$authorid'");
                              $authorfetch = $db->FetchArray();
                          ?>
                          <div class="forum_item_cont_title"><a href="/forum/topic/<?=$topic['id']; ?>"><?=$topic['title']; ?></a></div>
                          <div class="forum_item_cont_desc">Автор: <?=$authorfetch['login']; ?> <?=date("d.m.Y H:i:s", $topic['date']); ?></div>
                      </div>
                  </div> 
                  <div class="forum_column2"> 
                      <div class="forum_item_count_theme">Ответов: <?=$topic['otvets']; ?></div>
                      <div class="forum_item_count_messages">Просмотров: <?=$topic['views']; ?></div>
                  </div>
                  <div class="forum_column3"> 
                      <div class="forum_item_last_title"><a href=''>Находки и поиск</a> от <a href="">Admin</a></div>
                      <div class="forum_item_last_date">13.10.2019, 19:29</div>
                  </div>
              </div>
        </div>
    </div>
    <?php
    $db->query("SELECT * FROM forum_themes WHERE id < '$topicid' AND razd_id = '$razd_id' ORDER BY id DESC");
  } while($topic = $db->FetchArray());

  ?>
  <?php
  if(isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
  ?>
    <a href="/forum/addtheme/<?=$razd_id; ?>">Добавить тему</a>
  <?php
  } else {
    echo "Чтобы добавить новую тему, Вам необходимо авторизоваться!";
  }
  ?>
    
  </div>
    



</div>