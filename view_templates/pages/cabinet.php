<?php require_once "./controlers/cabinet_controler.php";?>

<?php if (@$_SESSION["authorization"]) { ?>
        <details class="settings">
            <summary>
                <i class="fa-solid fa-gear"></i>
                Настройки
            </summary>
            <form action="">
                <div>
                    <label for="email">Email</label>
                    <input id="email" tabindex="1" name="email" type="email" value="<?= $_SESSION["authorization"]["email"] ?>">
                    <button type="submit" class="btn">Изменить</button>
                </div>
                <div>
                    <label for="login">Логин</label>
                    <input id="login" tabindex="2" name="login" type="text" value="<?= $_SESSION["authorization"]["login"] ?>">
                    <button type="submit" class="btn">Изменить</button>
                </div>
                <div>
                    <label for="birthday">Дата рождения</label>
                    <input id="birthday"  tabindex="3" name="birthday" type="date" value="<?= $_SESSION["authorization"]["birthday"] ?>">
                    <button type="submit" class="btn">Изменить</button>
                </div>
                <div>
                    <label for="password">Пароль</label>
                    <input id="password" tabindex="4" name="password" type="password" value="<?= $_SESSION["authorization"]["password"] ?>">>
                    <input id="password" placeholder="Введите новый пароль" tabindex="4" name="password" type="password">
                    <button type="submit" class="btn">Изменить</button>
                </div>
                <div>
                    <label for="avatar">Аватар</label>
                    <input id="avatar" placeholder="Изменить" tabindex="5" name="avatar" type="file">
                </div>
            </form>
        </details>
    <div class="main_info">
        <button type="button" class="btn open_modal" data-modal_id="add_action">ДОБАВИТЬ СОБЫТИЕ</button>
    </div>
    <div class="modal_window" id="add_action">
        <i class="closer fa-solid fa-xmark"></i>
        <h4>РАССКАЗАТЬ О СОБЫТИИ</h4>
        <form action="">
            <div>
                <label for="action_title">Название события</label>
                <input type="text" placeholder="Пример: Массовая драка" name="title" id="action_title">
            </div>
            <div>
                <label for="description">Описание происшествия</label>
                <textarea name="description" id="description"></textarea>
            </div>
            <div>
                <label for="location">Местоположение</label>
                <input type="text" placeholder="Пример: г.Москва, ул. Гагарина д.3" name="location" id="location">
            </div>
            <div>
                <label for="type">Тип происшествия</label>
                <input type="text" placeholder="Пример: Драка" name="type" id="type">
            </div>
            <div>
                <button type="submit" class="btn">Отправить событие</button>
            </div>
        </form>
    </div>
<?php } else { ?>
    <strong>СТРАНИЦА НЕ ДОСТУПНА</strong>
<?php } ?>