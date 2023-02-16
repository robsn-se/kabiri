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

function saveImages(array $files, string $folderPath): array {
    $imageUrls = [];
    foreach ($files["name"] as $key => $fileName) {
        if ($fileName && !$files["error"][$key]) {
            $imageUrls[] = $imageUrl = $folderPath . "/" . basename($files["tmp_name"][$key]);
            if (!move_uploaded_file($files["tmp_name"][$key], "../" . $imageUrl)) {
                throw new Exception("Проблема с загрузкой файла {$fileName}");
            }
        }
    }

    return $imageUrls;
}

function getActions(mysqli $connect):array {
    $tables = mysqli_query($connect, "SELECT a.`title`, u.`login` AS 'user', a.`likes` AS 'rating', ai.`url` AS 'image', a.description, a.`date`, a.`address` FROM `actions` a
    LEFT JOIN `users` u ON u.`id` = a.`user`
    LEFT JOIN `actions_images` ai ON a.`id` = ai.`action`;");
    return mysqli_fetch_all($tables, MYSQLI_ASSOC);
}