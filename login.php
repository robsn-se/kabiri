<?php
require_once "./controlers/page_controler.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Document</title>
</head>
<body>
    <div class="container_registration">
        <form action="">
            <div class="login">
                <label for="">Логин</label>
                <input placeholder="Логин" tabindex="1" name="username" type="text">
            </div>
            <div class="password">
                <label for="">Пароль</label>
                <input placeholder="Пароль" tabindex="2" name="username" type="password">
            </div>
            <div>
                <button type="submit" class="btn">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</body>
</html>