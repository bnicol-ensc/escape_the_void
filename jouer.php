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
$_SESSION['eng_id'] = 1;
?>
     <div class="background">
        <div class="container-fluid">
            <?php       
                    require_once("includes/nav.php");
                    require_once("includes/connect.php");
                    

                    if($BDD){
                        $MaRequete = "SELECT * FROM bouton WHERE eng_id=".$_SESSION['eng_id'];
        
        
                        $STH = $BDD -> prepare( $MaRequete );
        
                        $STH -> execute();
                        $i = 0;
                        while($data = $STH->fetch()) {
                            $i+=1;
                            $data_array[] = $data;

                            // Si dessous pour conserver l'activation des boutons après leur activation

                            if(isset($_POST[$data['btn_name']])){
                                $MaRequete = 'UPDATE bouton SET btn_active = 1  WHERE eng_id='.$_SESSION['eng_id'].' AND btn='.$i;
                                $STH2 = $BDD -> prepare( $MaRequete );
                                $STH2 -> execute();
                            }
                            else  {
                                $MaRequete = 'UPDATE bouton SET btn_active = 0  WHERE eng_id='.$_SESSION['eng_id'].' AND btn='.$i;
                                $STH2 = $BDD -> prepare( $MaRequete );
                                $STH2 -> execute();
                            }
                                
                            
                         }
                        
                    }
            ?>
            
            <div class="row">
                <div class="col-md-3 console-buttons">
                    <form action="jouer.php" method="post">
                        <div class="btn-group-vertical" role="group" aria-label="Button group with nested dropdown">
                            <?php 
                                
                                foreach($data_array as $data) {
                                    echo "<label class=\"switch \">";
                                    if(isset($data['btn_active']) && $data['btn_active'] == 1)
                                        echo "<input class=\"switch-input\" checked  name=\"".$data['btn_name']."\" type=\"checkbox\" value=\"1\"/>";
                                    else echo "<input class=\"switch-input \" name=\"".$data['btn_name']."\" type=\"checkbox\" value=\"1\"/>";

                                    echo "<span class=\"switch-label\" data-on=\"".$data['btn_name']."\" data-off=\"".$data['btn_name']."\"></span> ";
                                    echo "<span class=\"switch-handle\"></span></label>";
                                }
                            ?>

                                    
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
                        

                            <button class="btn btn-warning" type="submit">
                                Envoyer les ordres
                            </button>   

                        </div>
                    </form>

                </div>
                <div class="col-md-6 d-flex">
                    <div class="console w-100 mh-100 rounded">
                        <div id="typedtext"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#chatbox" aria-expanded="false" aria-controls="chatbox">
                    Demander de l'aide
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
            </div>
        </div>
    </div>
        <script>

            var aText = new Array(
            <?php 
                foreach($data_array as $data) {
                    if($data['btn_type']=='Textual' && isset($_POST[$data['btn_name']])){
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