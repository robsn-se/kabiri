<?php
require_once "./controlers/page_controler.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaberi - это приложение личной безопасности</title>
    <link rel="shortcut icon" href="favicon.ico.ico">
    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/mesto.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" /> -->
    <script src="https://api-maps.yandex.ru/2.1/?apikey=d9d0372b-fca6-4014-af33-08bc4bfc8b56&lang=ru_RU" type="text/javascript"></script>
</head>
<body>
      <header>
        <div class="heder_main_blok">
          <div class="">
            <a class="heder_logo" href="file:///C:/Users/RUBEN/Desktop/kabiri%20best/test_study/test.html" target="__blank">
              <img src="./images/логотип.gif" alt="" width="70px">
            </a>
            <h1 style="display: inline-block;">KABERI</h1>
          </div>
          <div class="button">
            <a href="#" class="btn">Зарегистрироваться</a>
          </div>
          <div class="social">
            <a class="social__icon twitter" href="#" title="twitter"title="twitter">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="social__icon vk" href="https://vk.com/id608634445" target="__blank" title="vk">
              <i class="fab fa-vk"></i>
            <a class="social__icon telegram-plane" href="#" title="telegram ">
              <i class="fab fa-telegram-plane"></i>   
            </a>
            <a class="social__icon youtube" href="#" title="youtube"title="youtube">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>
      </header>
    <div class="smol">
      <h2>
      Место, где люди <br> защищают <br> друг друга
      </h2>
      <h4 style="text-align: center; color:  rgb(255, 255, 255); font-family: 'Roboto', sans-serif; font-weight: 200; font-size: 20px;">Подключайтесь и живите в безопасности. 
          <br> <strong>Kaberi</strong> - это приложение личной безопасности,
          <br> которое дает вам возможность защитить себя, а также людей и места,
          <br> которые вам небезразличны. Kaberi предоставляет Вам  уведомления на основе 
          <br> местоположения и помогает избежать потенциально опасные ситуации.</h4>
          <hr>
          <h1>
              Вместе строим будущее <br> общественной безопасности
          </h1>
          </div>
          <div class="map_smolensk">
            <div id="map"></div>
    </div>

          <!-- <div id="wrap">
            <form action="" autocomplete="on">
            <input id="search" name="search" type="text" placeholder="Найти событие..."><input id="search_submit" value="Rechercher" type="submit">
            </form>`
          </div> -->




          <br>
          <br>
          <ul class="event_list">
            <?php foreach($actionsList as $oneAction){ ?>
              <li>
                  <img src="<?= $oneAction["image"] ?>" alt="">
                <div>
                  <h3><?= $oneAction["title"] ?></h3>
                  <h6><?= $oneAction["date"] ?></h6>
                  <p>
                    <?= $oneAction["discription"] ?>
                  </p>
                  <h5><?= $oneAction["address"] ?></h5>
                </div>
              </li>
              <hr>
            <?php } ?>
          </ul>
              

          <div class="button">
          <a href="#" class="btn">Зарегистрироваться</a>
          </div>

          <!-- <div class="social">
              <a class="social__icon instagram" href="https://www.instagram.com/robsn_se/" target="__blank" title="instagram">
                <i class="fab fa-instagram"></i>
              </a>
              <a class="social__icon facebook" href="#" title="facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a class="social__icon git" href="https://github.com/robsn-se" target="__blank" title="github">
                <i class="fab fa-github"></i>
              </a>
              <a class="social__icon twitter" href="#" title="twitter"title="twitter">
                <i class="fab fa-twitter"></i>
              </a>
              <a class="social__icon linkedin" href="#" title="linkedin">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a class="social__icon vk" href="https://vk.com/id608634445" target="__blank" title="vk">
                <i class="fab fa-vk"></i>
              <a class="social__icon telegram-plane" href="#" title="telegram ">
                <i class="fab fa-telegram-plane"></i>   
              </a>
            </div> -->
            <script src ="js/main.js"></script>
            <script src ="js/yandex_map.js"></script>
     
</body>

</html>

