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
        <div class="container-fluid">
            <?php       
                    require_once("includes/nav.php");
                    require_once("includes/connect.php");
                    

                    if($BDD){
                        $MaRequete = "SELECT * FROM bouton WHERE eng_id=".$_SESSION['eng_id'];
        
        
                        $STH = $BDD -> prepare( $MaRequete );
        
                        $STH -> execute();
                        while($data = $STH->fetch()) {
                            $data_array[] = $data;
                            if($data['btn_type']=='JS'){
                                //echo $donnees['btn_content'];
                            }
                         }
                        
                    }
            ?>
            
            <div class="row">
                <div class="col-md-3 console-buttons">
                    <form action="jouer.1.php" method="POST">
                        <input class="btn btn-warning" name='alpha' type="checkbox" value="TESTING">
                                bouton test
                        </button>  
                    
                    
                        <button class="btn btn-warning" type="submit">
                                Envoyer le courant
                        </button>   
                    </form>

                </div>
                <div class="col-md-3 console-buttons">
                    <?php
                        if(isset($_Post['alpha'])){
                            echo $_Post['alpha'];
                        }
                        echo "Verif";

                    ?>
                </div>


            </div>
        </div>
        <script>

            var aText = new Array(
            <?php 
                echo "\"";
                foreach($data_array as $data) {
                    if($data['btn_type']=='Textual' /* && $_Post[$data['btn_name']]==1 */){
                        echo $data['btn_content'];
                        echo $_Post;
                        echo "</br>";
                    }
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