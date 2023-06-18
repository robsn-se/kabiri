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
                window[event.target.dataset.modal_function](event.target, ...JSON.parse(event.target.dataset.modal_params))
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
    let data = new FormData()
    data.append("form_name", "get_action_by_id")
    data.append("action_id", actionID)
    console.log(actionID)
    sendAPIRequest("controllers/page_controller.php", data, result => {
        console.log(result)
    }, {"Content-Type:": "application/json"})
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

/**
 * The fetch API requester, Does a callback after a successful response
 * @param url {String}
 * @param data {String|number|Object|Array}
 * @param callback {Function}
 * @param headers {Object}
 */
function sendAPIRequest(url, data, callback, headers = {}) {
    console.log(data)
    fetch(url, {
        method: "post",
        body: data,
        // headers: headers
    }).then(response => response.json()
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


