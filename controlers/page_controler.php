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
        validation($formName, $_POST, $statusMessage);
        switch($formName) {
            case "registration":
                checkAge($_POST["birthday"]);
                print_r(setUser($_POST));
                break;
            case "authorization":
                $userData = getTableItemsByFields($connect, "users", $_POST, "AND");
                if (!empty($userData)) { //проверяем, что мы получаем 1 пользователя
                    $_SESSION["authorization"] = $userData[0];
                    header("Location: /?page=cabinet");
                }
                else {
                    throw new Exception("Неправильно указан логин и/или пароль");
                }
                break;
            case "cabinet_exit":
                unset($_SESSION["authorization"]);
                session_destroy();
                header("Location: /");
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
