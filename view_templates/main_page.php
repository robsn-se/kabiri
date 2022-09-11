<div class="smol">
    <h2>Место, где люди защищают друг друга</h2>
    <div class="button">
        <a href="/?page=login" target="_blank" class="btn">Зарегистрироваться</a>
    </div>
    <h4 style="text-align: center; color:  rgb(255, 255, 255); font-family: 'Roboto', sans-serif; font-weight: 200; font-size: 20px;">
        Подключайтесь и живите в безопасности.
        <strong>Kaberi</strong> - это приложение личной безопасности,
        которое дает вам возможность защитить себя, а также людей и места,
        которые вам небезразличны. Kaberi предоставляет Вам  уведомления на основе
        местоположения и помогает избежать потенциально опасные ситуации.
    </h4>
      <hr>
    <h1>Вместе строим будущее общественной безопасности</h1>
</div>
<div class="map_smolensk">
    <div id="map"></div>
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
<div class="button">
    <a href="/?page=login" class="btn">ЗАРЕГИСТРИРОВАТЬСЯ</a>
</div>