<?php
    session_start();
?>

<!doctype html>
<html>

<?php
    require_once("includes/head.php");
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="./includes/chat.js"></script>
<script type="text/javascript">

    // get user name from session    
    var name = '<?php echo $_SESSION['login'];?>'

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



<body onload="setInterval('chat.update()', 1000)" class="d-flex flex-column">

    <div class="background">
        
        <?php       
            require_once("includes/nav.php");
            require_once("includes/connect.php");
        
                if($BDD){
                    $MaRequete = "Select * From escapegamecours;";

                    $sth = $BDD -> prepare($MaRequete);
                    $sth -> execute();
                }

                $result = $sth -> fetchAll();
        ?>

        <div class="container-fluid h-100">

<?php if(isset($_SESSION['admin'])){ ?>



        <ul class="nav nav-tabs">
            <?php
                for($i=0;$i<count($result);$i++){
                    echo "<li class=\"nav-item\">";
                    echo "<a class=\"nav-link\" href=\"#p" . ($i+1) . "\" data-toggle=\"tab\">Escape game " . ($i+1) . "</a>";
                    echo "</li>";
                }
            ?>
            <li class="nav-item">
                <a class="nav-link active" href="#pstat" data-toggle="tab">Statistiques</a>
            </li>
        </ul>


        <div class="tab-content">
            <?php
                for($i=0;$i<count($result);$i++){
                    if($BDD){
                        $MaRequete = "Select eg_id, eg_nom, eg_temps_max From escapegame
                                    Where eg_id =" . $result[$i]['eg_id'] . ";";
    
                        $sth = $BDD -> prepare($MaRequete);
                        $sth -> execute();

                        $result_contenu = $sth -> fetch();


                        $MaRequete_equipe = "Select usr_nom From user_equipe
                        Where usr_login ='" . $result[$i]['eng_cours'] . "';";

                        $sth_equipe = $BDD -> prepare($MaRequete_equipe);
                        $sth_equipe -> execute();

                        $result_contenu_equipe = $sth_equipe -> fetch();


                        $MaRequete_enigme = "Select e.eng_content, ec.temps, ec.finie, e.eng_id  From enigmecours ec, enigme e
                        Where ec.equipe ='" . $result[$i]['eng_cours'] . "'
                        And ec.eng_id = e.eng_id;";

                        $sth_enigme = $BDD -> prepare($MaRequete_enigme);
                        $sth_enigme -> execute();

                        $result_contenu_enigme = $sth_enigme -> fetchAll();
                    }

                    echo "<div class=\"tab-pane\" id=\"p" . ($i+1) . "\">";

                    echo "<div class=\"description container-fluid\">";

                    echo "<div class=\"row\">";

                    echo "<div class=\"col-9\">";

                    echo "<div class=\"card bg-dark col-6\">";
                    echo "<div class=\"card-header\"><h2>Description : </h2></div>";
                    echo "<div class=\"card-body\">";
                    echo "<p>Nom : " . $result_contenu['eg_nom'] . "</p>";
                    echo "<p>Temps max : " . ($result_contenu['eg_temps_max']/60) . " minutes</p>";
                    echo "<p>Equipe participante : " . $result_contenu_equipe['usr_nom'] . "</p>";
                    echo "</div>";
                    echo "</div>";

                    echo "</br><h2>Enigmes : </h2>";

                    echo "<table class=\"table table-hover table-dark col-10\">
                    <thead>
                      <tr>
                        <th scope=\"col\">#</th>
                        <th scope=\"col\">Contenu</th>
                        <th scope=\"col\">Temps</th>
                        <th scope=\"col\">Finie</th>
                        <th scope=\"col\">Indice</th>
                      </tr>
                    </thead>
                    <tbody>";

                    for($j=0;$j<count($result_contenu_enigme);$j++){
                        echo "<tr>";
                        echo "<td><p>" . ($j+1) . "</p></td>";
                        echo "<td><p>" . $result_contenu_enigme[$j]['eng_content'] . "</p></td>";
                        echo "<td><p>";
                        if($result_contenu_enigme[$j]['temps'] == null){
                            echo "N/A";
                        }else{
                            echo $result_contenu_enigme[$j]['temps'];
                        }
                        echo "</p></td>";
                        echo "<td><p>";
                        if($result_contenu_enigme[$j]['finie'] == "1"){
                            echo "Validée";
                        }else{
                            echo "Non validée";
                        }
                        echo "</p></td>";

                        
                        if($BDD){
                            $MaRequete_indice = "Select indice_text From Indice
                            Where eng_id =" . $result_contenu_enigme[$j]['eng_id'] . ";";
    
                            $sth_indice = $BDD -> prepare($MaRequete_indice);
                            $sth_indice -> execute();
    
                            $result_contenu_indice = $sth_indice -> fetchAll();
                        }   

                        echo "<td>";
                        for($k=0;$k<count($result_contenu_indice);$k++){
                            print "<p><button type=\"button\" class=\"btn btn-primary\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"" . $result_contenu_indice[$k]['indice_text'] . "\" onClick=\"sendChat('" . addslashes($result_contenu_indice[$k]['indice_text']) . "','" . $_SESSION['login'] . "')\">";
                            echo "Donner un indice";
                            echo "</button></p>";
                        }
                        echo "</td></tr>";
                    }
                    echo "</tbody>
                    </table>";

                    echo "</div>";
                    echo "<div id=\"chatbox\" class=\"col-3\">
                    <div class=\"container-fluid row h-100\">
                        <div id=\"page-wrap\">
                            <h2>Chat</h2>
                            <div id=\"chat-wrap\"><div id=\"chat-area\"></div></div>
                            <form id=\"send-message-area\">
                                <p>Saisir votre message : </p>
                                <textarea id=\"sendie\" maxlength = '1000' ></textarea>
                            </form>
                        </div>
                    </div>
                </div>";

                    echo "</div>";


                    echo "</div>";

                    echo "</div>";
                }
            ?>

            <div class="tab-pane" id="pstat">
            <?php
                if($BDD){
                    $MaRequete_stats = "Select * From statistiqueenigme;";

                    $sth_stats = $BDD -> prepare($MaRequete_stats);
                    $sth_stats -> execute();

                    $result_contenu_stats = $sth_stats -> fetchAll();
                }
            ?>
                <div class="description container-fluid">
                    <h2>Statistiques :</h2>
                    <div class="row">
                        <div class="card text-white bg-dark col-3">
                            <div class="card-header"><h4>Temps moyen par énigmes</h4></div>
                            <div class="card-body">

                                <?php
                                    if(count($result_contenu_stats) != 0){
                                        $somme = 0;
                                        for($it=0;$it<count($result_contenu_stats);$it++){
                                            $somme += $result_contenu_stats[$it]['temps'];
                                        }
                                        $moyenne = $somme / count($result_contenu_stats);
                                        echo "<p>Moyenne totale des énigmes : " . $moyenne . " secondes.</p>";
                                    }else{
                                        echo "<p>Aucune donnée n'est stockée, les statistiques ne sont donc pas disponibles.</p>";
                                    }
                                ?>

                            </div>
                        </div>
                        <div class="card text-white bg-dark col-3">
                        <div class="card-header"><h4>Temps moyen par équipe</h4></div>
                            <div class="card-body">
                                <?php
                                    if(count($result_contenu_stats) != 0){
                                        echo "<p>Work in progress...</p>";
                                    }else{
                                        echo "<p>Aucune donnée n'est stockée, les statistiques ne sont donc pas disponibles.</p>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="card text-white bg-dark col-3">
                        <div class="card-header"><h4>Autres statistiques ... </h4></div>
                            <div class="card-body">
                                <p>1 - Some stat</p>
                                <p>2 - Antoher stat</p>
                                <p>3 - ...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php }else{
                echo "<div class=\"alert alert-danger\" role=\"alert\">
                Accès interdit si vous n'êtes pas MJ !
                </div>";
            } ?>

        </div>
    </div>

        <?php require_once("includes/footer.php"); ?>
        <?php require_once("includes/script.php"); ?>

    </div>

</body>

</html>