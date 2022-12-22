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
    if (item.dataset.name === undefined) {
        return true
    }
    item.addEventListener("input", event => {
        if (item.value.trim() && item.value.trim() !== item.dataset.old_value) {
            item.name = item.dataset.name;
            event.target.parentElement.querySelector(".change_buttons").style.display="inline-block";
        }
        else {
            item.removeAttribute("name");
            event.target.parentElement.querySelector(".change_buttons").style.display="none";
        }
    });
});

document.querySelectorAll(".change_buttons button:nth-child(2)").forEach(item => {
    item.addEventListener("click", event => {
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

document.querySelectorAll(".check_input, .check_target").forEach(item => {
    item.addEventListener("input", event => {
        let secondInputSelector = ".check_target";
        if (item.classList.contains(".check_target")) {
            secondInputSelector = ".check_input";
        }
        let secondInput = item.parentElement.querySelector(secondInputSelector);
        if (!secondInput || !(secondInput = item.parentElement.parentElement.querySelector(secondInputSelector))) {
            console.log("secondInput is undefined");
            return true
        }
        if (item.value === secondInput.value) {
            item.classList.remove("wrong_input");
            item.classList.add("true_input");
            secondInput.classList.remove("wrong_input");
            secondInput.classList.add("true_input");
        }
        else {
            item.classList.remove("true_input");
            item.classList.add("wrong_input");
            secondInput.classList.remove("true_input");
            secondInput.classList.add("wrong_input");
        }
    })
})