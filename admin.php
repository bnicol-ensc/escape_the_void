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

    // ask user for name with popup prompt    
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



<body onload="setInterval('chat.update()', 1000)">

    <div class="background">
            <div class="container-fluid">
            <?php       
                    require_once("includes/nav.php");
                    require_once("includes/connect.php");
            ?>

            <div class="container-fluid row">
                <div class="col-8">
                    <h2 style="color=white;">MJ</h2>
                </div>
                <div class="col-4">
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

            <?php require_once("includes/footer.php");?>
            <?php require_once("includes/script.php"); ?>
    </div>

</body>

</html>