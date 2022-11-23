<?php require_once "./controlers/cabinet_controler.php";?>

<?php if (@$_SESSION["authorization"]) { ?>
        <details class="settings">
            <summary>
                <img src="settings.png" alt="" width="18px">
                Настройки
            </summary>
            <form action="">
                <div>
                    <label for="email">Email</label>
                    <input id="email" placeholder="Введите email" tabindex="1" name="email" type="email">
                    <button type="submit" class="btn">Изменить</button>
                </div>
                <div>
                    <label for="login">Логин</label>
                    <input id="login" placeholder="Введите уникальный логин" tabindex="2" name="login" type="text">
                    <button type="submit" class="btn">Изменить</button>
                </div>
                <div>
                    <label for="birthday">Дата рождения</label>
                    <input id="birthday"  tabindex="3" name="birthday" type="date">
                    <button type="submit" class="btn">Изменить</button>
                </div>
                <div>
                    <label for="password">Пароль</label>
                    <input id="password" placeholder="Введите пароль" tabindex="4" name="password" type="password">
                    <button type="submit" class="btn">Изменить</button>
                </div>
                <div>
                    <label for="avatar">Аватар</label>
                    <input id="avatar" placeholder="Изменить" tabindex="5" name="avatar" type="file">
                </div>
            </form>
        </details>
    <div class="main_info">
        <h1>РАССКАЗАТЬ О СОБЫТИИ</h1>
<!--        <button type="submit" class="btn">ДОБАВИТЬ СОБЫТИЕ</button>-->
    </div>
    <div class="add_action">
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

