<?php
require_once "./models/page_model.php";
$cabinetData = null;
if (isset($_GET["ses"])) {
//    $_SESSION[] = добавить новые данные с автоматически влючаемым ключом
    $_SESSION["sess"] = $_GET["ses"];
}
if (isset($_SESSION["sess"])) {
    $cabinetData = "HELLO";
}

//количество посещений
$visit_count = null;
if (isset($_SESSION["visit_count"])) {
    $visit_count = $_SESSION["visit_count"] + 1;
}
$_SESSION["visit_count"] = $visit_count;
print("Количество посещений: " . $visit_count);


printData($_SESSION);