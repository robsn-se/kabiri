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
    $tables = mysqli_query($connect, "SELECT a.`title`, u.`login` AS 'user', a.`likes` AS 'rating', ai.`url` AS 'image', a.`discription`, a.`date`, a.`address` FROM `actions` a
    LEFT JOIN `users` u ON u.`id` = a.`user`
    LEFT JOIN `actions_images` ai ON a.`id` = ai.`action`;");
    return mysqli_fetch_all($tables, MYSQLI_ASSOC);
}

/**
 * @throws Exception
 */
function setUser(array $data): int|string {
    global $connect;
    mysqli_query(
        $connect,
        "INSERT INTO `users` SET `email` = '{$data["email"]}', `login` = '{$data["login"]}', `password` = '{$data["password"]}', `birthday` = '{$data["birthday"]}';"
    );
    return mysqli_insert_id($connect) || throw new Exception("Ошибка при создании пользователя");
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
//создаем функцию getTableItemsByFields() получить элементы таблицы по полям то есть получаем все данные о пользователе
function getTableItemsByFields(mysqli $connect, string $table, array $fields, string $delimiter): array
{
    $result = mysqli_query(
        $connect,
        "SELECT * FROM `{$table}` WHERE " . createFieldsString($fields, $delimiter) . ";"
    );
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * @throws Exception
 */

function validation(string $formName, array $formData): void {
    $statusMessage = [];
    if (count($formData) !== count(VALIDATION_RULES[$formName])) {
        $statusMessage[] = "Не соответствие количества полей";
    }

    foreach (VALIDATION_RULES[$formName] as $fieldName => $fieldValue) {
        if (!isset($formData[$fieldName])) {
            $statusMessage[] = "Не найдено поле $fieldName в форме $formName";
        }
        if ($fieldValue["required"] && !$formData[$fieldName]){
            $statusMessage[] = "Поле $fieldName не заполнено";
        }
        if (
            @$fieldValue["pattern"]
            && @$formData[$fieldName]
            && !preg_match($fieldValue["pattern"], $formData[$fieldName])
        ) {
            $statusMessage[] = "Поле $fieldName не корректно заполнено";
        }
    }
    if (!empty($statusMessage)) {
        throw new Exception(implode("<br>", $statusMessage));
    }
}

/**
 * @throws Exception
 */
function checkAge(string $birthday): void {
    if ((time() - SECONDS_OF_YEAR * MIN_USER_AGE) < strtotime($birthday)) {
        throw new Exception("К сожалению, Вы слишком молоды");
    }
    elseif ((time() - SECONDS_OF_YEAR * MAX_USER_AGE) > strtotime($birthday)) {
        throw new Exception("К сожалению, Вы слишком старый");
    }
}