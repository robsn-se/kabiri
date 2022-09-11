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
        <div class="social">
            <a class="social__icon twitter" href="#" title="twitter">
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
<article>
    <div class="smol">
        <h2>Место, где люди защищают друг друга</h2>
        <div class="button">
            <a href="https://kaberi.ru/login.php" target="_blank" class="btn">Зарегистрироваться</a>
        </div>
        <h4 style="text-align: center; color:  rgb(255, 255, 255); font-family: 'Roboto', sans-serif; font-weight: 200; font-size: 20px;">
            Подключайтесь и живите в безопасности.
            <strong>Kaberi</strong> - это приложение личной безопасности,
            которое дает вам возможность защитить себя, а также людей и места,
            которые вам небезразличны. Kaberi предоставляет Вам  уведомления на основе
            местоположения и помогает избежать потенциально опасные ситуации.
        </h4>
          <hr>
          <h1>Вместе строим будущее общественной безопасности</h1>
    </div>
    <div class="map_smolensk">
        <div id="map"></div>
    </div>
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
        <a href="https://kaberi.ru/login.php" target="_blank" class="btn">Зарегистрироваться</a>
    </div>
</article>
<script src ="js/main.js"></script>
<script src ="js/yandex_map.js"></script>
</body>
</html>
