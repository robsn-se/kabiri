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
function validation(bool $skipCheckingEmptyRequests = false): ?string {
    unset($_REQUEST["PHPSESSID"], $_REQUEST["__ddg1_"] );
    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $_REQUEST = $_REQUEST + json_decode(file_get_contents("php://input"), true);
    }
    if ($skipCheckingEmptyRequests && empty($_REQUEST)){
        return null;
    }

    if (!isset($_REQUEST[VALIDATION_FORM_NAME])) {
        throw new Exception("Неопределенная форма");
    }

    $formName = $_REQUEST[VALIDATION_FORM_NAME];
    unset($_REQUEST[VALIDATION_FORM_NAME]);

    if (!isset(VALIDATION_RULES[$formName])) {
        throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
    }

    if ($_SERVER["REQUEST_METHOD"] !== VALIDATION_RULES[$formName][VALIDATION_REQUEST_METHOD]) {
        throw new Exception("НЕКОРРЕКТНЫЙ МЕТОД ЗАПРОСА");
    }

    $formFields = VALIDATION_RULES[$formName][VALIDATION_FORM_FIELDS];
    if (VALIDATION_RULES[$formName][VALIDATION_FIELDS_COUNT_CHECK] && count($_REQUEST) !== count($formFields)) {
        throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
    }

    $statusMessage = [];
    foreach (VALIDATION_RULES[$formName][VALIDATION_FORM_FIELDS] as $fieldName => $fieldValue) {
        if (
            isset($fieldValue[VALIDATION_FIELD_EXISTENCE])
            && $fieldValue[VALIDATION_FIELD_EXISTENCE]
            && !isset($_REQUEST[$fieldName])
        ) {
            throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
        }

        if (
            isset($fieldValue[VALIDATION_FIELD_REQUIRED])
            && $fieldValue[VALIDATION_FIELD_REQUIRED]
            && !$_REQUEST[$fieldName]
        ) {
            $statusMessage[] = "Поле $fieldName не заполнено";
        }

        if (
            @$fieldValue["pattern"]
            && @$_REQUEST[$fieldName]
            && !preg_match($fieldValue["pattern"], $_REQUEST[$fieldName])
        ) {
            $statusMessage[] = "Поле $fieldName не корректно заполнено";
        }
    }

    if (!empty($statusMessage)) {
        throw new Exception(implode("<br>", $statusMessage));
    }
    return $formName;
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
function getTableItemsByFields(mysqli $connect, string $table, array $fields, string $delimiter = ""): array {
    $where = !empty($fields) ? (" WHERE " . createSQLSet($fields, $delimiter)) : "";
    $result = mysqli_query(
        $connect,
        "SELECT * FROM `{$table}`{$where};"
    );
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function printAnswer(string $status, ?string $message = null, array|string|int|null $data = null): void {
    echo json_encode(["status" => $status, "message" => $message, "data" => $data], JSON_UNESCAPED_UNICODE);
}

function printError(string $message = "Что-то пошло не так", ?array $trace = null) {
    printAnswer(API_STATUS_ERROR, $message, $trace);
}
