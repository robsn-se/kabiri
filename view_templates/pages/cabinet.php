<?php require_once "./controlers/cabinet_controler.php";?>

<?php if (@$_SESSION["authorization"]) { ?>
    <div class="user_img">
        <img src="myFoto.JPG" alt="">
    </div>
    <div>
        <div class="welcome">
            <strong>Добро пожаловать, <?= $_SESSION["authorization"]["login"] ?>!</strong>
        </div>
        <form method="post">
            <input type="hidden" name="form_name" value="cabinet_exit">
            <button type="submit" class="btn">Выйти</button>
        </form>
    </div>
    <div>
        <h1>Личный кабинет пользователя</h1>
    </div>
    <div class="map_smolensk">
        <div id="map"></div>
    </div>
    <div class="event_search">
        <form>
            <input type="text" placeholder="Поиск события">
            <button type="submit"></button>
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
<?php } else { ?>
    <strong>СТРАНИЦА НЕ ДОСТУПНА</strong>
<?php } ?>