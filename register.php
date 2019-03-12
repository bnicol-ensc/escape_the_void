<?php
    session_start();
    require_once("includes/fonction.php");
?>
<!doctype html>
<html>

<?php
    $pageTitle = "Inscription";
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
                    <h3>Inscription</h3>
                </div>
                <div class="card-body">
                    <form role="form" action="register.php" method="post">
                        <div class="input-group form-group">
                            <label for="login" class="col-4">Nom d'utilisateur : </label>
                            <input type="text" class="col-8" name="login" class="form-control" required autofocus>
                        </div>
                        <div class="input-group form-group">
                            <label for="nom_equipe">Nom de l'équipe : </label>
                            <input type="text" name="nom_equipe" class="form-control" required>
                        </div>
                        <div class="input-group form-group">
                            <label for="password">Mot de passe : </label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="input-group form-group">
                            <label for="password">Confirmer le mot de passe : </label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <?php
                            if((isset($_POST['login'])) && (isset($_POST['password']))){
                                $login = escape($_POST['login']);
                                $password = escape($_POST['password']);
                                if(($login == $tuple['usr_login']) && ($password == $tuple['usr_password'])){
                                    $_SESSION['login'] = $login;
                                    echo "<div class=\"alert alert-success\" role=\"alert\">
                                    Connexion réussie !
                                    </div>";
                                    redirect("index");
                                } else {
                                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    Identifiant et / ou mot de passe invalide(s) !
                                    </div>";
                                }
                            }
                        ?>
                        <div class="form-group">
                            <input type="submit" value="S'inscrire" class="btn float-right login_btn"></br>
                        </div>
                    </form>
                </div>
                <div class="card-footer">

                        Vous êtes un MJ ? <a href="#"> Insciption MJ</a>

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