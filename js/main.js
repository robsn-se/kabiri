document.querySelectorAll(".closer").forEach(item => {
    item.addEventListener("click", event => {
        event.target.parentElement.classList.remove("is_visible");
    });
});

document.querySelectorAll(".open_modal").forEach(item => {
    item.addEventListener("click", event => {
        document.getElementById(event.target.dataset.modal_id).classList.add("is_visible");
    })
 });



// const elementById = document.getElementById("open");
// console.log(elementById);
// const button = document.querySelectorAll('.btn');
// const form = document.querySelectorAll('.modal_window');
//
// button.addEventListener('click', () => {
//     form.classList.add("is_visible");
// });

// document.addEventListener('DOMContentLoaded', () => {
//     const button = document.querySelectorAll('.btn');
//     const rect = document.querySelectorAll('.modal_window');
//
//     button.addEventListener('click', () => {
//         rect.classList.toggle('is_visible');
//     });
// });

// document.getElementById(".open").forEach(i => {
//     i.addEventListener("click", e => {
//         document.querySelectorAll(".modal_window").display = "block";
//     });
// });

// function viewDiv(){
//     document.getElementById("modal_window").style.display = "block";
// }

// document.addEventListener('DOMContentLoaded', (e) => {
//     document.querySelectorAll('.main_info').addEventListener("click", (e) => {
//         document.querySelectorAll('is_visible').classList.add('openSearchForm');
//     });
// });

// document.addEventListener('DOMContentLoaded', () => {
//     const button = document.querySelectorAll(".btn");
//     const rect = document.querySelectorAll(".modal_window");
//
//     button.addEventListener('click', () => {
//         rect.classList.toggle('is-visible');
//     });
// });

// document.querySelectorAll(".main_info").forEach(item => {
//     item.addEventListener("click",  e => {
//         e.target.parentElement.classList.add("is_visible");
//     });
// });

// document.querySelectorAll(".main_info")