let userTmpInputFiles = []

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
    sendAPIRequest("controllers/cabinet_controller.php", formData, result => {
        alert(result)
        location.reload()
    });
})

document.querySelector("#add_action form").addEventListener("submit", event => {
    event.preventDefault();
    let formData = new FormData(event.target)
    sendAPIRequest("controllers/cabinet_controller.php", formData, result => {
        alert(result)
        location.reload()
    })
})



async function addUserTmpInputFiles(inputElement) {
    for (const item of inputElement.files) {
        userTmpInputFiles.push(await getBase64Url(item))
    }
    return userTmpInputFiles
}

async function getUrlsFromFileList(fileList) {
    let base64Urls = []
    for (const item of fileList) {
        base64Urls.push(await getBase64Url(item))
    }
    return base64Urls
}

function getBase64Url(file) {
    return new Promise((resolve, reject) => {
        let reader = new FileReader();
        reader.onload = () => {
            resolve(reader.result);
        };
        reader.onerror = reject;
        reader.readAsDataURL(file);
    })
}

function loadedImagesRender(imagesBox, Base64Urls) {
    imagesBox.innerHTML = ""
    Base64Urls.forEach((item, index) => {
        let div = document.createElement("div")
        let i = document.createElement("i")
        i.classList.add("fa-solid", "fa-xmark", "image_closer")
        i.dataset.index = index
        i.addEventListener("click", event => {
            event.target.parentElement.remove()
            userTmpInputFiles.splice(Number(event.target.dataset.index), 1)
            loadedImagesRender(imagesBox, userTmpInputFiles)
        })
        div.style.backgroundImage = `url(${item})`
        div.appendChild(i)
        imagesBox.appendChild(div)
    })
}

document.querySelector("#add_action input[name='action_images']").addEventListener("change", event => {
        // addUserTmpInputFiles(event.target)
        // userTmpInputFiles = [...userTmpInputFiles, ...event.target.files]
        addUserTmpInputFiles(event.target).then(base64Urls => {
        loadedImagesRender(event.target.parentElement.querySelector(".action_images"), base64Urls)
    })
})

function sendAPIRequest(url, data, callback) {
    fetch(url, {
        method: "post",
        body: data
    }).then(response => response.json().then(result => {
        if (result.status === "ok") {
            if (result.message) {
                console.log(result.data);
                callback(result.message);
            } else {
                callback(result.data);
            }
        }
        else {
            alert(result.message);
        }
    })).catch((error) => {
        console.log(error);
        alert("Внезапная ошибка");
    })
}

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


// document.querySelector(".image_closer").forEach(item => {
//     item.addEventListener("click", () => {
//         delete(userTmpInputFiles[event.target.dataset.index])
//     })
// })