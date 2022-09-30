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

if (isset($_POST["form_name"])) {
    switch($_POST["form_name"]) {
        case "registration":
            print_r(setUser($_POST));
            break;
        case "authorization":
            print_r($_POST);
            break;
        default:
            echo "НЕ ИЗВЕСТНАЯ ФОРМА";
    }
}

