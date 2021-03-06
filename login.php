<?php
    session_start();
    require_once("includes/fonction.php");
?>
<!doctype html>
<html>

<?php
    $pageTitle = "Connexion";
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
        <?php if(!isset($_SESSION['login'])){ ?>
            <div class="card_login">
                <div class="card-header">
                    <h3>Connexion</h3>
                </div>
                <div class="card-body">
                    <form role="form" action="login.php" method="post">
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
                        <div class="form-group form-check admin_check">
                            <input type="checkbox" class="form-check-input" id="admin" name="admin">
                            <label class="form-check-label" for="admin">Administrateur</label>
                        </div>
                        <?php
                            //Vérification que les champs ne sont pas vides
                            if((isset($_POST['login'])) && (isset($_POST['password']))){
                                $login = escape($_POST['login']);
                                $password = escape($_POST['password']);

                                if($BDD){
                                        
                                    //Récupération des utilisateurs de la BD en fonction de leur statut
                                    if(isset($_POST['admin'])){
                                        $MaRequete = "SELECT * FROM user_mj WHERE usr_login='" . $login . "'";
                            
                                        $Curseur = $BDD->query($MaRequete);
                                    }
                                    else
                                    {
                                        $MaRequete = "SELECT * FROM user_equipe WHERE usr_login='" . $login . "'";
                            
                                        $Curseur = $BDD->query($MaRequete);
                                    }
                                }
                                $tuple = $Curseur->fetch();

                                //Comparaison de l'existence de l'utilisateur et vérification du mot de passe à l'aide des fonctions de hashage
                                if(($login == $tuple['usr_login']) && (password_verify($password, $tuple['usr_password']))){
                                    $_SESSION['login'] = $login;
                                    if(isset($_POST['admin'])){
                                        $_SESSION['admin'] = true;
                                    }
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
                            <input type="submit" value="Login" class="btn float-right login_btn"></br>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Vous n'avez pas de compte ? <a href="register.php"> S'inscrire</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#">Mot de passe oublié ?</a>
                    </div>
                </div>
                
            </div>
            <?php }else{
                            echo "<div class=\"alert alert-danger\" role=\"alert\">
                            Vous êtes déjà connecté ! Pour vous connecter sur un autre compte, déconnectez vous d'abord.
                            </div>";
                        } ?>
        </div>
        
    </div>

    <?php
        require_once("includes/footer.php");
        require_once("includes/script.php");
    ?>
    </div>
</body>

</html>