<?php
session_start();

require_once "../main_params.php";
require_once "../config.php";
require_once "../validation_rules.php";
require_once "../models/main_model.php";
require_once "../models/users_model.php";
require_once "../models/action_model.php";

$statusMessage = "";
$actionsList = [];
try {
    $connect = createConnect();
    $actionsList = getActions($connect);
    switch(validation()) {
        case "setting":
            printAnswer(
                API_STATUS_OK,
                "Данные успешно обновлены",
                dataChange($connect, $_POST)
            );
            break;
        case "add_action":
//                printData($_FILES);
            printAnswer(
                API_STATUS_OK,
                addAction($connect, $_POST),
            );
            break;
//                printAnswer(
//                    API_STATUS_OK,
//                    null,
//                    getActionByID($connect, $_POST["action_id"])
//                );
            break;
        default:
            throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
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