<div class="container_registration">
    <?php if(@$_GET["login"] == "registration") {
        include "view_templates/registration_form.php";
    }
    else {
        include "view_templates/authorization_form.php";
    }
    ?>
</div>
