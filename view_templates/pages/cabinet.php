<?php require_once "./controlers/cabinet_controler.php";?>
<?php if (@$_SESSION["authorization"]) { ?>
    <div>
        <h1>Личный кабинет пользователя</h1>
    </div>
<?php } else { ?>
    <strong>СТРАНИЦА НЕ ДОСТУПНА</strong>
<?php } ?>