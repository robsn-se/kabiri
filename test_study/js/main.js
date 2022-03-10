"use strict";
// console.log("HELLO");

const MY_NAME = "Ruben";
console.log(MY_NAME);
console.log(MY_NAME.length);
console.log(MY_NAME.charAt(4));
console.log(MY_NAME.indexOf ('en'));

let myChar;
myChar = "1" - 1;
myChar = null;
myChar = true;
myChar = false;
// console.log(myChar);


// let myRandom = Math.round(5 + Math.random() * (20 - 5));
// console.log(myRandom);
const students = ['Петя', 'Вася', 'Коля', 'Максим'];
for (let i = 0, length = students.length; i < length; i++) {
  console.log( students[i] );
}





// ФУНКЦИЯ "РАНДОМ ГЕНЕРАТОР ЧИСЕЛ"
// function randomMethot(min, max){
//     let myRandom = Math.round(min+ Math.random() * (max - min));
//     console.log(myRandom);
//     return myRandom; 
// }

// let myRandom = randomMethot(3, 36);
// let myRandom2 = randomMethot(9, 45);
// let sum = myRandom + myRandom2;

// console.log("Моё число: " + myRandom + " второе число: " + myRandom2 + ";\n  Сумма = " + sum);
// console.log(`Моё число: ${myRandom},\n второе число: ${myRandom2};\n\nСумма = ${sum}`);




// pow - возводит в степень, ОБЪЕКТ MATH
console.log (Math.pow(6,3))








// МАССИВЫ
let myArray = ["один", 2, "три", [4, "пять"], 50, 8.6, 9];
console.log(myArray[3][1]);
// myArray[7] = "77";

// let car = ["BMW", "LADA", "VOLVO"];
// console.log(car);
// let newCar = ["HAVAL", "CHERRY",];
// console.log(newCar);
// let myCar = car.concat(newCar);
// console.log(myCar);

let aaggee = [33, 47 , 78, 14, 6, 45, 23];
console.log(aaggee.filter((ag)=>  ag<20));

const ages = [33, 32, 16.5, 58, 4.6];
const reducer = (first, second) => first + second;
console.log(ages.reduce(reducer))








// ОБЪЕКТ "ВЗВОД"
let myPlatoon = {
    lieutenant: {
        name: "Рубен",
        position: "КВ",
        age: 23
    },
    elderSergeant1:  {
        name: "Илья",
        position: "ЗКВ",
        age: 35
    },    
    elderSergeant2:  {
        name: "Роман",
        position: "С-И",
        age: 29
    },     
    sergeant1:  {
        name: "Женёк",
        position: "С-И",
        age: 27       
    },    
    sergeant2:  {
        name: "Балон",
        position: "С-И",
        age: 31
    },     
    sergeant3:  {
        name: "Артем",
        position: "С-И",
        age: 29
    },     
    elderSergeant3: {
        name: "Старый",
        position: "И",
        age: 42
    },
    corporal1: {
        name: "Валера",
        position: "И",
        age: 26
    },
    corporal2: {
        name: "Саня Баф",
        position: "И",
        age: 31
    },
    corporal3: {
        name: "Усач",
        position: "И",
        age: 27
    },
    lanceSergeant1: {
        name: "Димон",
        position: "И",
        age: 26
    },
    corporal4: {
        name: "Саня Баф",
        position: "И",
        age: 31
    },
    corporal5: {
        name: "Лысый",
        position: "И",
        age: 25
    },
    sergeantMajor: {
        name: "Фил",
        position: "И-В",
        age: 42     
    },
    lanceSergeant2: {
        name: "Дрозд",
        position: "И-В",
        age: 30  
    },   
    corporal6: {
        name: "Артурио",
        position: "И-В",
        age: 32  
    },      
    corporal7: {
        name: "Толя",
        position: "И-В",
        age: 30
    },
    corporal8: {
        name: "Шава",
        position: "И-В",
        age: 30
    },  
    corporal9: {
        name: "Кондрат",
        position: "И-В",
        age: 24
    },   
    corporal10: {
        name: "Юрчик",
        position: "И-В",
        age: 41
    },
};
console.log(myPlatoon["lieutenant"].position);
console.log(myPlatoon.lanceSergeant1.name);
console.log(Object.keys(myPlatoon));
console.log(Object.values(myPlatoon));
console.log()








// ЦИКЛЫ while, for in, for.
// let counter = 0;
// while(counter < 5) {
    // counter = counter + 1;
    // counter += 1;
//     console.log(++ counter);
//     console.log(`counter: ${counter}`);
// }
// console.log(counter);

// объявим переменную а и присвоим ей значение 0
let a = 0;
//цикл while с условием a <= 8
while (a <= 8) {
  // увеличим значение переменной a на 1
  a++;
  // если число нечётное (остаток от деления на 2 не равен 0), то...
  if (a % 2 !== 0) {
    // пропустим дальнейшее выполнение текущей итерации и перейдём к следующей
    continue;
  }
  // выведем значение переменной a в консоль
  console.log(a);
}



// let myArray = ["один", 2, "три", [4, "пять"], 50, 8.6, 9];
// console.log(myArray);
// for(let i = 0; i < myArray.length; i ++) {
//     console.log(myArray[i]);
// }

// for (let rank in myPlatoon) {
//     if (rank == "lieutenant" || rank == "sergeant2") {
//         for (let paramKey in myPlatoon[rank]){
//             console.log(myPlatoon[rank][paramKey]);
//         }       
//     }
// }


