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
    // echo "<pre>";
    // print_r($actionsList);
    // print_r($_POST);

    //if (isset($_POST["form_name"])) {
    //    if ($_POST["form_name"] == "registration") {
    //        print_r(setUser($_POST));
    //    }
    //    elseif ($_POST["form_name"] == "authorization") {
    //        print_r(setUser($_POST));
    //    }
    //    else {
    //        echo "НЕ ИЗВЕСТНАЯ ФОРМА";
    //    }
    //}
    //printData($_POST["birthday"]);
    //print_r($_POST["form_name"]);
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
    //            [a-zA-Z\d\-_]{2,50} Логин "akep_82-QP"
    //            [a-zA-Z\d\-_]{8,30} пароль "Roma-5225_i"
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
    $statusMessage = $e->getMessage();
//    echo "<script>alert(\"{$e->getCode()}\");</script>";
//    echo "<script>alert(\"{$e->getFile()}\");</script>";
//    echo "<script>alert(\"{$e->getLine()}\");</script>";
//    echo "<script>alert(\"{$e->getTrace()}\");</script>";
//    echo "<script>alert(\"{$e->getTraceAsString()}\");</script>";

}

