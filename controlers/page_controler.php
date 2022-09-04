<?php
require_once "./config.php";
require_once "./models/page_model.php";

$connect = createConnect();
$actionsList = getActions($connect);
// echo "<pre>"; 
// print_r($actionsList);
// print_r($_POST);

if (isset($_POST["form_name"])) {
    if ($_POST["form_name"] == "registration") {
        $result = mysqli_query(
            $connect, 
            "INSERT INTO `users` SET `email` = '{$_POST["email"]}', `login` = '{$_POST["login"]}', `password` = '{$_POST["password"]}', `birthday` = '{$_POST["birthday"]}';"
        );

        print_r(mysqli_insert_id($connect));
    }
}
