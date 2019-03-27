<?php
    session_start();
?>

<!doctype html>
<html>

<?php
    require_once("includes/head.php");
?>

<body>
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
                                    <option selected disabled>-- Alimentation --</option>
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
                    <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 40%"></div>
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
                /*"Ship >> Loading emergency procedure", 
                "Ship >> Emergency procedures not found, please refer to emergency manual, page 4",
                "Ship >> Do not panic, as a panicked crew has 95% more chances of dying in time of crisis",*/
                <?php //Il est surement pertinent de tout mettre dans une fonction au lieu d'écrire du code en vrac ici
            if($BDD){
                $MaRequete = "SELECT eg_description_short FROM escapegame WHERE eg_id=1";
                $CurseurFilm=$BDD->query($MaRequete);
                $i = 0;
                echo "\"";
                //$tuple->fetch(); //Peut être que ce n'est pas comme ça qu'on fait une DB
                $text = "";
                //echo $tuple['eg_description_short']; //Cette ligne bug
                /*while($i<12 - 1){
                    if($tuple['eg_description_short'][$i]=="\\" && $tuple['eg_description_short'][$i+1]=="n" ){
                        echo $text;
                        echo "\",\"";

                    }
                    else {
                        $text+=$tuple['eg_description_short'][i];
                    }
                    $i++;
                }

                */
                echo "Ship >> System failed Err42\""; // Ca au moins ça fonctionne, ce qui veut dire que le JS est opérationnel.
            }
            ?>

            );
        </script>
        <script src="includes/typewriter.js"></script>
        <script>
        typewriter();
        </script>

        <?php require_once("includes/footer.php");?>
        <?php require_once("includes/script.php"); ?>
    
</body>

</html>