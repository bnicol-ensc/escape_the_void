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
// il faut peut être initialiser ailleurs
$_SESSION['eng_id'] = 1;



?>
<?php ?>
    <div class="background">
        <div class="container-fluid">
            <?php       
                    require_once("includes/nav.php");
                    require_once("includes/connect.php");
            ?>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="console w-100 mh-100 rounded">
                        <div id="typedtext"></div>
                    </div>
                </div>
                <div class="col-md-3 console-buttons">
                    <div class="btn-group-vertical" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                            <div class="col-auto my-1">
                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option selected disabled>  --- Alimentation ---  </option>
                                    <option value="1">Générateur Principal</option>
                                    <option value="2" >Générateur d'urgence</option>
                                    <option value="3" disabled>Générateur Secondaire</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="btn btn-console rounded">Lumière</button>
                        <button type="button" class="btn btn-console rounded">Navette Secours</button>
                        <button type="button" class="btn btn-console rounded">Diagnostique</button>
                        <button type="button" class="btn btn-console rounded disabled">Réparations</button>
                        <button type="button" class="btn btn-console rounded disabled">Communication</button>
                    </div>
                </div>

                <div class="col-md-3 d-flex">

                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 d-flex">

                </div>
                <div class="col-md-3 d-flex">
                </div>
            </div>

        </div>
    </div>
        <script>

            var aText = new Array(
                <?php //Il est surement pertinent de tout mettre dans une fonction au lieu d'écrire du code en vrac ici
            if($BDD){
                $MaRequete = "SELECT eng_content FROM enigme WHERE eng_id=".$_SESSION['eng_id'];
//ICI il faut stocker tous les boutons et que je passe la recherche en haut.
                echo "\"";
//Zone de test à supprimer d'ici la publication finale
                if(isset($_POST['']))
                    echo "test true </br>";
                else 
                    echo "test false </br>";
//Fin de zone de test, vous êtes de retour en sécurité
                $STH = $BDD -> prepare( $MaRequete );

                $STH -> execute();

                $result = $STH -> fetch();

                echo $result ["eng_content"];

                echo "\""; 
            }
            ?>

            );
        </script>
        <script src="includes/typewriter.js"></script>
        <script>
        //initialiseText();
        typewriter();
        </script>

        <?php require_once("includes/footer.php");?>
        <?php require_once("includes/script.php"); ?>
    
</body>

</html>