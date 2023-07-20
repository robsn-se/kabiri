<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "../main_params.php";
require_once "../config.php";
require_once "../validation_rules.php";
require_once "../models/main_model.php";
require_once "../models/users_model.php";
require_once "../models/action_model.php";
session_start();

try {
    $connect = createConnect();
    switch (validation()) {
        case "get_action_by_id":
            printAnswer(
                API_STATUS_OK,
                null,
                getActionByID($connect, $_REQUEST["action_id"])
            );
            break;
        default:
            throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
    }
} catch (Throwable $e) {
    file_put_contents(
        "../logs/log.log",
        date("d-m-Y H:i:s") . " ==> {$e->getMessage()} | {$e->getFile()}({$e->getLine()}) \n{$e->getTraceAsString()} \n\n",
        FILE_APPEND
    );
    if (!$e->getCode()) {
        $statusMessage = $e->getMessage();
    } else {
        $statusMessage = "Ой, что то пошло не так!\n Повторите действие позднее или обратитесь к администратору";
    }
    printError($statusMessage);
}
