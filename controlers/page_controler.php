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
//            создаем функцию protectValue (защита значения) параметр т.е аргумент $value имеет 4 типа данных, функция
//            возвращает
            function protectValue(string|int|float|null $value): string|int|float|null {
                return (!$value || is_numeric($value)) ? $value : "'$value'";
            }
//            создаем функцию createFieldsString (создать строку полей)
            function createFieldsString(array $fields, string $delimiter): string {
                $fieldsString = "";
                foreach ($fields as $field => $value) {
                    $value = protectValue($value);
                    $fieldsString .=  "`{$field}` = {$value} {$delimiter}";
                }
                return substr($fieldsString, 0, -(strlen($delimiter) + 1));
            }
                function getTableItemsByFields(mysqli $connect, string $table, array $fields){
                mysqli_query(
                    $connect,
                    "SELECT * FROM `{$table}` WHERE " . createFieldsString($fields, "AND") . ";"
                );
            }
            print_r($_POST);
            break;
        default:
            echo "НЕИЗВЕСТНАЯ ФОРМА";
    }
}