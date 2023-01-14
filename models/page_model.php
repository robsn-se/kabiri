<?php
/**
 * @throws Exception
 */
function createConnect(): mysqli {
    $connect = mysqli_connect(
        DB_HOST,
        DB_USER,
        DB_PASSWORD,
        DB_NAME
    );
    if (!$connect) {
        throw new Exception('<br>' . 'Ошибка подключения (' . mysqli_connect_errno() . ') '. mysqli_connect_error(), 1);
    }
    mysqli_query($connect, "SET NAMES utf8");
    return $connect;
}

function getActions(mysqli $connect):array {
    $tables = mysqli_query($connect, "SELECT a.`title`, u.`login` AS 'user', a.`likes` AS 'rating', ai.`url` AS 'image', a.description, a.`date`, a.`address` FROM `actions` a
    LEFT JOIN `users` u ON u.`id` = a.`user`
    LEFT JOIN `actions_images` ai ON a.`id` = ai.`action`;");
    return mysqli_fetch_all($tables, MYSQLI_ASSOC);
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

//создаем функцию createFieldsString (создать строку полей) для sql запроса
function createSQLSet(array $fields, string $delimiter = ""): string {
    $fieldsString = "";
    foreach ($fields as $field => $value) {
        $value = protectValue($value);
        $fieldsString .=  "`{$field}` = {$value} {$delimiter}";
    }
    return substr($fieldsString, 0, -(strlen($delimiter) + 1));
}
//создаем функцию getTableItemsByFields() получить элементы таблицы по полям, то есть получаем все данные о пользователе
/**
 * @throws Exception
 */
function authorization(mysqli $connect, array $authorizationData): void {
    $password = $authorizationData["password"];
    unset($authorizationData["password"]);
    $userData = getTableItemsByFields($connect, "users", $authorizationData, "");
    if (password_verify($password, $userData[0]["password"])){
        $_SESSION["authorization"] = $userData[0];
        header("Location: /?page=cabinet");
    }
    else {
        throw new Exception("Неправильно указан логин и/или пароль");
    }
}


function printAnswer(string $status, ?string $message = null, array|string|int|null $data = null): void {
    echo json_encode(["status" => $status, "message" => $message, "data" => $data]);
}

function printError(string $message = "Что-то пошло не так", ?array $trace = null) {
    printAnswer(API_STATUS_ERROR, $message, $trace);
}
