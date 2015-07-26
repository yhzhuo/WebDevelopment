<SCRIPT TYPE="text/javascript">
//incompleted
//remember to include global which has get cookie codes
//remember to consider cookies' "zuoyongyu"
	
	function send(groupId,message,username,uid) {   //here content is the message above, senderId should get from a cookie
		//var username = var strCookie=document.cookie;	// ?????????cookie?
		var message = document.getElementById("type").innerHTML;
		//process message begin
		var aida = "";     //aida and reply should all be splited by ";" and the inner side should all be changed   ok
		var start = 0;
		var end = 0;
		while(start < message.length) {   //may has problems
			start = findNextIndex(message,"@",start);
			start = findNextIndex(message,"{{{",start);
			end = findNextIndex(message,"}}}",start);
			if(start != end) {
				aida += message.substring(start+1,end-2);
				aida += ";"
			}
		}
		start = 0;
		end = 0;
		var reply = "";
		while(start < message.length) {   //may has problems
			start = findNextIndex(message,"r:/",start);
			start = findNextIndex(message,"{{{",start);
			end = findNextIndex(message,"}}}",start);
			if(start != end) {
				reply += message.substring(start+1,end-2);
				reply += ";"
			}
		}
		message.replace("r:/", "<font color="red">r:/");
		message.replace("@", "<font color="red">@");
		message.replace("}}}", "}}}</font>");
		//remember to replace all the aida and reply    ok
		// remember to set the aida and reply here. You can use the words processing function in php    ok
		message = "<font color="red">"+username+":</font>&nbsp;&nbsp"+message+"<a onclick=reply(username,uid)>"+reply+"</a>";    //may has problems here
		//remember to write the function "reply(username,uid)"
		//process message end
		document.getElementById("board").innerHTML = document.getElementById("board").innerHTML+"<p>"+message;
		document.getElementById("type").innerHTML = "";
			//don't know if javascript can use php's cookie
		
		
		var url = "http://localhost/uwnet/phpparts/send_messages.php?groupId="+groupId+"&senderId="+uid+"&content="+message+"&reply="+reply+"&aida="+aida;  //need to use array to split self cookie
        var request;
		if(navigator.appName != "Microsoft Internet Explorer") {       //not IE
			request =  new XMLHttpRequest();
		} else {
			request =  new ActiveXObject(“Microsoft.XMLHTTP”);
		}
        request.open("GET", url, true);
        request.setRequestHeader("Content-Type","application/x-javascript;");
        request.onreadystatechange = function() {
            if (request.readyState != 4 || request.status != 200 || request.responseText != "ok") {
						document.getElementById("board").innerHTML = document.getElementById("board").innerHTML+"<p>"+"This message can't be sent, please check your web connection and send it again";
            }
        }
        request.send(null);
	}
</SCRIPT>