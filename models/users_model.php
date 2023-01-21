<?php
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
