<?php
function createConnect(): mysqli {
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

function getActions(mysqli $dbConnect):array {
    $tables = mysqli_query($dbConnect, "SELECT a.`title`, u.`login` AS 'user', a.`likes` AS 'rating', ai.`url` AS 'image', a.`discription`, a.`date`, a.`address` FROM `actions` a
    LEFT JOIN `users` u ON u.`id` = a.`user`
    LEFT JOIN `actions_images` ai ON a.`id` = ai.`action`;");
    return mysqli_fetch_all($tables, MYSQLI_ASSOC);
}

function setUser(array $data): int|string {
    global $connect;
    mysqli_query(
        $connect,
        "INSERT INTO `users` SET `email` = '{$data["email"]}', `login` = '{$data["login"]}', `password` = '{$data["password"]}', `birthday` = '{$data["birthday"]}';"
    );
    return mysqli_insert_id($connect);
}

function printData(mixed $data, bool $damp = false): void {
    echo "<br><pre>";
    $damp ? var_dump($data) : print_r($data);
    echo "</pre><br>";
}
