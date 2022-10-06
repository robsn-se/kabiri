<?php
function createConnect(): mysqli {
    $connect = mysqli_connect(
        DB_HOST,
        DB_USER,
        DB_PASSWORD,
        DB_NAME
    );
    if (!$connect) {
        print_r('<br>' . 'Ошибка подключения (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        exit();
    }
    mysqli_query($connect, "SET NAMES utf8");
    return $connect;
}

function getActions(mysqli $connect):array {
    $tables = mysqli_query($connect, "SELECT a.`title`, u.`login` AS 'user', a.`likes` AS 'rating', ai.`url` AS 'image', a.`discription`, a.`date`, a.`address` FROM `actions` a
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


//1)создаем функцию protectValue для защиты значения от специальных символов например:srlgjeorghuie
//2)параметр т.е аргумент $value имеет 4 типа данных,
//3) возвращает функция: не $value(то есть если другой тип данных) и is_numeric($value)
function protectValue(string|int|float|null $value): string|int|float|null {
    return (!$value || is_numeric($value)) ? $value : "'$value'";
}
//создаем функцию createFieldsString (создать строку полей)
function createFieldsString(array $fields, string $delimiter): string {
    $fieldsString = "";
    foreach ($fields as $field => $value) {
        $value = protectValue($value);
        $fieldsString .=  "`{$field}` = {$value} {$delimiter}";
    }
    return substr($fieldsString, 0, -(strlen($delimiter) + 1));
}
//создаем функцию getTableItemsByFields() получить элементы таблицы по полям
function getTableItemsByFields(mysqli $connect, string $table, array $fields, string $delimiter): array
{
    $result = mysqli_query(
        $connect,
        "SELECT * FROM `{$table}` WHERE " . createFieldsString($fields, $delimiter) . ";"
    );
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
