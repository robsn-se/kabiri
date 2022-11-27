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
    <?php include "view_templates/header.php"; ?>
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
<script src="js/main.js"></script>
<script src="js/yandex_map.js"></script>
</body>
</html>
