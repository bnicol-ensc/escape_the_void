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
        ?>

        <div class="container-fluid h-100">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#p1" data-toggle="tab">Escape game 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#p2" data-toggle="tab">Escape game 2</a>
            </li>
        </ul>


        <div class="tab-content">
            <div class="tab-pane active" id="p1">

                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#chatbox" aria-expanded="false" aria-controls="chatbox">
                    Ouvrir le chat
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

            <div class="tab-pane" id="p2">
                Panneau 2
            </div>

        </div>

</div>
        <?php require_once("includes/footer.php");?>
        <?php require_once("includes/script.php"); ?>

    </div>

</body>

</html>