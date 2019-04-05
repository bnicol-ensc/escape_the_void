<?php
    session_start();
?>

<!doctype html>
<html>

<?php require_once("includes/head.php");
require_once("includes/connect.php");

//Assignation des variables de session propre à la partie de l'utilisateur lors de son début de partie.
if(!isset($_SESSION['eng_id'])) {

    $_SESSION['eng_id'] = 1;
    $_SESSION['eng_time'] = (date("s") + date("m")*60+date("h")*3600);

    
    $MaRequete = "INSERT INTO `enigmecours` (`equipe`,`eng_id`, `finie`) VALUES ('".$_SESSION['login']."', '1', '0')";
    $STH2 = $BDD -> prepare( $MaRequete );
    $STH2 -> execute();
}
if(!isset($_SESSION['eg_id'])) {
    $_SESSION['eg_id'] = $_GET['id'];

    
    $MaRequete = "INSERT INTO `escapegamecours` (`eg_id`,`eng_cours`) VALUES (".$_SESSION['eg_id'].", '".$_SESSION['login']."')";
    $STH2 = $BDD -> prepare( $MaRequete );
    $STH2 -> execute();
}

?>
<body onload="setInterval('chat.update()', 1000)">
<!-- Une div est réservée à l'image d'arrière plan -->
     <div class="background">
     <?php require_once("includes/nav.php");?>
        <div class="container-fluid">
            <?php       
                    
                    $End = TRUE; // Cette variable vérifie si l'énigme est la dernière énigme ou si la partie peur continuer.

                    if($BDD){
                        $MaRequete = "SELECT * FROM bouton WHERE eng_id=".$_SESSION['eng_id']." ORDER BY btn";
        
        
                        $STH = $BDD -> prepare( $MaRequete );
        
                        $STH -> execute();
                        $i = 0;
                        $val = TRUE;
                        // pour chaque bouton sélectionné, on le crée
                        while($data = $STH->fetch()) {
                            $i+=1;
                            // Si dessous pour conserver l'activation des boutons après leur activation

                            if(isset($_POST[$data['btn_name']])){
                                $MaRequete = 'UPDATE bouton SET btn_active = 1  WHERE eng_id='.$_SESSION['eng_id'].' AND btn='.$i;
                                $STH2 = $BDD -> prepare( $MaRequete );
                                $STH2 -> execute();
                                $data['btn_active'] = 1;


                            }
                            else  {
                                $MaRequete = 'UPDATE bouton SET btn_active = 0  WHERE eng_id='.$_SESSION['eng_id'].' AND btn='.$i;
                                $STH2 = $BDD -> prepare( $MaRequete );
                                $STH2 -> execute();
                                $data['btn_active'] = 0;
                            }
                            // On verifie si on est dans la bonne configuration pour passer à l'énigme suivante.
                            if($data['btn_expected'] != $data['btn_active']){
                                $val = FALSE;
                            }
                            //On vérifie si un bouton de fin est présent dans l'énigme.
                            if($data['btn_type'] == 'End'){
                                $End = FALSE;
                            }
                            $data_array[] = $data;
                        }
                        // On passe a l'énigme suivante en mettant à jour les variables de session et la base de donnée.
                         if($val == TRUE && $i != 0) {
                            $_SESSION['eng_id'] += 1;
                            $time_temp = (date("s") + date("m")*60+date("h")*3600);
                            $MaRequete = "  UPDATE enigmecours SET finie = 1, temps =".($time_temp - $_SESSION['eng_time'])."  WHERE equipe='".$_SESSION['login']."'; 
                                            INSERT INTO `enigmecours` (`equipe`,`eng_id`, `finie`) VALUES ('".$_SESSION['login']."', '".$_SESSION['eng_id']."', '0');";                                            
                                $STH2 = $BDD -> prepare( $MaRequete );
                                $STH2 -> execute();
                            $_SESSION['eng_time'] = $time_temp;
                            header('Location:jouer.php');
                        }
                        
                    }
            ?>

            
            <div class="row  align-content-center">
                <div class="col-md-3 console-buttons">
                    <form action="jouer.php" method="post">
                        <div class="btn-group-vertical" role="group" aria-label="Button group with nested dropdown">
                            <?php 
                                if($End){
                                    echo $i."</br>";
                                    echo $_SESSION['eng_id'];
                                    foreach($data_array as $data) {
                                        echo "<label class=\"switch \">";

                                        // on fabrique les boutons sur lesquels le joueur va pouvoir cliquer.
                                        if(isset($data['btn_active']) && $data['btn_active'] == 1)
                                            echo "<input class=\"switch-input\" checked  name=\"".$data['btn_name']."\" type=\"checkbox\" value=\"1\"/>";
                                        else echo "<input class=\"switch-input \" name=\"".$data['btn_name']."\" type=\"checkbox\" value=\"1\"/>";
    
                                        echo "<span class=\"switch-label\" data-on=\"".$data['btn_name']."\" data-off=\"".$data['btn_name']."\"></span> ";
                                        echo "<span class=\"switch-handle\"></span></label>";
                                    }
                                }
                                else {
                                    // si la partie est terminée, un bouton continuer permet de terminer la partie.
                                    echo "<a class=\"btn btn-primary\" href=\"terminer_partie.php\">Continuer</a>";
                                    $time_temp = (date("s") + date("m")*60+date("h")*3600);
                                    $MaRequete = "  UPDATE enigmecours SET finie = 1, temps =".($time_temp - $_SESSION['eng_time'])."  WHERE equipe='".$_SESSION['login']."';"                                    $STH2 = $BDD -> prepare( $MaRequete );
                                    $STH2 -> execute();
                                }
                                

                            ?>

     <!-- Ici était une expérience sur un type de bouton différent pour les énigmes. -->   

