<?php
function name() {
    echo "Это моё имя";
}
//name(); вызов функции


//          указано 2 аргумента
function myCar($car, $color) {
    echo "Марка машины: $car и она имеет $color цвет";
}
$color = "белый";
// вызываем функцию и передаем ей 2 аргумента
myCar("Lexus", $color);

function firstName($fname, $year) {
    echo "$fname Иванова. Родилась в $year <br>";
}
firstName("biba", "1991");