<div class="container_registration">
    <?php

    if (isset($_GET["login"]) && file_exists("view_templates/pages/login/{$_GET["login"]}.php")) {
        include "view_templates/pages/login/{$_GET["login"]}.php";
    }
    else {
        include "view_templates/pages/login/authorization.php";
    }
    ?>
</div>