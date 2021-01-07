<?php
  if(isset($_GET['id']) && $_GET['id'] != '') {
    $topic_id = $_GET['id'];
    $db->query("UPDATE forum_themes SET views = views + 1 WHERE id = '$topic_id'");
  }

  if(isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
    $userid = $_SESSION['userid'];
    $userid = intval($userid);
  }

  if(isset($_POST['message']) && $_POST['message'] != '') {
    $message = $_POST['message'];

    $date = date("Y-m-d, H:m:s");

    $db->query("INSERT INTO forum_messages (`date`, `author_id`, `theme_id`, `message`) VALUES ('$date', '$userid', '$topic_id', '$message')");
    $db->query("UPDATE forum_themes SET otvets = otvets + 1 WHERE id = '$topic_id'");
    $db->query("SELECT * FROM forum_themes WHERE id = '$topic_id'");
    $theme = $db->FetchArray();
    $razdid = $theme['razd_id'];
    $db->query("UPDATE forum_razds SET messages = messages + 1 WHERE id = '$razdid'");
    
    header("LOCATION: /forum/topic/$topic_id");
    exit();
  }

  $db->query("SELECT * FROM forum_themes WHERE id = '$topic_id'");
  $topic = $db->FetchArray();
  $razd_id = $topic['razd_id'];

  $db->query("SELECT title FROM forum_razds WHERE id = '$razd_id'");
  $razds = $db->FetchArray();
?>

  <div class="title_forum">Форум: <span>Основной </span> <span><?=$razds['title']; ?></span> > <span><?=$topic['title']; ?></span></div>
<div class="forum_cont">  

  <div id="message_author>" class="message"> 
    <div class="top_message">
      <div class="date_message"><?=date("d.m.Y H:i:s", $topic['date']); ?></div>
      <div class="number_message"></div>
    </div>
    <div class="content_message">
      <div class="author_forum">
        <?php
          $author_id = $topic['author'];
          $db->query("SELECT * FROM users WHERE id = '$author_id'");
          $author = $db->FetchArray();
        ?>
      
        <p><?=$author['login']; ?></p>
        <div class="forum_avatar">
          <img src="<?=$author['avatar']; ?>" alt="">
        </div>

      </div>
      <div class="cont_message">
          <div class="text_message"><?=$topic['message']; ?></div>
      </div>
    </div>
  </div>

  <?php
    $db->query("SELECT * FROM forum_messages WHERE theme_id = '$topic_id' ORDER BY id");
    $message = $db->FetchArray();

    do {

  ?>
  <div id="message_<?=$message['id']; ?>" class="message"> 
    <div class="top_message">
      <div class="date_message"><?=$message['date']; ?></div>
      <div class="number_message"><a href="#<?=$message['id']; ?>">#<?=$message['id']; ?></a></div>
    </div>
    <div class="content_message">
      <div class="author_forum">
        <?php
          $author_id = $message['author_id'];
          $db->query("SELECT * FROM users WHERE id = '$author_id'");
          $author = $db->FetchArray();
        ?>
      
        <p><?=$author['login']; ?></p>
        <div class="forum_avatar">
          <img src="<?=$author['avatar']; ?>" alt="">
        </div>

      </div>
      <div class="cont_message">
          <div class="text_message"><?=$message['message']; ?></div>
          <div class="author_message">Рама со створкой упала на грудь, милый монтажник, меня не забудь! (с)</div>
      </div>
    </div>
    <div class="footer_message"><a onclick='copy_message(<?=$message['message']; ?>)'>Ответить с цитированием</a></div>
  </div>

  <?php
    $last_message = $message['id'];
    $db->query("SELECT * FROM forum_messages WHERE theme_id = '$topic_id' AND id > '$last_message' ORDER BY id");
    } while($message = $db->FetchArray());

      if(isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
  ?>

  <form action="" method="POST" class="send_message_topic">
   <textarea name="message" class="copymessage" id="message" cols="30" rows="10"></textarea>
    <input type="submit" value="Отправить" >
  </form>

<?php
      } else {
        echo "Для того чтобы оставить сообщения, необходимо авторизоваться!";
      }
?>
   <script>
  CKEDITOR.replace('message');

  function copy_message(message) {
      $(".copymessage").html(message);
  }
</script>
</div>