<form action="" method="post">
    <h3>Регистрация</h3>
    <input type="hidden" name="form_name" value="registration">
    <div>
        <label for="email">Email</label>
        <input id="email" placeholder="Введите email" tabindex="1" name="email" type="email">
    </div>
    <div>
        <label for="login">Логин</label>
        <input id="login" placeholder="Введите уникальный логин" tabindex="2" name="login" type="text">
    </div>
    <div>
        <label for="birthday">Дата рождения</label>
        <input id="birthday"  tabindex="3" name="birthday" type="date">
    </div>
    <div>
        <label for="password">Пароль</label>
        <input id="password" placeholder="Введите пароль" tabindex="4" name="password" type="password">
    </div>
    <div>
        <input placeholder="Повторите пароль" tabindex="5" type="password">
    </div>
    <div>
        <label for="avatar">Аватар</label>
        <input id="avatar" tabindex="6" name="avatar" type="file">
    </div>
    <h6 class="warning"><?= $statusMessage ?></h6>
    <div>
        <button type="submit" class="btn">Зарегистрироваться</button>
    </div>
    <div>
        <a class="transition_link" href="/?page=login">ВОЙТИ</a>
    </div>
</form>