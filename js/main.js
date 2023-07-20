window.onload = function () {
    document.querySelectorAll(".closer").forEach(item => {
        item.addEventListener("click", event => {
            event.target.parentElement.classList.remove("is_visible")
        })
    })

    document.querySelectorAll(".open_modal").forEach(item => {
        item.addEventListener("click", event => {
            if (event.target.dataset.modal_function !== undefined) {
                console.log(event.target.dataset.modal_params)
                console.log(event.target.dataset.modal_function)
                let modalFunction = event.target.dataset.modal_function
                window[event.target.dataset.modal_function](
                    document.getElementById(event.target.dataset.modal_id),
                    ...JSON.parse(event.target.dataset.modal_params)
                )
            }
            document.getElementById(event.target.dataset.modal_id).classList.add("is_visible")
        })
    })
}

function toggleLoader() {
    const cover = document.getElementById("cover")
    const loader = document.getElementById('loader')
    loader.classList.toggle('hidden')
    cover.classList.toggle('hidden')
}

function buildAction(modalWindowObject, actionID) {
    getAPI("controllers/page_ajax_controller.php", {
        form_name: "get_action_by_id",
        action_id: actionID
    }, result => {
        console.log(result)
        console.log(modalWindowObject)
        modalWindowObject.querySelector("h3").innerHTML = result.title
        modalWindowObject.querySelector("h6").innerHTML = result.date
        modalWindowObject.querySelector("p").innerHTML = result.description
        modalWindowObject.querySelector("h5").innerHTML = result.address
        let imageBox = modalWindowObject.querySelector(".action_images")
        imageBox.innerHTML = ""
        result.images.forEach(item => {
            imageBox.innerHTML += `<img src="${item.url}" alt="${item.discription}">`
        })
    })
    let body = `   
    <h4>СОБЫТИЕ</h4>
    <div>
        <label for="action_images">Фото события</label>
        <div class="action_images"></div>
    </div>
    <div>
        <h3>Lorem </h3>
        <h6><?= $oneAction["date"] ?></h6>
        <p>
            <?= $oneAction["description"] ?>
        </p>
        <h5><?= $oneAction["address"] ?></h5>
    </div>
    `
}

function makeURL(url, params = null) {
    return params
        ? `${url}?${(new URLSearchParams(params)).toString()}`
        : url;
}

function formDataToJSON(formData) {
    return JSON.stringify(Object.fromEntries(formData))
}


/** 
 * The fetch API requester, Does a callback after a successful response
 * @param method {String}
 * @param url {String}
 * @param body {String|number|Object|Array}
 * @param callback {Function}
 */
function sendAPIRequest(method, url, body, callback) {
    console.log(body)
    let requestObject = {
        method: method,
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }
    if (body && (method === "POST" || method === "PUT")) {
        requestObject.body = body
        requestObject.headers['Content-Type'] = "application/json"
    }
    fetch(url, requestObject).then(response => response.json()
        .catch((error) => {
            console.error(error)
            alert("Внезапная ошибка")
        }).then(result => {
        if (result.status === "ok") {
            if (result.message) {
                console.log(result.data)
                callback(result.message)
            } else {
                console.log(result.data)
                callback(result.data)
            }
        }
        else {
            alert(result.message)
        }
    })).catch((error) => {
        console.error(error)
        alert("Внезапная ошибка")
    })
}
function getAPI(url, urlParams, callback) {
     sendAPIRequest("GET", makeURL(url, urlParams),null, callback)
}

function postAPI(url, body, callback) {
    sendAPIRequest("POST", makeURL(url), body, callback)
}

function putAPI(url, urlParams, body, callback) {
    sendAPIRequest("PUT", makeURL(url, urlParams), body, callback)
}

function deleteAPI(url, urlParams, callback) {
    sendAPIRequest("DELETE", makeURL(url, urlParams),null, callback)
}

