<?php if (@!$_SESSION["authorization"]) { ?>
    <div class="main_info">
        <h2>Вместе строим будущее общественной безопасности</h2>
        <div>
            <a href="/?page=login" target="_blank" class="btn">Вход / Регистрация</a>
        </div>
        <h4>
            Подключайтесь и живите в безопасности.
            <strong>Kaberi</strong> - это приложение личной безопасности,
            которое дает вам возможность защитить себя, а также людей и места,
            которые вам небезразличны. Kaberi предоставляет Вам уведомления на основе
            местоположения и помогает избежать потенциально опасные ситуации.
        </h4>
    </div>
    <hr>
<?php } ?>
<div class="map_zone main_info">
    <h2>Последние события</h2>
<!--    <div id="map"></div>-->
</div>
<div class="event_search">
    <form>
        <input class="search_action" type="text" placeholder="Поиск события">
        <span>
            <i class="fa-solid fa-magnifying-glass"></i
        </span>
    </form>
</div>
<ul class="event_list" id="style-2">
    <?php foreach($actionsList as $oneAction){ ?>
        <li>
            <img src="<?= $oneAction["image"] ?>" alt="">
            <div>
                <h3><?= $oneAction["title"] ?></h3>
                <h6><?= $oneAction["date"] ?></h6>
                <p>
                    <?= $oneAction["description"] ?>
                </p>
                <h5><?= $oneAction["address"] ?></h5>
                <h4 class="open_modal" data-modal_id="action_modal_window" data-modal_function="buildAction" data-modal_params='<?= json_encode([$oneAction["id"]]) ?>'>Открыть событие</h4>
            </div>
        </li>
        <hr>
    <?php } ?>
</ul>
<div class="modal_window" id="action_modal_window">
    <i class="closer fa-solid fa-xmark"></i>
    <div class="modal_body"></div>
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
</div>
<?php if (@!$_SESSION["authorization"]) { ?>
    <div class="main_info">
        <a href="/?page=login" class="btn">Вход / Регистрация</a>
    </div>
<?php } ?>