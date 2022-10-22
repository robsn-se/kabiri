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
const VALIDATION_RULES = [
    "authorization" => [
        "login" => [
            "required" => true,
            "pattern" => "/[a-zA-Z\d\-_]{2,50}/",
        ],
        "password" => [
            "required" => true,
            "pattern" => "/[a-zA-Z\d\-_]{2,30}/",
        ]
    ]
];
echo  VALIDATION_RULES["authorization"]["password"]["pattern"];
$statusMessage = "";
if (isset($_POST["form_name"])) {
    print_r($_POST);
    $formName = $_POST["form_name"];
    unset($_POST["form_name"]);
    switch($formName) {
        case "registration":
//            [a-z\d\-_]{2,100}@[a-z\d\-_]{2,30}\.[a-z]{2,10} Email
            print_r(setUser($_POST));
            break;
        case "authorization":
            if (count($_POST) !== count(VALIDATION_RULES["authorization"])) {
                $statusMessage = "Не соответствие количества полей";
                exit();
            }
            foreach ($_POST as $fieldName => $fieldValue) {

            }
            if (@$_POST["login"] && @$_POST["password"]) {
                $statusMessage = "Названия полей не соответствуют форме";
                exit();
            }
            if (preg_match("/[a-zA-Z\d\-_]{2,50}/", $_POST["login"])) {
                $userData = getTableItemsByFields($connect, "users", $_POST, "AND");
                if (!empty($userData)) { //проверяем, что мы получаем 1 пользователя
                    $_SESSION["authorization"] = $userData[0];
                    header("Location: /?page=cabinet");
                }
                else {
                    $statusMessage = "Неправильно указан логин и/или пароль";
//                echo "<script>alert('Неверный логин или пароль')</script>";
                }
            }
            else {
                $statusMessage = "ERROR";
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
            echo "НЕИЗВЕСТНАЯ ФОРМА";
    }
}
