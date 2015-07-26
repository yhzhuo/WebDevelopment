//pre: $curi is the first index of valuable information part, 
//$str is the total information, $word is the part that need to find
//post: return last index of first occurence of $word
dlert("globaljs is in");
function findNextIndex(str,sub,curi) {
	var j = 0; var totallen = str.length;
	var sublen = sub.length; var i = 0;
	for(i = curi; i < totallen && j < sublen; i++) {   //note: either this version or the php version has problem
		if(str.charAt(i) == sub.charAt(j)) {
			j++;
		} else if(j > 0) {
			j--; i--;
		}
	}
	return i-1;
}

//post: return true if it's IE
function isIE() {
	return navigator.appName=="Microsoft Internet Explorer";
}



//post: return the parameter of GET passing value as a variable or a array, the value mixed with name, "=", and real value
//return false if no GET passing value
function urlValues() {
	var str,pos,parastr;
	str = window.location.href;
	pos = str.indexOf("?")
	if(pos > 0) {
		parastr = str.substring(pos+1);
		if(parastr.length > 0) {
			return parastr.split("&");
		}
	}
	return false;
}

//pre: input whole address, include URL passed values
//post: if function get response normally, return the response, else return false
function ajaxRequest(url) {                                                              // we may also set a time control step
	//alert(url);  //
	//document.getElementById("processing").style.visibility="visible";
	var xmlhttp;
	//var returnText = "failed";
	xmlhttp = null;
	if (window.XMLHttpRequest) {// code for Firefox, Opera, IE7, etc.
	  xmlhttp=new XMLHttpRequest();
	} else if (window.ActiveXObject) {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//alert('ajax created');    //
	//alert("url before improve: "+ url);
	//a start
	if(isIE()) {
		var rand1 = Math.random();
		rand1 = parseInt(rand1*10000+1);
		var d=new Date();
		var a = d.getTime() + rand1;
		url += "&improve="+a;
	}
	//a end
	//alert("url after improve: "+ url);
	
	if (xmlhttp!=null) {
		//alert('ajax supported');
	  xmlhttp.open("GET",url,false);
	  xmlhttp.send(null);
	  if(xmlhttp.readyState != 4 || xmlhttp.status != 200) {
		xmlhttp.abort();
		//document.getElementById("processing").style.visibility="hidden";
		return false;
	  }
	  var returnText = xmlhttp.responseText;
	  //alert('ajaxresponseText: ' + returnText);//
	  if(returnText == "failed") {
	    //document.getElementById("processing").style.visibility="hidden";
		return false;
	  }
	  }
	else
	  {
	  alert("Your browser does not support XMLHTTP.");
	  }
	  //document.getElementById("processing").style.visibility="hidden";
	  //alert('ajaxresponseText befort return: ' + returnText);//
	  return returnText;
	
	// below is the original failed codes
	/*
	var request =  new XMLHttpRequest();
    request.open("GET", url, true);
    request.setRequestHeader("Content-Type","application/x-javascript;");
    request.onreadystatechange = function() {
		if (request.readyState == 4) {
			if (request.status == 200){
				if (request.responseText && request.responseText != "failed") {
					return request.responseText;
				}
			}
		}
		return false;
	}
	*/
}

//This function can be used to get php's cookie
         function GetCookie(cookieName) {
                 var cookieString = document.cookie;
                 var start = cookieString.indexOf(cookieName + '=');
                 if (start == -1) // can't find
                         return null;
                 start        += cookieName.length + 1;
                 var end = cookieString.indexOf(";", start);
                 if (end == -1) return unescape(cookieString.substring(start));
                 return unescape(cookieString.substring(start, end));
         }
//This function can be used to get php's cookie
         function getCookie(cookieName) {
				return GetCookie(cookieName);
                /* 
				 var cookieString = document.cookie;
                 var start = cookieString.indexOf(cookieName + '=');
                 if (start == -1) // can't find
                         return null;
                 start        += cookieName.length + 1;
                 var end = cookieString.indexOf(";", start);
                 if (end == -1) return unescape(cookieString.substring(start));
                 return unescape(cookieString.substring(start, end));
				 */
         }
		 
/*
function button_onclick() {
	this.  //change to a certain color, then change back
}
*/

function chat(chatId) {   //chat to a certain person
	openChatboard("two",chatId);
}

//function follow();

//function befriend();

//here, if the type is a chating group then we enter it directly. 
//If it's a face to face talk, make sure that we have a system to 
//use a certain strategy to open a certain group
function openChatboard(type,chatId) {    //haven't finished
	var passing = ""     //may have problem here
	if(type == "two") {
		passing = "other="+chatId;
	} else if(type == group) {
		passing = "groupId="+chatId;
	}
	window.open("chatboard.php?"+passing,"_blank","toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=400, height=400");
}

function bottom_hearNews(uid,curState) {  //at the begining, curState = 0, means the start
	var reponse = ajaxRequest("global/ajax_bottom_hearNews.php?uid="+uid+"curState="+curState);   //remember to write it
	if(reponse) {
		if(curState != 0 && reponse != curState) {
			//alert user for the new message. At this time, user can see the new message when he click the bottom
		}
		curState = response;
	} else {
		alert("Sorry, your computer can't connect to our sever, please check your web connection");
		return;
	}
	setTimeout(bottom_hearNews(uid,curState), 3000);      //three seconds per request
}



//function bottom_onNewInfo();

//This function is mostly used in IE when IE can not correctly put things in to tbody
function setTBodyInnerHTML(tbody, html) {         //plus equal
  var temp = tbody.ownerDocument.createElement('div');
  temp.innerHTML = '<table>' + html + '</table>';
  tbody.appendChild(temp.firstChild.firstChild);
}

//pre: input a operated node
//post: remove all its children nodes
function removeAllChildren(node) {         //equal ""
/*
	var length = node.childNodes.length;
	for(i = 0; i < length; i++) {
		node.removeChild(node.childNodes[0]);
	}
	*/
	while(node.hasChildNodes()) {
		node.removeChild(node.childNodes[0]);
	}
}

//pre: input a tbody
//post: set the value html into innerHTML of the tbody 
function tbodyEqualOperation(tbody, html) {
  var temp = tbody.ownerDocument.createElement('div');
  temp.innerHTML = '<table>' + html + '</table>';

  tbody.parentNode.replaceChild(temp.firstChild.firstChild, tbody);
}

//pre: input a variable
//post: alert the variable by self-defined way
function selfAlert(v) {
	alert(v);
}

//pre: input the name value and valid time of a cookie, here the unit of time is second
//post: set a cookie with respect to those inputs, the domain is the whole website
function setCookie(name, value, time) {  //haven't been tested
	var date=new Date(); 
	date.setTime(date.getTime()+time*1000);
	document.cookie = name+"="+value+"; expire="+date.toGMTString();
}

//pre: input the id of the category list button and the name of this category
//post: load and open the category, and finish all the preparation of showing and functioning the category list.
function cl_loadClassList(cateListId, cateName) {
	//to see if class list has already loaded
	alert("cl_loadClassList");
	if($("div").is("div[id=cl_wrapper]")) {
		$("div[id=cl_wrapper]").show();
		alert(1);
	} else {
		//var response = ajaxRequest("global/cate_list.htm");
		var response = $.ajax({url:"global/cate_list.htm",async:false});
		alert(response.responseText);
		$("body").prepend(response.responseText);
		//$("body").html(response);
		/*
		$.ajax({
			type: 'POST',
			url: "global/cate_list.htm",
			success: function(result) {$("body").prepend(response)},
			dataType: "html"
		});
		*/
		alert(2);
	}
	cl_openCateList();
	cl_initializeCateGlobal(cateListId, cateName);
	cl_getClassList(cl_cateName, cl_begin, cl_sortBy);
}

//pre: input the debug info
//post: alert the info if the debug is seted to be true
function dlert(info) {
	var debug = false;
	if(debug) {
		alert(info);
	}
}