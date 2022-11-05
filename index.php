<?php require_once "./controlers/page_controler.php"; ?>
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
            <a class="heder_logo" href="/">
                <img src="./images/логотип.gif" alt="" width="70px">
            </a>
            <h1>KABERI</h1>
        </div>
        <div class="social">
            <a class="social__icon twitter" href="#" title="twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="social__icon vk" href="https://vk.com/id608634445" target="__blank" title="vk">
                <i class="fab fa-vk"></i>
            <a class="social__icon telegram-plane" href="#" title="telegram">
                <i class="fab fa-telegram-plane"></i>
            </a>
            <a class="social__icon youtube" href="#" title="youtube">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
    </div>
</header>
<article>
    <?php
    if (isset($_GET["page"]) && file_exists("view_templates/pages/{$_GET["page"]}.php")) {
        include "view_templates/pages/{$_GET["page"]}.php";
    }
    else {
        include "view_templates/pages/main.php";
    }
    if ($statusMessage){
        echo "<script>alert(\"{$statusMessage}\");</script>";
    }
    ?>
</article>
<script src ="js/main.js"></script>
<script src ="js/yandex_map.js"></script>
</body>
</html>
