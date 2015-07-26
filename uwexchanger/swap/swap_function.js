//pre: besure to include global_function.js and swap_global.js. Input if process need
/*
post: standardize related content then send to sever. If the sever receive it correctly, 
change relate content else if the sever did't receive it correctly or there are something 
wrong with user's input alert the error 
*/
/*
function swap_add(isNeed) {
	var start = "";
	var areaIndex = "";
	var requestType = "";
	var dropBoxName = "";
	var itemName = "";
	if(isNeed) {
		start = "N";
		areaIndex = "needCoursesList";
		requestType = "need";
		dropBoxName = "ND";
		itemName = "need";
	} else {
		start = "D";
		areaIndex = "dontCoursesList";
		requestType = "dont";
		dropBoxName = "DD";
		itemName = "dont"
	}
	var total = new Array();
	for(i = 1; i < 6; i++) {
		var x = document.getElementsByName(start+i);
		var processThisLine = true;
		if(x[0].value == "") {
			processThisLine = false;
			//break;
		} else if(x[1].value == "") {
			//alert("please enter valid course Curriculum Abbreviation");    //standard style: aaa;bbb;ccc;#ddd;eee;fff;#
			//return;
			x.pop();
			x.pop();
		} else if(x[2].value == "") {
			x.pop();
		}
		var temp = "";
		if(processThisLine) {
			for(i in x) {
				temp += x[i].value+";";
			}
		}
		total.push(temp);
	}
	var finalSend = total.join("#")+"#";
	
	tempList = document.getElementById(areaIndex).innerHTML;
	document.getElementById(areaIndex).innerHTML = "processing...";
	for(i = 1; i < 6; i++) {
		var x = document.getElementsByName(start+i);
		for(l in x) {                                        //concurrent modifacation error may occur here
			x[l].value = "";
		}
	}                                                        //the operation below send the added part to the database
	var response = ajaxRequest("swap/add_swap_request.php?requestType="+requestType+"&content="+finalSend+"&uid="+uid);   //originally "phpparts/get_swap_request.php"
	if(response) {
		var receiveArr = response.split("#");
		receiveArr.pop();
		var dropBox = "<input type=checkbox name="+dropBoxName+" value=ON>"      //finish it after eating
		for(k in receiveArr) {
			var temp = receiveArr[k];
			temp = temp.split(";");
			temp.pop();                       
			temp = temp.join("&nbsp;");                                     //concurrent modifacation error may occur here
			receiveArr[k] = dropBox+"<p><a href=chatmain.php?search="+receiveArr[k]+" name="+itemName+" value="+receiveArr[k]+">"+temp+"</a>";  //value=receiveArr[k]  then process it directly?
		}
		document.getElementById(areaIndex).innerHTML = receiveArr.join("<br>");
	} else {
		alert("failed to get response");
		document.getElementById(areaIndex).innerHTML = tempList;
	}
	
}
*/


//pre: input the indexs(array) of courses requests to drop and which request to drop(boolean)
/*
function swap_drop(isNeed) {
	var contentList;
	var deleteList;
	var requestType = "";
	var areaIndex = "";
	var dropBoxName = "";
	var itemName = "";
	if(isNeed) {
		contentList = document.getElementsByName("need");
		deleteList = document.getElementsByName("ND");
		requestType = "need";
		areaIndex = "needCoursesList";
		dropBoxName = "ND";
		itemName = "need";
	} else {
		contentList = document.getElementsByName("dont");
		deleteList = document.getElementsByName("DD");
		requestType = "dont";
		areaIndex = "dontCoursesList";
		dropBoxName = "DD";
		itemName = "dont"
	}
	if(deleteList.length == 0) {
		alert("no courses to delete from the courses' list!");
		return;
	}
	var aliveArr = new Array();
	for(i in deleteList) {
		if(!deleteList[i].checked) {
			aliveArr.push(contentList[i].value);    //may has problem here
		}
	}
	if(aliveArr.length == contentList.length) {
		alert("no courses to delete from the courses' list!");
		return;
	}
	var finalSend = aliveArr.join("#")+"#";
	tempList = document.getElementById(areaIndex).innerHTML;
	document.getElementById(areaIndex).innerHTML = "processing...";
	var response = ajaxRequest("swap/drop_swap_request.php?requestType="+requestType+"&content="+finalSend+"&uid="+uid);   //originally "phpparts/get_swap_request.php"
	
	if(response) {      //response should be "ok" or "failed". So the receiveArr is only depend on aliveArr, which is not get from php response
		receiveArr = aliveArr;
		var dropBox = "<input type=checkbox name="+dropBoxName+" value=ON>"      //finish it after eating
		for(k in receiveArr) {
			var temp = receiveArr[k];
			temp = temp.split(";");
			temp.pop();                       
			temp = temp.join("&nbsp;");                                     //concurrent modifacation error may occur here
			receiveArr[k] = dropBox+"<p><a href=chatmain.php?search="+receiveArr[k]+" name="+itemName+" value="+receiveArr[k]+">"+temp+"</a>";  //value=receiveArr[k]  then process it directly?
		}
		document.getElementById(areaIndex).innerHTML = receiveArr.join("<br>");
	} else {
		alert("failed to get response");
		document.getElementById(areaIndex).innerHTML = tempList;
	}
}
*/

