<?php
require_once "../config.php";
require_once "../validation_rules.php";
require_once "../main_params.php";
require_once "../models/main_model.php";
require_once "../models/users_model.php";
require_once "../models/action_model.php";
echo "OK";
session_start();
try {
    $connect = createConnect();
    if (isset($_POST["form_name"])) {
        $formName = $_POST["form_name"];
        unset($_POST["form_name"]);
        validation($formName, $_POST);
        switch ($formName) {
            case "get_action_by_id":
                printAnswer(
                    API_STATUS_OK,
                    null,
                    $_POST
                );
                break;
            default:
                throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
        }
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
