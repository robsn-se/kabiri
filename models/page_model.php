<?php
function createConnect(){
    $sqlConnect = mysqli_connect(
        DB_HOST,
        DB_USER,
        DB_PASSWORD,
        DB_NAME
    );
    if (!$sqlConnect) {
        print_r('<br>' . 'Ошибка подключения (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        exit();
    }
    mysqli_query($sqlConnect, "SET NAMES utf8");
    return $sqlConnect;
}

function getActions($dbConnect):array {
    $tables = mysqli_query($dbConnect, "SELECT a.`title`, u.`name` AS 'user', a.`likes` AS 'rating', ai.`url` AS 'image', a.`discription`, a.`date`, a.`address` FROM `actions` a
    LEFT JOIN `users` u ON u.`id` = a.`user`
    LEFT JOIN `actions_images` ai ON a.`id` = ai.`action`;");
    return mysqli_fetch_all($tables, MYSQLI_ASSOC);
}