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
        
                        $result = $STH -> fetch();

                    }
            ?>
            
            <div class="row">
                <div class="col-md-3 console-buttons">
                    <form action="action.php" method="post">
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
                            <?php 
                            for ($i = 0; $i<6 ;$i++) {
                                echo "<label class=\"switch\">";
                                //echo $result['btn_hidden']."
                                echo "<input class=\"switch-input\" type=\"checkbox\" />";
                                echo "<span class=\"switch-label\" data-on=\"".$result['btn_name']."\" data-off=\"Lumière\"></span> ";
                                echo "<span class=\"switch-handle\"></span></label>";
                            }
                            
                            ?>
                            <button type="button" class="btn btn-console rounded">Lumière</button>
                            <button type="button" class="btn btn-console rounded">Navette Secours</button>
                            <button type="button" class="btn btn-console rounded">Diagnostique</button>
                            <button type="button" class="btn btn-console rounded disabled">Réparations</button>
                            <button type="button" class="btn btn-console rounded disabled">Communication</button>
                    </form>
                    </div>
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
            <?php 
                echo "\"";

                foreach($result as $row) {
                    echo $row;
                }

                echo "\""; 
            ?>

            );
        </script>
        <script src="includes/typewriter.js"></script>
        <script src="includes/flash.js"></script>

        <script>
        //initialiseText();
        typewriter();
        lightning();
        </script>

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