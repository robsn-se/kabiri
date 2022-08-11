<?php
require_once "./config.php";
require_once "./models/page_model.php";

$connect = createConnect();
$actionsList = getActions($connect);
// echo "<pre>"; 
// print_r($actionsList);