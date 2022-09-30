<form action="/?page=cabinet" method="post">
    <h3>Вход</h3>
    <input type="hidden" name="form_name" value="authorization">
    <div>
        <label for="login">Логин</label>
        <input id="login" placeholder="Введите уникальный логин" tabindex="1" name="login" type="text">
    </div>
    <div>
        <label for="password">Пароль</label>
        <input id="password" placeholder="Введите пароль" tabindex="2" name="password" type="password">
    </div>
    <div>
        <button type="submit" class="btn">ВОЙТИ</button>
    </div>
    <div>
        <a class="transition_link" href="/?page=login&login=registration">ЗАРЕГИСТРИРОВАТЬСЯ</a>
    </div>
</form>