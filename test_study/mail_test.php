<?php
function sendEmailConfirmation(array $userData, $hash): bool {
    $subject = 'Подтвердите Email на сайте';
    $message = '<p>Подтвердите почту</p>';
//    $headers[] = 'MIME-Version: 1.0';
    $headers[] = "Content-type: text/html; charset=utf-8";
    $headers[] = "From: Регистрация My AutoPosting <rubiserobyan17@mail.ru>";
    $headers[] = "Reply-To: rubiserobyan17@mail.ru";
//    $headers[] = 'From: <kaberi.ru@mail.ru>';
//    $headers[] = 'Replay-To: rubiserobyan17@mail.ru';
//    $headers[] = 'X-Mayler: PHP/' . PHP_VERSION;
//    $headers[] = 'Content-type: text/html; charset=UTF-8';
//    $headers[] = "To: {$userData["email"]}";
    return mail("<{$userData["email"]}>,", $subject, $message, implode("\r\n", $headers));
}
$userData = ["id"=>5, "email"=>"rubenserobyan410@gmail.com"];
if (sendEmailConfirmation($userData, "eurghkrngoerngoernvkrnffi")) {
    exit("success");
}
echo "error";
