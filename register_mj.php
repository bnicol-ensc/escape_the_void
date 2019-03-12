<?php
    session_start();
    require_once("includes/fonction.php");
?>
<!doctype html>
<html>

<?php
    $pageTitle = "Inscription MJ";
    require_once("includes/head.php");
?>

<body>
    <div class="background">
    <?php
        require_once("includes/nav.php");
        require_once("includes/connect.php");
    ?>

    <div class="container_login_register">
        <div class="d-flex justify-content-center h-100">
            <div class="card_register">
                <div class="card-header">
                    <h3>Inscription MJ</h3>
                </div>
                <div class="card-body">
                    <form role="form" class="inscription" action="register.php" method="post">
                        <div class="form-group row">
                            <label for="login" class="col-sm-3 col-form-label">Nom d'utilisateur : </label>
                            <input type="text" name="login" class="form-control col-sm-9" required autofocus>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Mot de passe : </label>
                            <input type="password" name="password" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Confirmer le mot de passe : </label>
                            <input type="password" name="password" class="form-control col" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="S'inscrire" class="btn float-right login_btn"></br>
                        </div>
                    </form>
                </div>
                <div class="card-footer">

                        Vous êtes une équipe ? <a href="register.php"> Insciption équipe</a>

                </div>
            </div>
        </div>
    </div>

    <?php
        require_once("includes/footer.php");
        require_once("includes/script.php");
    ?>
    </div>
</body>

</html>