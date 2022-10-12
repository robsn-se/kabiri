<?php require_once "./controlers/cabinet_controler.php";?>
<?php if (@$_SESSION["authorization"]) { ?>
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
<?php } else { ?>
    <strong>СТРАНИЦА НЕ ДОСТУПНА</strong>
<?php } ?>