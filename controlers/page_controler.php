<?php
require_once "./config.php";
require_once "./models/page_model.php";

//session_start(["cookie_lifetime" => 5]); время работы сессии
session_start();

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
$statusMessage = "";
if (isset($_POST["form_name"])) {
    $formName = $_POST["form_name"];
    unset($_POST["form_name"]);
    switch($formName) {
        case "registration":
            print_r(setUser($_POST));
            break;
        case "authorization":
            $userData = getTableItemsByFields($connect, "users", $_POST, "AND");
            if (!empty($userData)) { //проверяем, что мы получаем 1 пользователя
                $_SESSION["authorization"] = $userData[0];
                header("Location: /?page=cabinet");
            }
            else {
                $statusMessage = "Неверный логин или пароль";
//                echo "<script>alert('Неверный логин или пароль')</script>";
            }
            break;
        case "cabinet_exit":
            unset($_SESSION["authorization"]);
            session_destroy();
            header("Location: /");
            break;
        default:
            echo "НЕИЗВЕСТНАЯ ФОРМА";
    }
}