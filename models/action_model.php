<?php
/**
 * @throws Exception
 */
function addAction(mysqli $connect, array $data): string {
    unset($data["action_images"]);
    mysqli_query(
        $connect,
        "INSERT INTO `actions` SET `user` = '{$_SESSION["authorization"]["id"]}', " . createSQLSet($data, ",") . ";"
    );
    if ($actionId = mysqli_insert_id($connect)) {
        return "Событие №{$actionId} успешно добавлено";
    }
    throw new Exception("Ошибка при добавлении события");

}