//post: send new situation to database and change it. Alert if this process is unsuccessful.
function changeSituation() {
	//alert("call");
	//var curSi = document.getElementById("situation"),innerHTML;
	var tempSituation = document.getElementById("situation").value;
	var curOriginal = "";
	//alert(tempSituation);
	if(tempSituation.length > 240) {
		alert("You have already type "+tempSituation.length+" characters, please describe your situation and contact methods less than 200 characters.");
		return;
	} else if(tempSituation == originalSituation) {
		alert("You haven't changed your situation and contact methods.");
		return;
	} else {
		curOriginal = originalSituation;
		originalSituation = tempSituation;
	}
	var response = ajaxRequest("swap/swap_request_situation.php?content="+tempSituation+"&uid="+uid);
	if(!response) {
		alert("error! your situation hasn't been changed!");
		originalSituation = curOriginal;
		document.getElementById("situation").value = curOriginal;
	} else {
		alert("Situation and contact methods are changed!");
	}
}


/*
//this is the version that uses page number.
function addCertainPage(localPage) { 
	if(localPage < 1) {
		localPage = 1;
	}
	var response = ajaxRequest("swap/swap_list_request.php?uid="+uid+"&page="+localPage);
	if(!response) {
		alert("error! webpage can't receive valid response from sever");
		return;
	}
	var content = "";
	if(response == "No more") {
		content = "No more!!!";
		document.getElementById("newInfo").innerHTML = content;
		document.getElementById("newInfo").className = "btn btn-large btn-block disabled"     //may have problems here
	} else {
		content = response;
		content = content.split("*");
		content.pop();
		var whole = "";
		for(i in content) {
			var oneLine = content[i].split("|");     //This array represent one line of content
			oneLine.pop();
			var out = '<tr>';
			out += '<td>'+oneLine.pop()+'</td>';         //name
			oneLine[2] = oneLine[2].replace(/;/g,"&nbsp;");
			out += '<td>'+oneLine[2].replace(/#/g,"<br />")+'</td>';                        //courses s/he needs
			oneLine[3] = oneLine[3].replace(/;/g,"&nbsp;");
			out += '<td>'+oneLine[3].replace(/#/g,"<br />")+'</td>';                        //courses s/he dosen't need
			out += '<td>'+oneLine[4]+'</td>';                        //his/her situation(and contact method)
			out += '<td>'+oneLine[7].substr(5)+'</td>';
			out += '</tr>';
			whole += out;
		}
		document.getElementById("mainContent").innerHTML += whole;
		if(content.length < 20) {
			document.getElementById("newInfo").innerHTML = "No more!!!";
			document.getElementById("newInfo").className = "btn btn-large btn-block disabled"     //may have problems here
		} else {
			document.getElementById("newInfo").innerHTML = "See More";
			document.getElementById("newInfo").className = "btn btn-large btn-block btn-success"     //may have problems here
			var windowHeight=window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
			scrollBy(0,windowHeight);
		}
	}
}
*/


