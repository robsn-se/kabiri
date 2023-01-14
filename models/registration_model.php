<?php
/**
 * @throws Exception
 */
function userRegistration(mysqli $connect, array $data): string {
    checkAge($data["birthday"]);
    if (mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `users` WHERE `email` = '{$data["email"]}' OR `login` = '{$data["login"]}'"))){
        throw new Exception("Пользователь с таким логином или email уже существует!");
    }
    $password = password_hash($data["password"],PASSWORD_DEFAULT);
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