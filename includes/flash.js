//Lighting script
var flash=0
function lightning()
{flash=flash+1;
if(flash==1){document.bgColor='white'; setTimeout("lightning()",1000);}
if(flash==2){document.bgColor='black'; setTimeout("lightning()",500);}
if(flash==3){document.bgColor='white'; setTimeout("lightning()",1000);}
if(flash==4){document.bgColor='black'; setTimeout("lightning()",500);}
if(flash==5){document.bgColor='white'; setTimeout("lightning()",1000);}
if(flash==6){document.bgColor='black'; setTimeout("lightning()",500);}
if(flash==7){document.bgColor='white'; setTimeout("lightning()",1000);}
if(flash==8){document.bgColor='black'; setTimeout("lightning()",10000);}


if(flash==9){flash=0; setTimeout("lightning()",100);}
}
setTimeout("lightning()",1);