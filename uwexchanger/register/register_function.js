//for making less files, put all registration related functions in the registration file.
//note: order of codes may matter
	function checkEmailValid() {
		var list = document.getElementById("r0");//<font color=GREEN ><font>
		var email = document.getElementById("email").value;
		if(email == "") {
			emailvalid = false;
			list.innerHTML = originalEmInfo;
			return;
		}
		//alert("inter check");
		list.innerHTML = "<font color=GRAY >processing...</font>";
		var response = ajaxRequest("register/ajax_checkEmailValid.php?email="+email);
		//alert("response in register: "+response);
		if(response == "ok") {   //remember to write the php file
			list.innerHTML = "<font color=GREEN >Great! this email hasn't been registered!</font>";
			emailvalid = true;
		} else if(response == "no") {
			//alert(list.innerHTML);   //
			list.innerHTML = "<font color=RED >Sorry, this email has already been registered. You can <a href='login.php'>login</a> here.</font>";
			emailvalid = false;
		} else {
			list.innerHTML = "<font color=RED >Warning, please check your web connection</font>";
			emailvalid = false;
		}
	}
	
	function checkNameValid() {
		var name = document.getElementById("uname").value;
		var list = document.getElementById("r1");
		if(name.length != 0) {
			if(name.length > 5 && name.length < 33) {
				list.innerHTML = "<font color=GREEN >Wonderful! The name is ok!</font>";
				namevalid = true;
			} else if(name.length <= 5) {
				list.innerHTML = "<font color=RED >Sorry! The name is too short, please try another one. Min length:6; Max length :32</font>";
				namevalid = false;
			} else {
				list.innerHTML = "<font color=RED >Sorry! The name is too long, please try another one. Min length:6; Max length :32</font>";
				namevalid = false;
			}
		} else {
			namevalid = false;
			list.innerHTML = originalNameInfo;
		}
	}
	
	function checkPasswordValid1() {
		var pw = document.getElementById("pw1").value;
		var list = document.getElementById("r2");
		if(pw == "") {
			list.innerHTML = originalPwInfo1;
			passwordValid1 = false;
			return;
		}

		if(pw.length > 5 && pw.length < 33) {
			list.innerHTML = "<font color=GREEN >Beautiful! The password is so fit!</font>";
			passwordValid1 = true;
		} else if(pw.length <= 5) {
			list.innerHTML = "<font color=RED >Sorry! The password is too short, please try another one. Min length:6; Max length :32</font>";
			passwordValid1 = false;
		} else {
			list.innerHTML = "<font color=RED >Sorry! The password is too long, please try another one. Min length:6; Max length :32</font>";
			passwordValid1 = false;
		}
	}
	
	function checkPasswordValid2() {     //may have problems
		var list = document.getElementById("r3");
		if(document.getElementById("pw1").value == "" || document.getElementById("pw2").value == "") {
			list.innerHTML = originalPwInfo2;
			passwordValid2 = false;
			return;
		}
		if(document.getElementById("pw1").value == document.getElementById("pw2").value) {
			list.innerHTML = "<font color=GREEN >Smart! two passwords are matched!</font>";
			passwordValid2 = true;
		} else {
			list.innerHTML = "<font color=RED >Sorry! two passwords are not matched, please try again.</font>";
			passwordValid2 = false;
		}
		
	}
	//the event activate this function should be "onblur" of input boxes
	
	function checkSituationValid() {
		var list = document.getElementById("r4");
		var length = document.getElementById("situationArea").value.length;
		if(length == 0) {
			situationValid = true;    //situationValid
			//alert("in situation: "+originalStuaInfo);
			list.innerHTML = originalStuaInfo;    //originalStuaInfo
			return;
		}
		//alert("in");
		if(length <= 240) {
			list.innerHTML = "<font color=GREEN >Perfect! totally "+length+" characters!</font>";
			situationValid = true;
		} else {
			list.innerHTML = "<font color=RED >Sorry! you have already written "+length+" characters. The length should be less than 240 characters</font>";
			situationValid = false;
		}
	}
	
	function setInterestedCourses() {
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
		document.getElementById("needAll").value = needAll;
		document.getElementById("dontAll").value = dontAll;
		
		
		/*
		var needAll = "";
		var dontAll = "";
		for(i = 0; i < 5; i++) {
			for(j = 0; j < 3; j++) {
				var tempn = document.getElementById("n"+(i*3+j)).value;
				if(tempn == "") {
					break;
				}
				needAll += tempn + ";";
			}
			needAll += "#";
			for (k = 0; k < 3; k++) {
				var tempd = document.getElementById("d"+(i*3+k)).value;
				if(tempd == "") {
					break;
				}
				dontAll += tempd + ";";
			}
			dontAll += "#";
		}
		needAll = needAll.toUpperCase();
		dontAll = dontAll.toUpperCase();
		document.getElementById("needAll").value = needAll;
		document.getElementById("dontAll").value = dontAll;
		*/
		
		//below is the old verson
		/*
		var total = new Array();
		for(i = 1; i < 6; i++) {
			var onlyOne = false;
			var x = document.getElementsByName("N"+i);
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
		send = send.replace(/:/,"");    //may have problems here
		document.getElementById("hiddenCourses").value = send;
		var showCourses = total.join(",<br>")+"<br>";
		showCourses = showCourses.replace(/;/," ");      //document.write(str.replace(/;/,"W"))
		showCourses = showCourses.replace(/:/,"all courses of ");
		showCourses = "<font color=BLUE >Are<br>"+showCourses+"your registered/interested courses? If not, please check the courses box on the left.</font>";
		var list = document.getElementsByName("response");
		list[5].innerHTML = showCourses;
		*/
	}
	
	function formSubmit() {
		/*
		var result = parseInt(document.getElementById("question").value);
		var generalValid = (namevalid && situationValid && emailvalid && passwordValid1 && passwordValid2);
		if(generalValid && (rand1+rand2 == result)) {
			setInterestedCourses();
			document.getElementById("myForm").submit();
		} else {
			alert("There are still some invalid information remain. Please check again");
			if(rand1+rand2 != result) {
				var list = document.getElementsByName("response");
				list[6].innerHTML = "<font color=GREEN >Sorry, your calculation is wrong, please try again.</font>";
			}
			rand1 = Math.random();    //top js
			rand2 = Math.random();
	//var humanvalid = false;   check if the client is a normal human when submitting
			rand2 = parseInt(rand2*10+1);     //two random numbers 1~10
			rand1 = parseInt(rand1*10+1);
			document.getElementById("showQuestion").innerHTML = rand1+"+"+rand2+"=";
			document.getElementById("question").value = "";
			document.getElementById("pw1").value = "";
			document.getElementById("pw2").value = "";
		}
		*/
		
		
		/*
		var result = parseInt(document.getElementById("question").value);
		var generalValid = (namevalid && situationValid && emailvalid && passwordValid1 && passwordValid2);// && calValid
		if(generalValid) {
			setInterestedCourses();
			document.getElementById("myForm").submit();
		} else {
			alert("There are still some invalid information remain. Please check again");
			if(rand1+rand2 != result) {
				var list = document.getElementsByName("response");
				list[5].innerHTML = "<font color=GREEN >Sorry, your calculation is wrong, please try again.</font>";
			}
			rand1 = Math.random();    //top js
			rand2 = Math.random();
	//var humanvalid = false;   check if the client is a normal human when submitting
			rand2 = parseInt(rand2*10+1);     //two random numbers 1~10
			rand1 = parseInt(rand1*10+1);
			document.getElementById("showQuestion").innerHTML = rand1+"+"+rand2+"=";
			document.getElementById("question").value = "";
			document.getElementById("pw1").value = "";
			document.getElementById("pw2").value = "";
			
			*/
			/*
			if(emailvalid) {
				alert("emailvalid: 1");
			} else {
				alert("emailvalid: 0");
			}
			if(namevalid) {
				alert("namevalid: 1");
			} else {
				alert("namevalid: 0");
			}
			if(passwordValid1) {
				alert("passwordValid1: 1");
			} else {
				alert("passwordValid1: 0");
			}
			if(passwordValid2) {
				alert("passwordValid2: 1");
			} else {
				alert("passwordValid2: 0");
			}
			if(calValid) {
				alert("calValid: 1");
			} else {
				alert("calValid: 0");
			}
			if(situationValid) {
				alert("situationValid: 1");
			} else {
				alert("situationValid: 0");
			}
			*/
			
			
			
			
			var valid = (emailvalid && namevalid && passwordValid1 && passwordValid2 && calValid && situationValid);
			if(valid) {
				setInterestedCourses();
				document.getElementById("myForm").submit();
			} else {
				alert("There are still some invalid information remain. Please check again");
				setQuestion();
				document.getElementById("pw1").value = "";
				document.getElementById("pw2").value = "";
				passwordValid1 = false;
				passwordValid2 = false;
				document.getElementById("r2").innerHTML = originalPwInfo1;
				document.getElementById("r3").innerHTML = originalPwInfo2;
			}
		}
		
		function checkCalValid() {
			var result = parseInt(document.getElementById("question").value);
			var list = document.getElementById("r5");
			if(rand1+rand2 == result) {
				calValid = true;
				list.innerHTML = "<font color=GREEN >Clever! Your calculation is right!</font>";
			} else {
				calValid = false;
				/*
				rand1 = Math.random();    //top js
				rand2 = Math.random();
				rand2 = parseInt(rand2*10+1);
				rand1 = parseInt(rand1*10+1);
				document.getElementById("showQuestion").innerHTML = rand1+"+"+rand2+"=";
				*/
				setQuestion();
				list.innerHTML = "<font color=RED >Sorry! Your calculation is wrong, please try again.</font>";
			}
		}
	
	
	function preparation() {
		setQuestion();
		originalPwInfo1 = document.getElementById("r2").innerHTML;
		originalPwInfo2 = document.getElementById("r3").innerHTML;
		originalEmInfo = document.getElementById("r0").innerHTML;
		originalNameInfo = document.getElementById("r1").innerHTML;
		originalStuaInfo = document.getElementById("r4").innerHTML;
		/*
		alert(originalPwInfo1);
		alert(originalPwInfo2);
		alert(originalEmInfo);
		alert(originalNameInfo);
		alert(originalStuaInfo);
		*/
	}
	
	function setQuestion() {
		rand1 = Math.random();    //top js
		rand2 = Math.random();
		rand1 = parseInt(rand1*10+1);
		rand2 = parseInt(rand2*10+1);
		document.getElementById("showQuestion").innerHTML = rand1+"+"+rand2+"=";
		document.getElementById("question").value = "";
	}