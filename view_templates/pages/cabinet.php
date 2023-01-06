<?php if (@$_SESSION["authorization"]) { ?>
        <details class="settings">
            <summary>
                <i class="fa-solid fa-gear"></i>
                Настройки
            </summary>
            <form action="">
                <input type="hidden" name="form_name" value="setting">
                <div class="change_input">
                    <label for="email">Email</label>
                    <input id="email" tabindex="1" type="email" data-name="email" data-old_value="<?= $_SESSION["authorization"]["email"] ?>" value="<?= $_SESSION["authorization"]["email"] ?>">
                    <div class="change_buttons">
                        <button class="save_button">Сохранить</button>
                        <button type="button" class="fa-solid fa-xmark"></button>
                    </div>
                </div>
                <div class="change_input">
                    <label for="login">Логин</label>
                    <input id="login" tabindex="2" type="text" data-name="login" data-old_value="<?= $_SESSION["authorization"]["login"] ?>" value="<?= $_SESSION["authorization"]["login"] ?>">
                    <div class="change_buttons">
                        <button class="save_button">Сохранить</button>
                        <button type="button" class="fa-solid fa-xmark"></button>
                    </div>
                </div>
                <div class="change_input">
                    <label for="birthday">Дата рождения</label>
                    <input id="birthday" tabindex="3" data-name="birthday" type="date" data-old_value="<?= $_SESSION["authorization"]["birthday"] ?>" value="<?= $_SESSION["authorization"]["birthday"] ?>">
                    <div class="change_buttons">
                        <button class="save_button">Сохранить</button>
                        <button type="button" class="fa-solid fa-xmark"></button>
                    </div>
                </div>
                <div class="change_input">
                    <label for="password">Пароль</label>
                    <input placeholder="Введите текущий пароль" tabindex="4" data-name="old_password" type="password">
                    <input class="check_target" id="password" placeholder="Введите новый пароль" tabindex="5" data-name="password" type="password">
                    <input class="check_input" placeholder="Повторите новый пароль" tabindex="6" type="password">
                </div>
                <div>
                    <label for="avatar">Аватар</label>
                    <img src="<?= $_SESSION["authorization"]["avatar"] ?>" alt="">
                    <input id="avatar" tabindex="7" data-name="avatar" type="file">
                </div>
                <button type="submit" class="btn">Изменить</button>
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