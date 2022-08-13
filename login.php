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
            <h3>Регистрация</h3>
            <div class="login">
                <label for=""><b>Логин</b></label>
                <input placeholder="Введите логин" tabindex="1" name="username" type="text">
            </div>
            <div class="password">
                <label for=""><b>Пароль</b></label>
                <input placeholder="Введите пароль" tabindex="2" name="username" type="password">
            </div>
            <div>
                <button type="submit" class="btn">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</body>
</html>