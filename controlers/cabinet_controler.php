<?php
require_once "../config.php";
require_once "../validation_rules.php";
require_once "../models/page_model.php";

//session_start(["cookie_lifetime" => 5]); время работы сессии
session_start();
$statusMessage = "";
$actionsList = [];
try {
    $connect = createConnect();
    $actionsList = getActions($connect);
    if (isset($_POST["form_name"])) {
        $formName = $_POST["form_name"];
        unset($_POST["form_name"]);
//        validation($formName, $_POST);
        switch($formName) {
            case "setting":
                $params = "";
                foreach ($_POST as $field => $value) {
                    $params .= "`{$field}` = '{$value}', ";
                }
                $params = substr($params, 0, -2);
                $update = mysqli_query($connect, "UPDATE `users` SET {$params} WHERE `id` = {$_SESSION["authorization"]["id"]}");
                echo json_encode(mysqli_affected_rows($connect) ? "ok" : "error");
                break;
            default:
                throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
        }
    }
} catch (Throwable $e) {
    if (!$e->getCode()){
        $statusMessage = $e->getMessage();
    }
    else{
        file_put_contents(
            "logs/log.log",
            date("d-m-Y H:i:s") . " ==> {$e->getMessage()} | {$e->getFile()}({$e->getLine()}) \n{$e->getTraceAsString()} \n\n",
            FILE_APPEND
        );
        $statusMessage = "Ой, что то пошло не так!\n Повторите действие позднее или обратитесь к администратору";
    }
}
