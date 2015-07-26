//pre: input whole address, include URL passed values
//post: if function get response normally, return the response, else return false
//ajaxRequest(url)
/*
function checkEmailVaild() {        //onblur="checkEmailVaild()" on email
	var email = document.getElementById("email").value;
	var response = ajaxRequest("login/checkVaild.php?email="+email);
	if(!response) {
		document.getElementById("showEmailResponse").innerHTML = "<font color=RED>Cannot connect to the websever</font>";
	} else if(response != "ok") {         //remember to return ok here!!!!!
		document.getElementById("showEmailResponse").innerHTML = "<font color=RED>"+response+"</font>";
	} else {
		emailVaild = true;
	}
}
*/

function login() {
	var email = document.getElementById("email");
	var password = document.getElementById("pw");
	if(email.value.length == 0) {
		alert("Sorry, please fill in your email.");
	} else if(password.value.length == 0) {
		alert("Sorry, please fill in your password.");
	} else {
		document.getElementById("mainForm").submit();
		/*
			var email = document.getElementById("email").value;
			var password = document.getElementById("pw").value;
			var response = ajaxRequest("login/checkVaild.php?email="+email+"&password="+password);
			if(!response) {
				alert("cannot connect to sever.");
			} else if(response != ok) {
				alert(response);     //response the problem
			} else {   //right then jump
				window.location.href = '$domainName/register.php';
			}
			*/
	}
}

function ok() {
	//processing chatboard start
	var boardList = document.getElememtsByName("box");
	var aliveBoardIds = new Array();    //it should be the final send one
	for(i in boardList) {
		if(boardList[i].checked) {   //may have problems here
			aliveBoardIds.push(boardIdList[i]);
		}
	}
	//processing chatboard finish
	
	//processing courses start
	var needCourses = processCourses("N");
	var dontCourses = processCourses("D");
	aliveBoardIds = aliveBoardIds.join(";")+";";
	//send these three
	if(ajaxRequest("login/insertPorperty.php?needCourses="+needCourses+"&dontCourses="+dontCourses+"&aliveBoardIds="+aliveBoardIds+"uid="+uid)) {
		window.location.href = 'index.php';  //haven't write insertPorperty.php
	} else {
		alert("Sorry, our sever haven't receive your information, please try again.")
	}
}
   //type should be N or D
function processCourses(type) {     //it's a private function, may have problem
		var total = new Array();
		for(i = 1; i < 6; i++) {
			var onlyOne = false;
			var x = document.getElementsByName(type+i);
			var processThisLine = true;
			if(x[0].value == "") {
				processThisLine = false;
			//break;
			} else if(x[1].value == "") {
				//alert("please enter valid course Curriculum Abbreviation");    //standard style: aaa;bbb;ccc;#ddd;eee;fff;#
				//return;
				x.pop();
				x.pop();
				onlyOne = true;
			} else if(x[2].value == "") {
				x.pop();
			}
			var temp = "";
			if(processThisLine) {
				for(i in x) {
					temp += x[i].value+";";
				}
				if(onlyOne) {
					temp = ":"+temp;
				}
				total.push(temp);
			}
		}
		//var send = document.getElementById("hiddenCourses").value
		var send = total.join("#")+"#";
		send = send.replace(/:/,"");
		return send;
}

function goToRegister() {
	window.location.href = 'register.php';
}