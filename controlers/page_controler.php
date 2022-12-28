<?php
require_once "./config.php";
require_once "./validation_rules.php";
require_once "./models/page_model.php";

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
        validation($formName, $_POST);
        switch($formName) {
            case "registration":
                $statusMessage = userRegistration($connect, $_POST);
                break;
            case "authorization":
                authorization($connect, $_POST);
                break;
            case "cabinet_exit":
                cabinet_exit();
                break;
            default:
                throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
        }
    }
} catch (Throwable $e) {
    file_put_contents(
        "logs/log.log",
        date("d-m-Y H:i:s") . " ==> {$e->getMessage()} | {$e->getFile()}({$e->getLine()}) \n{$e->getTraceAsString()} \n\n",
        FILE_APPEND
    );
    if (!$e->getCode()){
        $statusMessage = $e->getMessage();
    }
    else{
        $statusMessage = "Ой, что то пошло не так!\n Повторите действие позднее или обратитесь к администратору";
    }
}













