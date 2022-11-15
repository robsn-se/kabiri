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
    <div id="map"></div>
</div>
<div class="event_search">
    <form>
        <input type="text" placeholder="Поиск события">
    </form>
</div>
<ul class="event_list">
    <?php foreach($actionsList as $oneAction){ ?>
        <li>
            <img src="<?= $oneAction["image"] ?>" alt="">
            <div>
                <h3><?= $oneAction["title"] ?></h3>
                <h6><?= $oneAction["date"] ?></h6>
                <p>
                    <?= $oneAction["discription"] ?>
                </p>
                <h5><?= $oneAction["address"] ?></h5>
            </div>
        </li>
        <hr>
    <?php } ?>
</ul>
<?php if (@!$_SESSION["authorization"]) { ?>
    <div class="main_info">
        <a href="/?page=login" class="btn">Вход / Регистрация</a>
    </div>
<?php } ?>
