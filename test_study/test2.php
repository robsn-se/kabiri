<?php

const USER_CONST = "Василий";
// define("TEST_CONST2", "Привет, мир!");
$userName = "Петя";
$result = "Привет, " . USER_CONST . "!";
$result .= "Привет, \${$userName}_!";



echo $result;

$platoon = [ 
    "lieutenant" => [
        "name" => "Рубен", 
        "position" => "КВ", 
        "age" => 23,
    ],
    "elderSergeant1" => [
        "name" => "Илья",
        "position" => "ЗКВ",
        "age" => 35,
    ],
    "elderSergeant2" => [
        "name" => "Роман",
        "position" => "С-И",
        "age" => 29,
    ],     
    "sergeant1" => [
        "name" => "Женёк",
        "position" => "С-И",
        "age" => 27,       
    ],    
    "sergeant2" => [
        "name" => "Балон",
        "position" => "С-И",
        "age" => 31,
    ],     
    "sergeant3" => [
        "name" => "Артем",
        "position" => "С-И",
        "age" => 29,
    ],     
    "elderSergeant3" => [
        "name" => "Старый",
        "position" => "И",
        "age" => 42,
    ],
    "corporal1" => [
        "name" => "Валера",
        "position" => "И",
        "age" => 26,
    ],
    "corporal2" => [
        "name" => "Саня Баф",
        "position" => "И",
        "age" => 31,
    ],
    "corporal3" => [
        "name" => "Усач",
        "position" => "И",
        "age" => 27,
    ],
    "lanceSergeant1" => [
        "name" => "Димон",
        "position" => "И",
        "age" => 26,
    ],
    "corporal4" => [
        "name" => "Саня Баф",
        "position" => "И",
        "age" => 31,
    ],
    "corporal5" => [
        "name" => "Лысый",
        "position" => "И",
        "age" => 25,
    ],
    "sergeantMajor" => [
        "name" => "Фил",
        "position" => "И-В",
        "age" => 42,     
    ],
    "lanceSergeant2" => [
        "name" => "Дрозд",
        "position" => "И-В",
        "age" => 30,  
    ],   
    "corporal6" => [
        "name" => "Артурио",
        "position" => "И-В",
        "age" => 32,  
    ],      
];
echo "<pre>";
// print_r($testArr["elderSergeant1"]["name"]);


// lieutenant: {
//     name: "Рубен",
//     position: "КВ",
//     age: 23
// },
// elderSergeant1:  {
//     name: "Илья",
//     position: "ЗКВ",
//     age: 35
// },    

$colors = array("red", "green", "blue", "gray", "yellow");
$counter = 0;
// echo $colors[1];
// while($counter < count($colors)){
//     echo $colors[$counter++];
// }

for($counter = 0; $counter < count($colors); $counter++){
    echo $colors[$counter];
}
//  исходный массив     ключи      значения или ссылки, если с &      
// foreach($platoon as $rangKey => &$unitValue){
 
//     if ($unitValue["age"] > 27){
//         continue;
//     }
//     $unitValue["age"] += 2;
// }
// print_r($platoon);

// foreach($platoon as $rangKey => &$unitValue){
//     foreach($unitValue as $paramKey => &$paramValue){
//         if($paramKey == "position"){
//             if($paramValue == "И-В"){
//                 continue(2);
//             }
//             $paramValue = "И-В";
//         }
//     }
//     if ($unitValue["age"] > 27){
//         continue;
//     }
//     $unitValue["age"] += 2;
// }
// print_r($platoon);

function addAge(array $people, int $yersCount = 2):array {
    foreach($people as $rangKey => &$unitValue){
        $unitValue["age"] += $yersCount;
    }
    return $people;
}
// print_r(addAge($platoon, 5));

// function getName(string $rang, array $people):string {
//     return $people[$rang]["name"];
// }
// print_r(getName("sergeantMajor", $platoon));

function getSoldierName(string $rang):string {
    global $platoon;
    return $platoon[$rang]["name"];
}
print_r(getSoldierName("sergeantMajor"));




// Обращение с помощью & т.е. обращаемся непосредственно к массиву без копий
// с ипользованием "void" и в этом примере мы обращаемся к функции editNameByRang("lieutenant", "Павел", $platoon);

// function editNameByRang(string $rang, string $newName, array &$people):void {
//     $people[$rang]["name"] = $newName;
// }
// editNameByRang("lieutenant", "Павел", $platoon);



// Использование с копией и здесь происходит присвоение массива и функции 
// (если копия) $platoon = editNameByRang("lieutenant", "Павел", $platoon);
 
// function editNameByRang(string $rang, string $newName, array $people):array {
//     $people[$rang]["name"] = $newName;
//     return $people;
// }
// $platoon = editNameByRang("lieutenant", "Павел", $platoon);
$editNames = [
    "corporal5" => "Кирилл",
    "sergeantMajor" => "Вадим",
    "corporal3" => "Дима",
];


// function editNameByRang(array $newNames, array $people):array {
//     foreach($newNames as $rang => $name){
//         if(isset($people[$rang])){
//             $people[$rang]["name"] = $name;
//         }
//     }
//     return $people;
// }
// $platoon = editNameByRang($editNames, $platoon);


function editNameByRang(array $newNames, array &$people):void {
    foreach($newNames as $rang => $name){
        if(isset($people[$rang])){
            $people[$rang]["name"] = $name;
        }
    }
}
editNameByRang($editNames, $platoon);
// print_r($platoon);


const DB_HOST = "31.31.198.123";
const DB_USER = "u1571961_kaberi";
const DB_PASSWORD = "Ser-1988";
const DB_NAME = "u1571961_kaberi";

function createConnect(){
    $sqlConnect = mysqli_connect(
        DB_HOST,
        DB_USER,
        DB_PASSWORD,
        DB_NAME
    );
    if (!$sqlConnect) {
        print_r('<br>' . 'Ошибка подключения (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        exit();
    }
    mysqli_query($sqlConnect, "SET NAMES utf8");
    return $sqlConnect;
}

// if (!$sqlConnect) {
//     print_r('<br>' . 'Ошибка подключения (' . mysqli_connect_errno(эта функция возвращает номер ошибки) . ') '. mysqli_connect_error(эта функция выводит текст(сообщение) об ошибке));
//     exit(функция которая останавливает продолжение всяких php скриптов;  полсе exit php заканчивается);
// НАПРИМЕР ОШИБКА В НАПИСАНИИ DB_USER, И ТОГДА СРАБАТЫВАЮТ ЭТИ ДВЕ ФУНКЦИИ: mysqli_connect_errno()  -  mysqli_connect_error();
// }
// mysqli_query($sqlConnect, "SET NAMES utf8"); mysqli_query (эта функция выполняет запрос к базе данных mysql)
// return $sqlConnect;


// print_r(mysqli_fetch_all($tables)); mysqli_fetch_all(ЭТА ФУНКЦИЯ возвращает двухмерный массив, содержащий все записи, начиная от указателя и до конца результата )



$dbConnect = createConnect();
$tables = mysqli_query($dbConnect, "SELECT a.`title` AS 'action', u.`name` AS 'user', a.`likes` AS 'rating', ai.`url` AS 'image', a.`discription` FROM `actions` a
LEFT JOIN `users` u ON u.`id` = a.`user`
LEFT JOIN `actions_images` ai ON a.`id` = ai.`action`;");
print_r(mysqli_fetch_all($tables, MYSQLI_ASSOC));
