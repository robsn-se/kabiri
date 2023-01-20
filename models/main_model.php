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

function printData(mixed $data, bool $damp = false): void {
    echo "<br><pre>";
    $damp ? var_dump($data) : print_r($data);
    echo "</pre><br>";
}

/**
 * @throws Exception
 */
function validation(string $formName, array $formData, bool $checkFieldExist = true): void {
    if (!isset(VALIDATION_RULES[$formName])) {
        throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
    }
    $formRules = VALIDATION_RULES[$formName];
    if ($checkFieldExist && count($formData) !== count($formRules)) {
        throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
    }
    $statusMessage = [];
    foreach (VALIDATION_RULES[$formName] as $fieldName => $fieldValue) {
        if ($checkFieldExist && !isset($formData[$fieldName])) {
            throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
        }
        if (isset($fieldValue["required"]) && $fieldValue["required"] && !$formData[$fieldName]) {
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
    } elseif ((time() - SECONDS_OF_YEAR * MAX_USER_AGE) > strtotime($birthday)) {
        throw new Exception("К сожалению, Вы слишком старый");
    }
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

/**
 * @throws Exception
 */
function userRegistration(mysqli $connect, array $data): string {
    checkAge($data["birthday"]);
    if (mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '{$data["email"]}' OR `login` = '{$data["login"]}'"))) {
        throw new Exception("Пользователь с таким логином или email уже существует!");
    }
    $password = password_hash($data["password"], PASSWORD_DEFAULT);
    mysqli_query(
        $connect,
        "INSERT INTO `users` SET `email` = '{$data["email"]}', `login` = '{$data["login"]}', `password` = '{$password}', `birthday` = '{$data["birthday"]}';"
    );
    if ($data["id"] = mysqli_insert_id($connect)) {
        $hashResult = createConfirmationHash($data);
        mysqli_query($connect, "UPDATE `users` SET `confirmation_hash` = '{$hashResult}' WHERE `id` = '{$data["id"]}'");
        if (!sendEmailConfirmation($data, $hashResult)) {
            throw new Exception("Не удалось отправить подтверждение почты!");
        }
        return "Пользователь с логином {$_POST["login"]} успешно создан\nПроверьте почту, подтвердите адрес";
    }
    throw new Exception("Ошибка при создании пользователя");
}

function createConfirmationHash(array $userData): string {
    return hash("sha1", $userData["id"] . $userData["email"] . time());
}

function sendEmailConfirmation(array $userData, $hash): bool {
//    $to = $userData["email"];
//    $subject = 'the subject';
//    $message = 'hello';
//    $headers = 'From: kaberi.ru@mail.ru' . "\r\n" .
//        'Reply-To: kaberi.ru@mail.ru' . "\r\n" .
//        'X-Mailer: PHP/' . phpversion();
//
//    return mail($to, $subject, $message, $headers);

    $subject = 'Подтвердите Email на сайте';
    $message = 'message';
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = "To: {$userData["email"]}";
    $headers[] = 'From: <kaberi.ru@mail.ru>';
    return mail($userData["email"], $subject, $message, implode("\r\n", $headers));
}

//создаем функцию getTableItemsByFields() получить элементы таблицы по полям, то есть получаем все данные о пользователе
function getTableItemsByFields(mysqli $connect, string $table, array $fields, string $delimiter): array {
    $where = !empty($fields) ? (" WHERE " . createSQLSet($fields, $delimiter)) : "";
    $result = mysqli_query(
        $connect,
        "SELECT * FROM `{$table}`{$where};"
    );
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


/**
 * @throws Exception
 */
function dataChange(mysqli $connect, array $data): int|string {
    if (isset($data["birthday"])) {
        checkAge($data["birthday"]);
    }
    if (isset($data["email"])) {
        $result = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '{$data["email"]}'");
        $resultEmail = mysqli_fetch_assoc($result);
        if (!empty($resultEmail)) {
            throw new Exception("Пользователь с таким email уже существует!");
        }
    }
    if (isset($data["login"])) {
        $end = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '{$data["login"]}'");
        $endLogin = mysqli_fetch_assoc($end);
        if (!empty($endLogin)) {
            throw new Exception("Пользователь с таким email уже существует!");
        }
    }
    if (isset($data["password"], $data["old_password"])) {
        $checkUser = getTableItemsByFields($connect, "users", ["id" => $_SESSION["authorization"]["id"]], "");
        if (!password_verify($data["old_password"], $checkUser[0]["password"])) {
            throw new Exception("Не совпадает старый пароль");
        }
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        unset($data["old_password"]);
    }
    if (isset($_FILES["avatar"]) && !$_FILES["avatar"]["error"]) {
        $data["avatar"] = AVATAR_IMAGES . "/" . basename($_FILES["avatar"]["tmp_name"]);
        if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], "../" . $data["avatar"])) {
            throw new Exception("Проблема с загрузкой фото");
        }
    }
    $params = "";
    foreach ($data as $field => $value) {
        $params .= "`{$field}` = '{$value}', ";
    }
    $params = substr($params, 0, -2);
    mysqli_query($connect, "UPDATE `users` SET {$params} WHERE `id` = '{$_SESSION["authorization"]["id"]}'");
    updateSessionAuthorization($connect);
    if (($update = mysqli_affected_rows($connect)) < 1) {
        throw new Exception("Неудачное обновление");
    }
    return $update;
}

function updateSessionAuthorization(mysqli $connect): void {
    $_SESSION["authorization"] = getTableItemsByFields(
        $connect,
        "users",
        ["id" => $_SESSION["authorization"]["id"]],
        ""
    )[0];
}

function cabinet_exit(): void {
    unset($_SESSION["authorization"]);
    session_destroy();
    header("Location: /");
}

function printAnswer(string $status, ?string $message = null, array|string|int|null $data = null): void {
    echo json_encode(["status" => $status, "message" => $message, "data" => $data]);
}

function printError(string $message = "Что-то пошло не так", ?array $trace = null) {
    printAnswer(API_STATUS_ERROR, $message, $trace);
}
