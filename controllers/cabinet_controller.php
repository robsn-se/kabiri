<?php
require_once "../config.php";
require_once "../main_params.php";
require_once "../validation_rules.php";
require_once "../models/page_model.php";
require_once "../models/action_model.php";
require_once "../models/cabinet_model.php";
require_once "../models/validation_model.php";

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
        validation($formName, $_POST, $formName != "setting");
        switch($formName) {
            case "setting":
                printAnswer(
                    API_STATUS_OK,
                    "Данные успешно обновлены",
                    dataChange($connect, $_POST)
                );
                break;
            case "add_action":
                printAnswer(
                    API_STATUS_OK,
                    addAction($connect, $_POST),
                );
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
        $statusMessage = "Ой, что то пошло не так!\n Повторите действие позднее или обратитесь к администратору";
    }
    file_put_contents(
        "../logs/log.log",
        date("d-m-Y H:i:s") . " ==> {$e->getMessage()} | {$e->getFile()}({$e->getLine()}) \n{$e->getTraceAsString()} \n\n",
        FILE_APPEND
    );
    printError($statusMessage);
}