let userTmpInputFiles = []

window.onload = function () {
    document.querySelectorAll(".check_input, .check_target").forEach(item => {
        item.addEventListener("input", event => {
            let secondInputSelector = ".check_target"
            if (item.classList.contains(".check_target")) {
                secondInputSelector = ".check_input"
            }
            let secondInput = item.parentElement.querySelector(secondInputSelector)
            if (!secondInput || !(secondInput = item.parentElement.parentElement.querySelector(secondInputSelector))) {
                return true
            }
            if (item.value === secondInput.value) {
                item.classList.remove("wrong_input")
                item.classList.add("true_input")
                secondInput.classList.remove("wrong_input")
                secondInput.classList.add("true_input")
            }
            else {
                item.classList.remove("true_input")
                item.classList.add("wrong_input")
                secondInput.classList.remove("true_input")
                secondInput.classList.add("wrong_input")
            }
        })
    })

    document.querySelectorAll(".change_input input").forEach(item => {
        if (item.dataset.name === undefined) {
            return true
        }
        item.addEventListener("input", event => {
            if (item.value.trim() && item.value.trim() !== item.dataset.old_value) {
                item.name = item.dataset.name
                event.target.parentElement.querySelector(".change_buttons").style.display="inline-block";
            }
            else {
                item.removeAttribute("name");
                event.target.parentElement.querySelector(".change_buttons").style.display="none";
            }
        })
    })

    document.querySelectorAll(".change_buttons button:nth-child(2)").forEach(item => {
        item.addEventListener("click", event => {
            let input = event.target.parentElement.parentElement.querySelector("input")
            input.value = input.dataset.old_value;
        })
    })

    document.querySelector(".settings form").addEventListener("submit", event => {
        event.preventDefault()
        let formData = new FormData(event.target)
        sendAPIRequest("controllers/cabinet_controller.php", formData, result => {
            alert(result)
            location.reload()
        })
    })

    document.querySelector("#add_action form").addEventListener("submit", event => {
        event.preventDefault()
        // toggleLoader()
        let formData = new FormData(event.target)
        console.log(formData.getAll("action_images[]"))
        for (const file of userTmpInputFiles) {
            formData.append("file[]", file, file.name)
        }
        sendAPIRequest("controllers/cabinet_controller.php", formData, result => {
            // toggleLoader()
            alert(result)
            location.reload()
        })
    })

    document.querySelector("#add_action input[id='action_images']").addEventListener("change", event => {
        userTmpInputFiles = [...userTmpInputFiles, ...event.target.files]
        const imagesBox = event.target.parentElement.querySelector(".action_images")
        updateUserTmpInputFiles(imagesBox, event.target)
    })
}

/**
 * @param file {File}
 * @returns {Promise<string>}
 */
function getBase64Url(file) {
    return new Promise((resolve, reject) => {
        let reader = new FileReader()
        reader.onload = () => {
            resolve(reader.result)
        }
        reader.onerror = reject
        reader.readAsDataURL(file)
    })
}

/**
 * @param imagesBox {Element}
 * @param index {number}
 * @param Base64Url {String}
 * @param inputElement {Element}
 * @param closerListener {Function}
 */
function imageRender(imagesBox, index, Base64Url, inputElement, closerListener) {
    let div = document.createElement("div")
    let i = document.createElement("i")
    i.classList.add("fa-solid", "fa-xmark", "image_closer")
    i.dataset.index = index
    i.addEventListener("click", event => {
        userTmpInputFiles.splice(Number(event.target.dataset.index), 1)
        closerListener(imagesBox, inputElement)
    })
    div.style.backgroundImage = `url(${Base64Url})`
    div.appendChild(i)
    imagesBox.appendChild(div)
}

/**
 *
 * @param imagesBox {Element}
 * @param inputElement {Element}
 */
function updateUserTmpInputFiles(imagesBox, inputElement) {
    imagesBox.innerHTML = ""
    for (let index = 0; index < userTmpInputFiles.length; index++) {
        imagesCompressor(userTmpInputFiles[index], "image/jpeg").then(compressedFile =>{
            userTmpInputFiles[index] = compressedFile
            // dataTransfer.items.add(userTmpInputFiles[index])
            getBase64Url(userTmpInputFiles[index]).then(base64Url => {
                imageRender(imagesBox, index, base64Url, inputElement, updateUserTmpInputFiles)
            })
        })
    }
}

/**
 * The compressor of an image file, decreases file size by its quality
 * @param file {File}
 * @param imageType {String}
 * @param quality {number}
 * @returns {Promise<File>}
 */
async function imagesCompressor(file, imageType, quality = 0.1) {
    let fileName = file.name.split('.')[0]
    let image = await readFileImage(file)
    let canvas = document.createElement('canvas')
    canvas.width = image.width
    canvas.height = image.height
    let ctx = canvas.getContext('2d')
    ctx.drawImage(image, 0, 0)

    return new Promise(function (resolve) {
        canvas.toBlob(function (blob) {
            resolve(new File([blob], fileName + ".jpeg", {type: imageType}))
        }, imageType, quality)
    })
}

/**
 * Takes an imageHtmlElement from an image file
 * @param file {File}
 * @returns {Promise<HTMLImageElement>}
 */
function readFileImage(file) {
    return new Promise((resolve, reject) => {
        const image = new Image()
        image.src = URL.createObjectURL(file)
        image.onload = () => {
            resolve(image)
        };
        image.onerror = (el, err) => {
            reject(err)
        };
    });
}

