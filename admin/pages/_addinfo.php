<main class="main">
    <section class="plate">
        <?php 

          include('include/_menu.php'); 

        ?>
        <section class="wind news">
            <div class="container fg">

                <div class="blockText">
                    <div class="newslist">
                        <div id="panel1">  
                            <button onclick="addcom()">Добавить компанию</button>
                            <button onclick="addphone()">Добавить телефон</button>
                        </div><br>
                        <div id="panel2" style="display: none">  
                            <p> 
                                <b>Название</b><br>
                                <input type="text" id="title1">
                            </p>
                            <p> 
                                <b>Описание</b><br>
                                <input type="text" id="des1">
                            </p>
                            <p> 
                                <b>Категория</b><br>
                                <select id="cat1">
                            <?php
                              $db->query("SELECT * FROM dir WHERE type = 'com' ORDER BY id");
                              $category = $db->FetchArray();
                              do {
                            ?>
                                <option value="<?=$category['id']; ?>"><?=$category['title']; ?></option>
                            <?php
                                
                              } while ($category = $db->FetchArray());
                            ?>
                            
                          </select>
                            </p>
                            
                            <p> 
                                <b>email</b><br>
                                <input type="text" id="email1">
                            </p>
                            <p> 
                                <b>Телефон</b><br>
                                <input type="text" id="phone1">
                            </p>
                            <p> 
                                <b>Сайт</b><br>
                                <input type="text" id="site1">
                            </p>
                            <p> 
                                <b>Адрес</b><br>
                                <input type="text" id="adres1">
                            </p>
                            <p> <input type="button" onclick="sendcom()" value="Отправить"></p>
                        </div>
                        <div id="panel3" style="display: none">  
                           <p> 
                                <b>Название</b><br>
                                <input type="text" id="title2">
                            </p>
                             <p> 
                                <b>Категория</b><br>
                                <select id="cat2">
                            <?php
                              $db->query("SELECT * FROM dir WHERE type = 'phone' ORDER BY id");
                              $category = $db->FetchArray();
                              do {
                            ?>
                                <option value="<?=$category['id']; ?>"><?=$category['title']; ?></option>
                            <?php
                                
                              } while ($category = $db->FetchArray());
                            ?>
                            
                          </select>
                            </p>
                            <p> 
                                <b>Телефон</b><br>
                                <input type="text" id="phone2">
                            </p>
                            <p> <input type="button" onclick="sendphone()" value="Отправить"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>


<script type="text/javascript">
  function sendcom() {
    var title = $('#title1').val();
    var des = $('#des1').val();
    var cat = $('#cat1').val();
    var email = $('#email1').val();
    var phone = $('#phone1').val();
    var site = $('#site1').val();
    var adres = $('#adres1').val();
    

    var fd = new FormData;

    fd.append('title', title);
    fd.append('des', des);
    fd.append('cat', cat);
    fd.append('email', email);
    fd.append('phone', phone);
    fd.append('site', site);
    fd.append('adres', adres);


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.send.com.php",
     data: fd,
     type: "POST",
     success: function() {
        location.reload();
     },
     error: function() {
        location.reload();
     }
    });
  }

  function sendphone() {
    var title = $('#title2').val();
    var phone = $('#phone2').val();
    var cat = $('#cat2').val();
    

    var fd = new FormData;

    fd.append('title', title);
    fd.append('phone', phone);
    fd.append('cat', cat);


    $.ajax({
     processData: false,
     contentType: false,
     url: "/admin/lib/ajax.send.phone.php",
     data: fd,
     type: "POST",
     success: function() {
        location.reload();
     },
     error: function() {
        location.reload();
     }
    });
  }

function addcom() {
    $('#panel2').show();
    $('#panel3').hide();
}

function addphone() {
    $('#panel2').hide();
    $('#panel3').show();
}

</script>