<div class="heder_main_blok">
    <div class="">
        <a class="heder_logo" href="/">
            <img src="./images/логотип.gif" alt="" width="70px">
        </a>
        <h1>KABERI</h1>
    </div>
    <?php if (@$_SESSION["authorization"]) { ?>
       <div class="welcome">
            <div>
                <a href="/?page=cabinet">
                    <img src="<?= $_SESSION["authorization"]["avatar"] ?>" alt="">
                </a>
            </div>
            <div>
                <strong><?= $_SESSION["authorization"]["login"] ?></strong>
                <form method="post">
                    <input type="hidden" name="form_name" value="cabinet_exit">
                    <button type="submit" class="btn">Выйти</button>
                </form>
            </div>
       </div>
    <?php } else { ?>
        <div class="social">
            <a class="social__icon twitter" href="#" title="twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="social__icon vk" href="https://vk.com/id608634445" target="__blank" title="vk">
                <i class="fab fa-vk"></i>
            </a>
            <a class="social__icon telegram-plane" href="#" title="telegram">
                <i class="fab fa-telegram-plane"></i>
            </a>
            <a class="social__icon youtube" href="#" title="youtube">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
    <?php } ?>
</div>