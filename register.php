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

    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Inscription</h3>
                </div>
                <div class="card-body">
                    <form role="form" action="register.php" method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="login" class="form-control" placeholder="Entrez votre login" required autofocus>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
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
                            <input type="submit" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Vous n'avez pas de compte ? <a href="#"> S'inscrire</a>
                    </div>
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