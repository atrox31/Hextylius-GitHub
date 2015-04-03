function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}

function tryToRegister( fields ){
    //username: $('#username').val(), 
    //email: $('#email').val(), 
    //password: $('#password').val(),
    // race: $('#race').val()
    //repassword: $('#repassword').val(), 
    //terms: $('#terms').prop('checked')
    var variables = "";
    variables +=  "username=" + fields.username;
    variables +=  "&" + "password=" + fields.password;
    variables +=  "&" + "email=" + fields.email;
    variables +=  "&" + "repassword=" + fields.repassword;
    variables +=  "&" + "terms=" + fields.terms;
    variables +=  "&" + "subdomen=" + fields.subdomen;

    getAction( "register", "jsRespond", variables);

}

function resize (image, new_width, new_height) {
        mainCanvas = document.createElement("canvas");
        mainCanvas.width = new_width;
        mainCanvas.height = new_height;
        var ctx = mainCanvas.getContext("2d");

        ctx.drawImage(document.getElementById(image), 0, 0, mainCanvas.width, mainCanvas.height);
        
        var thisImage = new Image();
        thisImage = mainCanvas.toDataURL("image/png");

        return thisImage.src;
};


function hexToRGB(hex)
{
    var long = parseInt(hex.replace(/^#/, ""), 16);
    return {
        R: (long >>> 16) & 0xff,
        G: (long >>> 8) & 0xff,
        B: long & 0xff
    };
}

function getAction( action, respons, variables){
var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  }else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
			$('#' + respons).html( xmlhttp.responseText );
		}
	  }
	xmlhttp.open("GET","scripts/"+action+".php?"+variables,true);
	xmlhttp.send();
}

function msToTime(time){
	var h=0; var m=0; var s=0; var str = ""; 
	while (time>=3600) { h++; time-=3600; }; 
	while (time>=60) { m++; time-=60; }; 
	s = time; 
	
	if (h>0) if (h<10) str+='0'+h+':'; else str+=h+':'; else str+='00:'; 
	if (m<10) str+='0'+m+':'; else str+=m+':'; 
	if (s<10) str+='0'+s; else str+=s; 

	return str;
}

function sqr( x ){
	return (x*x);
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
} 

setInterval( function(){
						document.cookie = "UserTop="+window.pageYOffset;
						}, 
						1000
			);	
$(document).ready(function() {
	
	window.scrollTo(0,getCookie("UserTop"));

});