/*
	pre: swap_main has valid var numPrimary, var numSecondary. 
	server uses new swap_list_request.php that don't use page,
	but use numPrimary and numSecondary
*/
//post: add at most 20 results, that consider both double match and single match in to the result table.
//This version don't use page
function addCertainPage(localPage) {  // so the parameter here is dummy
	//the output from swap_list_request.php uses the last place to store which result table does it from. 1, double match; 2, single match .
	dlert("numPrimary: "+numPrimary);
	dlert("numSecondary: "+numSecondary);
	var response = ajaxRequest("swap/swap_list_request.php?uid="+uid+"&numPrimary="+numPrimary+"&numSecondary="+numSecondary);   //requires new swap_list_request.php
	if(!response) {
		//alert("error! webpage can't receive valid response from sever");
		return;
	}
	dlert("response: "+response);
	
	$("#mainContent").hide();
	var content = "";
	if(response == "No more") {
		content = "No more!!!";
		document.getElementById("newInfo").innerHTML = content;
		document.getElementById("newInfo").className = "btn btn-large btn-block disabled"     //may have problems here
		document.getElementById("newInfo").onclick = function() {""};    //Function("window.open('targetPage.asp?id=1')");
	} else {
		content = response;
		content = content.split("*");
		content.pop();
		var whole = "";
		for(i in content) {
			var oneLine = content[i].split("|");     //This array represent one line of content
			oneLine.pop();
			//set judgement which table it from
			if(oneLine.pop() == 1) {
				numPrimary++;
			} else {
				numSecondary++;
			}
			//
			var out = '<tr>';
			out += '<td>'+oneLine.pop()+'</td>';         //name
			oneLine[2] = oneLine[2].replace(/;/g,"&nbsp;");
			out += '<td>'+oneLine[2].replace(/#/g,"<br />")+'</td>';                        //courses s/he needs
			oneLine[3] = oneLine[3].replace(/;/g,"&nbsp;");
			out += '<td>'+oneLine[3].replace(/#/g,"<br />")+'</td>';                        //courses s/he dosen't need
			out += '<td>'+oneLine[4]+'</td>';                        //his/her situation(and contact method)
			out += '<td>'+oneLine[7].substr(5)+'</td>';
			out += '</tr>';
			whole += out;
		}
		
		if(!isIE()) {
			document.getElementById("mainContent").innerHTML += whole;
		} else { //
			var contentTbody = document.getElementById("mainContent");
			setTBodyInnerHTML(contentTbody, whole);
		}
		
		if(content.length < 20) {
			document.getElementById("newInfo").innerHTML = "No more!!!";
			document.getElementById("newInfo").className = "btn btn-large btn-block disabled"     //may have problems here
			document.getElementById("newInfo").onclick = function() {""};
		} else {
			document.getElementById("newInfo").innerHTML = "See More";
			document.getElementById("newInfo").className = "btn btn-large btn-block btn-success"     //may have problems here
			document.getElementById("newInfo").onclick = function() {addNewPage();};  //
			var windowHeight=window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
			scrollBy(0,windowHeight);
		}
		$("#mainContent").show(1000);
	}
	//
	
	
	
}


/*
//This version use page.
function addCertainPage(localPage) { 
	if(localPage < 1) {
		localPage = 1;
	}
	var response = ajaxRequest("swap/swap_list_request.php?uid="+uid+"&page="+localPage);
	if(!response) {
		alert("error! webpage can't receive valid response from sever");
		return;
	}
	var content = "";
	if(response == "No more") {
		content = "No more!!!";
		document.getElementById("newInfo").innerHTML = content;
		document.getElementById("newInfo").className = "btn btn-large btn-block disabled"     //may have problems here
	} else {
		content = response;
		content = content.split("*");
		content.pop();
		var whole = "";
		for(i in content) {
			var oneLine = content[i].split("|");     //This array represent one line of content
			oneLine.pop();
			var out = '<tr>';
			out += '<td>'+oneLine.pop()+'</td>';         //name
			oneLine[2] = oneLine[2].replace(/;/g,"&nbsp;");
			out += '<td>'+oneLine[2].replace(/#/g,"<br />")+'</td>';                        //courses s/he needs
			oneLine[3] = oneLine[3].replace(/;/g,"&nbsp;");
			out += '<td>'+oneLine[3].replace(/#/g,"<br />")+'</td>';                        //courses s/he dosen't need
			out += '<td>'+oneLine[4]+'</td>';                        //his/her situation(and contact method)
			out += '<td>'+oneLine[7].substr(5)+'</td>';
			out += '</tr>';
			whole += out;
		}
		document.getElementById("mainContent").innerHTML += whole;
		if(content.length < 20) {
			document.getElementById("newInfo").innerHTML = "No more!!!";
			document.getElementById("newInfo").className = "btn btn-large btn-block disabled"     //may have problems here
		} else {
			document.getElementById("newInfo").innerHTML = "See More";
			document.getElementById("newInfo").className = "btn btn-large btn-block btn-success"     //may have problems here
			var windowHeight=window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
			scrollBy(0,windowHeight);
		}
	}
}
*/




/*
//pre: input page number, which is a integer that bigger than 0
//post: if the input is less than 1, the top variable Page will be set to 1. Others' courses request information list will be refreshed. link "next" will be unclickable if there are no requests
//also, top variable page should always equals to local variable localPage
function refreshList(localPage) {                      
	if(localPage < 1 || !localpage) {
		page = 1;
		localPage = 1;
	}
	//var need = document.getElementsByName("need").join("#")+"#";
	//var dont = document.getElementsByName("dont").join("#")+"#";
	var dontList = document.getElementsByName("dont");
	var needList = document.getElementsByName("need");
	var need = "";
	var dont = "";
	for(i in needList) {
		need += needList[i].innerHTML+"#";
	}
	for(j in dontList) {
		dont += dontList[j].innerHTML+"#";
	}
	var response = ajaxRequest("swap/swap_list_request.php?need="+need+"&dont="+dont+"&uid="+uid+"&page="+localPage);
	if(response != "No more") {     //the response will be present as it's normal webpage sequence. the information that will not present in webpage will listed at last
												//such as "aaa;bbb;ddd;eee;#" write the correspond php page first then write this part
		var totalList = response.split("*");  //"*" used to combine different lines
		totalList.pop();
		var content = document.getElementById("mainList").innerHTML;
		var curContent = "";
		for(i in totalList) {
			var oneLine = totalList[i].split("|")     //"|" used to combine different columns in one line
			oneLine.pop();
			//fill in the content
			
			curContent += "<tr class='mainContent'>";//<td class='mainContent'>"++"</td></tr>";
			curContent += "<td class='mainContent'>"+oneLine[9]+"</td>";    //name
			//then do like what you have done. Finish all of them
			
			var temp = oneLine[2].split("#");
			temp.pop();
			for(j in temp) {
				var cur = temp[j];
				temp[j] = "<a href=chatmain.php?search="+cur+">"+temp[j].replace(/;/," ") + "&nbsp;"+"</a>";
			}
			temp = temp.join("<br>");
			
			curContent += "<td class='mainContent'>"+temp+"</td>";   //courses s/he needs
			
			var temp = oneLine[3].split("#");    //may have problems here
			temp.pop();
			for(j in temp) {
				var cur = temp[j];
				temp[j] = "<a href=chatmain.php?search="+cur+">"+temp[j].replace(/;/," ") + "&nbsp;"+"</a>";
			}
			var newtemp = temp.join("<br>");
			
			curContent += "<td class='mainContent'>"+newtemp+"</td>";    //courses s/he dosen't need
			curContent += "<td class='mainContent'>"+oneLine[4]+"</td>";    //his/her situation
			curContent += "<td class='mainContent' onclick=chat("+oneLine[1]+") >chat with him/her</td>";    //chat with him/her, may have problems
			var chatBoardInfo = temp.pop();
			curContent += "<td class='mainContent'><a href=chatmain.php?search="+chatBoardInfo.replace(/ /,";")+">"+chatBoardInfo+"</a></td>";    //   interesting chat boards
			curContent += "<td class='mainContent'><a href='javascript: follow("+oneLine[1]+")' >follow</a><br><a href='javascript: befriend("+oneLine[1]+")' >add friend</a></td>";
			curContent += "</tr>";
		}
		content = curContent;
	} else if(response == "No more") {
		content = "<center>No more!!!</center>";
	} else {
		alert("error! webpage can't receive valid response from sever");
	}
}
*/


//post: change the state of courses in database and user's page
function courseChange() {      //This should be regard as a final manipulation function
	
	if(!notEmptyRequest()) {
		alert("You haven't change your courses.");
		return;
	}
	


	var needCourses = dropRequest("needCheck")+setInterestedCourses("n");
	var exchangeCourses = dropRequest("exchangeCheck")+setInterestedCourses("d");
	var uid = getCookie("uid");
	//alert("need: "+needCourses+"exchange: "+exchangeCourses+"uid: "+uid);
	var total = needCourses+"|"+exchangeCourses+"|"+uid;
	total = total.replace(/#/g,"*");    //replace(/;/," ")
	var send = "swap/ajax_change_request.php?total="+total;
	//alert("send: "+send);
	var response = ajaxRequest(send);
	if(response) {
		//alert(response);
		fillInCourses(needCourses+"|"+exchangeCourses);
		refresh();
		/*
		response = response.split("|");
		//process need
		need = response[0];
		for(i in need) {
			need[i] = '<div class="aRequest"><input type="checkbox" id="needCheck'+i+'" value="ON" />'+need[i].replace(/;/," ")+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
		}
		need = need.join("");   //may have problems here
		document.getElementById("needCoursesList").innerHTML = need;
		
		
		//process exchange
		exchange = response[1];
		for(j in exchange) {
			exchange[j] = '<div class="aRequest"><input type="checkbox" id="exchangeCheck'+j+'" value="ON" />'+exchange[j].replace(/;/," ")+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
		}
		exchange = exchange.join("");   //may have problems here
		document.getElementById("dontCoursesList").innerHTML = exchange;
		*/
	} else {
		alert("failed to get response");
	}
}


/*
function fillInCourses(courseText) {
	var response = courseText;
	response = response.split("|");
	//process need
	need = response[0];
	for(i in need) {
		need[i] = '<div class="aRequest"><input type="checkbox" id="needCheck'+i+'" value="ON" /><div id="needCheckRelate'+i+'">'+need[i].replace(/;/," ")+'</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
	}
	need = need.join("");   //may have problems here
	document.getElementById("needCoursesList").innerHTML = need;	
	//process exchange
	exchange = response[1];
	for(j in exchange) {
		exchange[j] = '<div class="aRequest"><input type="checkbox" id="exchangeCheck'+j+'" value="ON" /><div id="exchangeCheckRelate'+j+'">'+exchange[j].replace(/;/,"&nbsp;")+'</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
	}
	exchange = exchange.join("");   //may have problems here
	document.getElementById("dontCoursesList").innerHTML = exchange;
}
*/

//pre: Input the origional courseContent from php file
//post: Fill in all courses 
function fillInCourses(courseContent) {
	//alert("inter fillInCourses: "+courseContent);
	courseContent = courseContent.split("|");
	//first is need, second is exchange
	var need = courseContent[0];
	var exchange = courseContent[1];
	//alert("need: "+need+"exchange: "+exchange);
	need = need.split("#");
	need.pop();
	exchange = exchange.split("#");
	exchange.pop();
	curNeedCourses = new Array();
	curExchangeCourses = new Array();
	//process need
	if(need != "") {
		for(i in need) {
			//alert("fillInCourses, needCheck index"+i);
			curNeedCourses.push(need[i]);
			var cur = need[i];
			need[i] = '<div';
			if(!isIE()) {
				need[i] += ' class="aRequest" ';
			}
			need[i] += '><div style="float: left; width: 50px;"><div style="margin-left: auto; margin-right: auto; width: 5px;"><input type="checkbox" id="needCheck'+i+'" value="ON" /></div></div><lable id="needCheckRelate'+i+'" for="needCheck'+i+'" style="float: left; margin-left: 30px;">'+cur.replace(/;/g,"&nbsp;")+'</lable></div>';
		}
		/*
		//for IE start
		if(isIE()) {
			var temp = '<div class="aRequest" style="visibility:hidden;"><input type="checkbox" id="needCheck'+i+'" value="ON" /><lable id="needCheckRelate'+i+'">'+need[i].replace(/;/g,"&nbsp;")+'</lable></div>';
			need.push(temp);
		}
		//for IE end
		*/
		need = need.join("");   //may have problems here
	} else {
		need = '<p><br />No Courses!!!</p>';
	}
	document.getElementById("needCoursesList").innerHTML = need;	
	//process exchange
	if(exchange != "") {
		for(j in exchange) {
			curExchangeCourses.push(exchange[j]);
			var cur = exchange[j];
			exchange[j] = '<div';
			if(!isIE()) {
				exchange[j] += ' class="aRequest" ';
			}
			exchange[j] += '><div style="float: left; width: 50px;"><div style="margin-left: auto; margin-right: auto; width: 5px;"><input type="checkbox" id="exchangeCheck'+j+'" value="ON" /></div></div><lable id="exchangeCheckRelate'+j+'" for="exchangeCheck'+j+'" style="float: left; margin-left: 30px;">'+cur.replace(/;/g,"&nbsp;")+'</lable></div>';
		}
		/*
		//for IE start
		if(isIE()) {
			var temp = '<div class="aRequest" style="visibility:hidden;"><input type="checkbox" id="exchangeCheck'+j+'" value="ON" /><lable id="exchangeCheckRelate'+i+'">'+exchange[j].replace(/;/g,"&nbsp;")+'</lable></div>';
			exchange.push(temp);
		}
		//for IE end
		*/
		exchange = exchange.join("");   //may have problems here
	} else {
		exchange = '<p><br />No Courses!!!</p>';
	}
	document.getElementById("dontCoursesList").innerHTML = exchange;
	for(var i = 0; i < 15; i++) {
		document.getElementById("n"+i).value = "";
		document.getElementById("d"+i).value = "";
	}
}

//pre: enter the step name, needCheck or exchangeCheck
//post: retrun the remain courses
function dropRequest(step) {
	//alert("inter the dropRequest");
	var aliveList = new Array();
	var i = 0;
	//var step = "needCheck";
	for(;;) {
		var id = step+i;
		//alert(id);
		var checkBox = document.getElementById(id);
		if(!checkBox) {                //may have problems here
			break;
		} else {
			//alert("i = "+i);
			if(!checkBox.checked) {
				var cur = "";
					if(step == "needCheck") {
						cur = curNeedCourses[i];
					} else {
						cur = curExchangeCourses[i];
					}
				aliveList.push(cur);
			//alert(aliveList.toString());   //*
			}
		}
		i++;
	}
	/*
	//for IE start
	if(isIE()) {
		aliveList.pop();
	}
	//for IE end
	*/
	if(aliveList.length == 0) {
		return "";
	}
	//alert(aliveList.join("#")+"#");        //*
	return aliveList.join("#")+"#";
}


function getCourses(step) {
	var aliveList = new Array();
	var i = 0;
	//var step = "needCheck";
	for(;;) {
		var id = step+i;
		var checkBox = document.getElementById(id);
		if(!checkBox) {                //may have problems here
			break;
		} else {
				//alert("i = "+i);
				var cur = document.getElementById(step+"Relate"+i).innerHTML;
				//alert("before replace cur="+cur);
				cur = cur.replace(/&nbsp;/g,";");       //may have problem here
				//alert("after replace cur="+cur);
				aliveList.push(cur);
				//alert(aliveList.toString());   //*
		}
		i++;
	}
	if(aliveList.length == 0) {
		return "";
	}
	//alert(aliveList.join("#")+"#");        //*
	return aliveList.join("#")+"#";
}

//post: return true if it is not empty, false otherwise
function notEmptyRequest() {   //may have problems
	for(var i=0; i<15; i++) {
		if(document.getElementById("n"+i).value != "" || document.getElementById("d"+i).value != "") {
			return true;
		}
	}
	step = "needCheck";
	var i = 0;
	for(;;) {
		var id = step+i;
		var checkBox = document.getElementById(id);
		if(!checkBox) {                //may have problems here
			break;
		} else {
			if(checkBox.checked) {
				return true;
			}
		}
		i++
	}
	step = "exchangeCheck";
	i = 0;
	for(;;) {
		var id = step+i;
		var checkBox = document.getElementById(id);
		if(!checkBox) {                //may have problems here
			break;
		} else {
			if(checkBox.checked) {
				return true;
			}
		}
		i++;
	}
	return false;
}

//pre:input nOrd "n" or "d" refer to certain IDs
	function setInterestedCourses(nOrd) {
		var needAll = "";
		for(i = 0; i < 5; i++) {
			var tempDo = false;
			for(j = 0; j < 3; j++) {
				var tempn = document.getElementById(nOrd+(i*3+j)).value;
				if(tempn == "") {
					break;
				}
				tempDo = true;
				needAll += tempn + ";";
			}
			if(tempDo) {
				needAll += "#";
			}
		}
		return needAll.toUpperCase();
		/*  //origional one
		var needAll = "";
		var dontAll = "";
		for(i = 0; i < 5; i++) {
			var tempDo = false;
			for(j = 0; j < 3; j++) {
				var tempn = document.getElementById("n"+(i*3+j)).value;
				if(tempn == "") {
					break;
				}
				tempDo = true;
				needAll += tempn + ";";
			}
			if(tempDo) {
				needAll += "#";
			}
		}
		
		for(i = 0; i < 5; i++) {
			var tempDo = false;
			for (k = 0; k < 3; k++) {
				var tempd = document.getElementById("d"+(i*3+k)).value;
				if(tempd == "") {
					break;
				}
				tempDo = true;
				dontAll += tempd + ";";
			}
			if(tempDo) {
				dontAll += "#";
			}
		}
		
		needAll = needAll.toUpperCase();
		dontAll = dontAll.toUpperCase();
		return needAll + "|" + dontAll;
		*/
	}
	
	function preparation() {
		topAlert(0);
		loadOrigionalPage();
	}
	
	//post: When the loading is finished, grab all the important information from database 
	//and display them on the web page
	function loadOrigionalPage() {
		//get the courseContent from php file
		var response = ajaxRequest("swap/ajax_loadOrigionalPage.php?uid="+uid);
		if(response) {
			//alert("before split: "+response);
			response = response.split(":");
			//alert("after split: "+response);
			document.getElementById("situation").value = response[1];
			originalSituation = response[1];
			fillInCourses(response[0]);
			addCertainPage(1);
		} else {
			alert("failed to get response.");
		}
	}
	
	function addNewPage() {
		//alert("inter addNewPage");   //
		page++;
		addCertainPage(page);
	}
	
	function refresh() {
		//alert("inter refresh");
		page = 1;
		numPrimary = 0;
		numSecondary = 0;
		fitInBrowser();
		removeAllChildren(document.getElementById("mainContent"));
		/*
		if(!isIE()) {
			document.getElementById("mainContent").innerHTML = "";
		} else {
			removeAllChildren(document.getElementById("mainContent"));
			//
			var textnode = document.createTextNode("");
			alert("ok1");
			var mainContent = document.getElementById("mainContent");
			alert("ok2");
			mainContent.replaceChild(textnode, mainContent.childNodes[0]);  //may have problems here
			alert("ok3");
			mainContent.replaceChild(textnode, mainContent.childNodes[2]);  //may have problems here
			alert("ok4");
			//var old = mainContent.childNodes[0];
			//
			
		}
		*/
		addCertainPage(page);
	}
	
	function fitInBrowser() {
		if(isIE()) {
		/*
			document.getElementById('showCourses').style.cssFloat="right";
			document.getElementById('controlPad').style.cssFloat="left";
			*/
			document.getElementById("controlPad").style.cssFloat="left";
			document.getElementById("showCourses").style.cssFloat="right";
			//document.getElementById('showCourses').style = "float: right;";
		}
		//document.getElementById('test').style.margin
	}
	
	function topAlert(flag) {
		if(flag == 0) {
			$("div#alert_1").show(3000);
		} else if(flag == 1) {
			$("div#alert_1").hide(3000);
			$("div#alert_2").show(3000);
		} else if(flag == 2) {
			$("div#alert_2").hide(3000);
		}
	}