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
        // console.log(item.value.trim());
        // console.log(item.dataset.old_value);
        if (item.value.trim() && item.value.trim() !== item.dataset.old_value) {
            event.target.parentElement.querySelector(".change_buttons").style.display="inline-block";
        }
        else {
            event.target.parentElement.querySelector(".change_buttons").style.display="none";
        }
    });
});

document.querySelectorAll(".change_buttons button:nth-child(2)").forEach(item => {
    item.addEventListener("click", event => {
        console.log(event);
        let input = event.target.parentElement.parentElement.querySelector("input");
        input.value = input.dataset.old_value;
        console.log(input.value);
    });
});

document.querySelector(".settings form").addEventListener("submit", event => {
    event.preventDefault();
    let formData = new FormData(event.target);
    fetch("controlers/cabinet_controler.php", {
        method: "post",
        body: formData
    }).then(response => response.json().then(result => {
        console.log(result);
    }))
})