// function calculateAge (year) {
//     return 2021 - year;
// }

// const myAge = calculateAge(1998);
// console.log(myAge);


// for(let lu of myArray){
//     console.log(lu);
// }









// УСЛОВИЕ "if else"
let rank = "kapitan";
let solder = "Ruben";

if (rank == "general" && solder == "Иван") {
    console.log("Привет Вань");
}
else if (rank == "lieutenant" || solder == "Ruben") {
    console.log("Hi Ruben");
}
else if (rank == "kapitan" && (solder == "Петя" || solder == "Вася")) {
    console.log("Hi");
}
else if (!rank && solder) {
    console.log("ДУХ");
}
else if (rank && solder === ""){
    console.log("Some one");
}
else {
    console.log("staf");
}

let hour = 20;
// test commit

// if (hour < 12) {
//     console.log("ДОБРОЕ УТРО");
// } 
// else if (hour < 18) {
//     console.log("ДОБРЫЙ ДЕНЬ");
// }
// else {
//     console.log("ДОБРЫЙ ВЕЧЕР");
// }







// ОПЕРАТОРЫ break, continue.
let solderCounter = 0;
for (let rank in myPlatoon) {
    solderCounter ++;
    if (rank !== "lieutenant" && rank !== "sergeant2") {
        continue;
    }
    for (let paramKey in myPlatoon[rank]){
        console.log(myPlatoon[rank][paramKey]);
        break;
    }  
    // if (rank == "lieutenant") {
    //     break;
    // }    
}
console.log(solderCounter);

// let userName = null;


//         while(!userName){
//             userName = prompt("Введите свой возраст");
//             if(userName < 18){
//                 alert("доступ запрещен")
//             }
//             else if(userName > 18){
//                 alert("отлично");
//                 break;
//             }
//             else{
//                 push(userName);
//                 alert(`${userName}. Ваш возраст опубликован`);
//             }
//         }
  

// console.log(users);








// УСЛОВИЕ Switch case: default

// let starCount = 4;
// switch(starCount) {
//     case 1: 
//     alert ("майор");
//     break;
//     case 2:
//     alert("лейтенант");
//     break;
//     case 3:
//     alert("старший лейтенант");
//     break;
//     case 4:
//     alert("капитан");
//     break;
//     default: 
//     alert("неизвестно");
// }

// var x = prompt("Введите первое число", 100);
// var y = prompt("Введите второе число", 100);
// var z = prompt("Введите 1, чтобы сработал знак +, введите 2, чтобы сработал знак -, введите 3, чтобы сработал знак *, и введите 4, чтобы сработал знак /");

// var x = parseInt(x);
// var y = parseInt(y);

// var result;

// switch(z) {
//     case '1': result = x + y;
//         break
//     case '1': result = x - y;
//         break
//     case '1': result = x * y;
//         break
//     case '1': result = x / y;
//         break
//     default: alert('Вы ввели не существующую команду!');
// }
// alert(result);









//ОКНА alert,confirm, prompt

// alert("hello \n world");
// // console.log(starCount);
// // alert("hello world 2");

// // confirm("Согласны с...?");
// if(confirm("Согласны с...?")) {
//     alert("Вы согласились!");
// }
// else{
//     alert("Вы отказались!");
// }

// let text = prompt("Введите имя");
// alert(text);

let nextWrite = true;
let userName = null;
let users = [];
while(nextWrite){
    if(nextWrite = confirm("необходимо будет ввести возрастные данные")){
        userName = null;
        while(!userName){
            userName = prompt("Введите СВОЙ возраст");
            if(userName === null){
                break;
            }
            else if(!userName){
                alert("отсутствует запись");
            }
            else{
                users.push(userName);
                alert(`${userName}. Ваше возраст опубликовано`);
            }
        }
    }
    else{
        alert("Пусть будет на Вашей совести");
    }
}
console.log(users);

// let nextWrite = true;
// let userName = null;
// let users = [];

// while(nextWrite){
//     if(nextWrite = confirm("Хотите ли добавить происшествие?")){
//         userName = null;
//         while(!userName){
//             userName = prompt("Введите краткое описание происшествия");
//             if(userName === null){
//                 break;
//             }
//             else if(!userName){
//                 alert("отсутствует описание");
//             }
//             else{
//                 users.push(userName);
//                 alert(`${userName}. Ваше происшествие опубликовано`);
//             }
//         }
//     }
//     else{
//         alert("Пусть будет на Вашей совести");
//     }
// }
// console.log(users);






// РАБОТА С "DOM";  СОБЫТИЯ "onclick, oninput";setInterval,setTimeout;getElementById.

console.log(document.body);

// let curentColor = document.body.style.background;
// document.getElementById("changer_color").onclick = function(){
//     // setInterval(() => {
//         setTimeout(function(){
//             if(document.body.style.background == curentColor){
    
//                 curentColor = document.body.style.background;
//                 document.body.style.background = document.getElementById("choose_color").value;
//             }
//             else{
//                 document.body.style.background = curentColor;
//             }
//         }, 500);
//     // }, 3000);
// }

// document.getElementById("onInputReader").oninput = function(){
//     document.getElementById("onInputWriter").innerText = document.getElementById("onInputReader").value;
// }








// ОБЪЕКТ window; querySelector;

// document.getElementsByClassName("blok");
// console.log(document.getElementsByClassName("blok"));
window.onload = function(){
    console.log(document.querySelector(".blok"));
}

document.onclick = function(event){
    event.target.classList.toggle("rotate_animation");
}


