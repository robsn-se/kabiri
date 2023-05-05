<?php
print_r($_POST);
print_r($_GET);

require_once "../config.php";
require_once "../validation_rules.php";
require_once "../main_params.php";
require_once "../models/main_model.php";
require_once "../models/users_model.php";
require_once "../models/action_model.php";

//session_start(["cookie_lifetime" => 5]); время работы сессии
session_start();
//echo "check";
$statusMessage = "";
$actionsList = [];
try {
    $connect = createConnect();
    print_r($_POST);
    $actionsList = getActions($connect);
    if (isset($_POST["form_name"])) {
        $formName = $_POST["form_name"];
        unset($_POST["form_name"]);
//        validation($formName, $_POST, $formName != "setting");
        echo $formName;
        switch($formName) {
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
            case "get_action_by_id":
                printAnswer(
                    API_STATUS_OK,
                    null,
                   $_POST
                );
//                printAnswer(
//                    API_STATUS_OK,
//                    null,
//                    getActionByID($connect, $_POST["action_id"])
//                );
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