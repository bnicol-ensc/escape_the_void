<?php
    session_start();
?>

<!doctype html>
<html>

<?php
    require_once("includes/head.php");
?>

<body>

    
    <?php       
            require_once("includes/nav.php");
            require_once("includes/connect.php");
            require_once("includes/connect.php");
    ?>
        <!-- Le carousel donne les escapeGame vedettes, il reprend donc les trois parties dont on a développé un résumé -->
        <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/Command.jpg" class="d-block w-100" alt="A dark corridor in a spaceship leading to a door">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Escape the VOID</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/asteroid.jpg" class="d-block w-100" alt="Asteroids in front of a huge planet">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Finding Home</h5>
                        <p>Work in progress, part II of Escape the VOID</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/lostlights.jpg" class="d-block w-100" alt="Blue lights">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>It stares back</h5>
                        <p>Work in progress, part III of Escape the VOID</p>
                    </div>
                </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Ici l'appel a le base de donnée permet de créer des cartes avec une référence à chaque escapeGame qu'elle contient -->
        <div class="row liste">
            <?php
                if($BDD){
                    $MaRequete = "SELECT * FROM escapegame Order By eg_id";
                    $CurseurFilm=$BDD->query($MaRequete);
                    $i = 0;
                    while ($tuple=$CurseurFilm->fetch()) {
                        echo "<div class=\"col-md-3 d-flex justify-content-center\"> <div class=\"card\">";
                        echo "<img class=\"card-img-top\" src=\"images/".$tuple['eg_image']."\" alt=\"Card image cap\">";
                        echo "<div class=\"card-body\"><h5 class=\"card-title\">".$tuple['eg_nom']."</h5>";
                        echo "<p class=\"card-text\">".$tuple["eg_description_short"]."</p>";
                        echo "</div>";
                        echo "<ul class=\"list-group list-group-flush\">";
                        echo "<li class=\"list-group-item\">Temps de la mission : ".round($tuple["eg_temps_max"]/60)." minutes</li>";
                        echo "<li class=\"list-group-item\">"."Dapibus ac facilisis in"."</li>";
                        echo "</ul>";
                        echo "<div class=\"card-body\">";
                        /* Si le joueur n'est pas connecté, on lui propose de se connecter ou de s'inscrire. Sinon il peut jouer. */
                        if(!isset($_SESSION['login']) ) {
                            echo "<a href=\"login.php\" class=\"btn btn-card\">Se Connecter</a>"; 
                            echo "<a href=\"register.php\" class=\"btn btn-card-secondary\">S'enregistrer</a>";
                        }
                        else echo "<a href=\"jouer.php?id=".$tuple["eg_id"]."\" class=\"btn btn-card\">Jouer</a>";
                        echo "</div></div></div>";
                        /* Gestion du retour à la ligne : si on a affiché 4 escapegames, on créé in nouveau row et on recommence.
                        De cette manière les colonnes gardent une taille raisonnable. */
                        if($i == 3) {
                            echo "</div><div class=\"row liste\">";
                            $i = 0;
                        }
                        else $i++;
                        
                    }
                    if($i != 0) {
                        echo "</div>";
                        $i = 0;
                    }
                }

            ?>
    </div>

    <?php require_once("includes/footer.php");?>
    <?php require_once("includes/script.php"); ?>
</body>

</html>