<!--                            <div class="btn-group" role="group">
                                <div class="col-auto my-1">
                                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option selected disabled>  --- Alimentation ---  </option>
                                        <option value="1">Générateur Principal</option>
                                        <option value="2" >Générateur d'urgence</option>
                                        <option value="3" disabled>Générateur Secondaire</option> 
                                    </select>
                                </div>
                            </div> -->

        <!-- Ici était une expérience sur un type de bouton différent pour les énigmes. -->   

                        

                            <button class="btn btn-warning" type="submit">
                                Envoyer les ordres
                            </button>   

                        </div>
                    </form>

                </div>
                <div class="col-md-6 d-flex">
                <!--  l'affichage de la console, et l'identification de la zone ou typewritter.js peut agir -->
                    <div class="console w-100 mh-100 rounded">
                        <div id="typedtext"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                        <!-- Le chat d'aide, caché derrière un bouton pour qu'il ne l'utilise qu'en cas de problème et essaye de chercher par lui même -->
                            <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#chatbox" aria-expanded="false" aria-controls="chatbox">
                            Demande d'aide
                            </button>
                            <div class="collapse" id="chatbox">
                                <div class="container-fluid row h-100">
                                    <div id="page-wrap">
                                        <h2>Chat</h2>
                                        <div id="chat-wrap"><div id="chat-area"></div></div>
                                        <form id="send-message-area">
                                            <p>Saisir votre message : </p>
                                            <textarea id="sendie" maxlength = '100' ></textarea>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <!-- Redirection vers une fin de partie -->
                        <a class="btn btn-secondary" href="terminer_partie.php" role="button">Abandonner</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script>
            /* Préparation de la variable qui sera utilisée par typewriter.js pour animer les informations dans la console */
            var aText = new Array(
            <?php 
                foreach($data_array as $data) {
                    if($data['btn_type']=='Textual' && $data['btn_active']==1){
                        echo "\"";
                        echo $data['btn_content'];
                        echo "\","; 
                    }
                }

            ?>

            );
        </script>
        <script src="includes/typewriter.js"></script>
        <script>typewriter();</script>

        <?php require_once("includes/footer.php");?>
        <?php require_once("includes/script.php"); ?>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="./includes/chat.js"></script>
        <script type="text/javascript">

            // get user name from session    
            var name = '<?php echo $_SESSION['login'];?>'
/* Chat */
            // kick off chat
            var chat =  new Chat();
            $(function() {
            
                chat.getState(); 
                
                // watch textarea for key presses
                $("#sendie").keydown(function(event) {  
                
                    var key = event.which;  
            
                    //all keys including return.  
                    if (key >= 33) {
                    
                        var maxLength = $(this).attr("maxlength");  
                        var length = this.value.length;  
                        
                        // don't allow new content if length is maxed out
                        if (length >= maxLength) {  
                            event.preventDefault();  
                        }  
                    }  
                                                                                                                                                                                                                });
                // watch textarea for release of key press
                $('#sendie').keyup(function(e) {	
                                    
                    if (e.keyCode == 13) { 
                    
                        var text = $(this).val();
                        var maxLength = $(this).attr("maxlength");  
                        var length = text.length; 
                        
                        // send 
                        if (length <= maxLength + 1) { 
                        
                            chat.send(text, name);	
                            $(this).val("");
                            
                        } else {
                        
                            $(this).val(text.substring(0, maxLength));
                            
                        }	
                        
                        
                    }
                });
                
            });
        </script>

            
</body>

</html>