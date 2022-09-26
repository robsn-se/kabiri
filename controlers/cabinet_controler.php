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

printData($_SESSION);
