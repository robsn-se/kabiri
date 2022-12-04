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

document.querySelectorAll(".change_input input").forEach(item => {
    item.addEventListener("input", event => {
        if (item.value.trim() && item.value.trim() !== item.dataset.old_value) {
            event.target.parentElement.querySelector(".change_buttons").style.display="inline-block";
        }
        else {
            event.target.parentElement.querySelector(".change_buttons").style.display="none";
        }
    });
});

document.querySelectorAll(".change_buttons button").forEach(item => {
    item.addEventListener("click", event => {
            if (item.dataset.old_value) {
                event.target.parentElement.querySelector(".fa-solid").style.display = "block";
            } else {
                event.target.parentElement.querySelector(".fa-solid").style.display = "none";
            }
        });
});