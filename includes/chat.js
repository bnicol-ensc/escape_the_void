//Utilisation d'Ajax afin de réaliser les transfert de données pour le chat
//Données utilisant le format JSON et stockées dans un fichier de logs appelé "chat.txt"

var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
}

//Récupère l'état actuel du chat
function getStateOfChat(){
	if(!instanse){
		 instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "./includes/chat.php",
			   data: {  
			   			'function': 'getState',
						'file': file
						},
			   dataType: "json",
			
			   success: function(data){
				   state = data.state;
				   instanse = false;
			   },
			});
	}	 
}

//Met à jour le contenu du chat
function updateChat(){
	 if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "./includes/chat.php",
			   data: {  
			   			'function': 'update',
						'state': state,
						'file': file
						},
			   dataType: "json",
			   success: function(data){
				   if(data.text){
						for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
                        }								  
				   }
				   document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
				   instanse = false;
				   state = data.state;
			   },
			});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 }
}

//Permet d'envoyer un message dans le chat
function sendChat(message, nickname)
{       
    updateChat();
     $.ajax({
		   type: "POST",
		   url: "./includes/chat.php",
		   data: {  
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'file': file
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat();
		   },
		});
}
