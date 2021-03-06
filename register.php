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
                    <h3>Inscription équipe</h3>
                </div>
                <div class="card-body">
                    <form role="form" class="inscription" action="register.php" method="post">
                        <div class="form-group row">
                            <label for="login" class="col-sm-3 col-form-label">Nom d'utilisateur : </label>
                            <input type="text" name="login" class="form-control col-sm-9" required autofocus>
                        </div>
                        <div class="form-group row">
                            <label for="nom_equipe" class="col-sm-3 col-form-label">Nom de l'équipe : </label>
                            <input type="text" name="nom_equipe" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Mot de passe : </label>
                            <input type="password" name="password" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Confirmer le mot de passe : </label>
                            <input type="password" name="password_rpt" class="form-control col" required>
                        </div>

                        <?php
                            //Vérification que les champs ne sont pas vides
                            if(isset($_POST['login']) && isset($_POST['nom_equipe']) && isset($_POST['password']) && isset($_POST['password_rpt'])){
                                //Modification des entrées pour éviter les injections
                                $login = escape($_POST['login']);
                                $nom_equipe = escape($_POST['nom_equipe']);
                                $password = escape($_POST['password']);
                                $password_rpt = escape($_POST['password_rpt']);

                                if($password == $password_rpt){
                                    //hashage du mot de passe avant l'insertion dans la base de données
                                    $hash = password_hash($password, PASSWORD_DEFAULT);
                                    $req = $BDD->prepare('INSERT INTO user_equipe (usr_nom, usr_login, usr_password) VALUES(:nom_equipe, :login, :password)');
                                    $req->execute(array(
                                        'nom_equipe' => $nom_equipe,
                                        'login' => $login,
                                        'password' => $hash,
                                    ));

                                    if(!empty($result)) {
                                        $error_message = "";
                                        $success_message = "Inscription réussie !";	
                                        unset($_POST);
                                    } else {
                                        $error_message = "Problème durant l'insciption. Veuillez réessayer !";	
                                    }

                                    //Affectation des variables de sessions puis redirection sur la page d'acceuil
                                    $_SESSION['login'] = $login;
                                    redirect("index");
                                } else {
                                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    Les mots de passe ne sont pas les mêmes !
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
                    Vous êtes un MJ ? <a href="register_mj.php"> Insciption MJ</a>
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