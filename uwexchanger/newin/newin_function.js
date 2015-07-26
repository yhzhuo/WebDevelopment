//for making less files, put all registration related functions in the registration file.
//note: order of codes may matter
	dlert("newin_function.js is in");
	
	function preparation() {
		dlert("in preparation");
		setQuestion();
		changeProcess(stepId);
		originalPwInfo1 = document.getElementById("r2").innerHTML;
		originalPwInfo2 = document.getElementById("r3").innerHTML;
		originalEmInfo = document.getElementById("r0").innerHTML;
		originalNameInfo = document.getElementById("r1").innerHTML;
		originalStuaInfo = document.getElementById("r4").innerHTML;
	}
	
	
	

	
	function setQuestion() {
		dlert("in setQuestion");
		rand1 = Math.random();
		rand2 = Math.random();
		rand1 = parseInt(rand1*10+1);
		rand2 = parseInt(rand2*10+1);
		dlert("here is ok");
		document.getElementById("showQuestion").innerHTML = rand1+"+"+rand2+"=";
		dlert("after set question");
		document.getElementById("question").value = "";
	}
	
	
	
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

	
	function nextStep() {
		setValues(stepId);
		stepId++;
		changeProcess(stepId);
	}
	
	
	
	
	//pre: input the stepId
	//change the form base on the step
	//@private, only used by backStep() and nextStep()
	function changeProcess(step) {
		if(step == 1) {
			$("[value='<< Back']").hide();
			$("[value='Submit']").attr("value","Next >>");
		} else {
			$("[value='<< Back']").show(1000);
			if(step == 2) {
				$("[value='Submit']").attr("value","Next >>");
			} else if(step == 3) {
				$("[value='Next >>']").attr("value","Submit");    //div#different_steps 
			} else if(step == 4) {
				stepId = 1;
				formSubmit();
				return;
			}
		}
		getSwapInfo();
		//change step icon begin
		for(i = 1; i <= 3; i++) {
			if(i < step) {
				$( "span.step"+i ).css({color : '#009900'});
			} else if(i == step) {
				$( "span.step"+i ).css({color : '#FF0000'});
			} else {
				$( "span.step"+i ).css({color : '#B8B8B8'});
			}
		}
		//$(".stepHeader").text("Step "+step);
		//change step icon begin end
		
		
		
		dlert("in");
		$("[id^='step']").hide();      //"[name^='hello']"
		dlert("after all hide");
		var showID = "#step"+step;
		dlert("make showID");
		$(showID).show(1000);
		dlert("show the module");
		stepId = step;
	}
	
	
	
	
	function backStep() {
		stepId--;
		changeProcess(stepId);
	}
	
	

	function setValues(stepId) {
		if(stepId == 1) {
			setInterestedCourses("n");
		} else if(stepId == 2) {
			setInterestedCourses("d");
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
	
	
	//pre: input n (needAll) or d (dontAll)
	//post: set user inputs into correspond user's input
	function setInterestedCourses(nOrd) {
		var result = "";
		//var dontAll = "";
		for(i = 0; i < 5; i++) {
			var tempDo = false;
			for(j = 0; j < 3; j++) {
				var tempn = document.getElementById(nOrd+(i*3+j)).value;
				if(tempn == "") {
					break;
				}
				tempDo = true;
				result += tempn + ";";
			}
			if(tempDo) {
				result += "#";
			}
		}
		result = result.toUpperCase();
		if(nOrd == "n") {
			document.getElementById("needAll").value = result;
		} else if(nOrd == "d") {
			document.getElementById("dontAll").value = result;
		} else {
			alert("Your input is wrong");
		}
	}

	function getSwapInfo() {
		if(stepId == 1 || stepId == 4) {
			return;
		} else if(stepId > 4 || stepId < 1) {
			alert("The stepId is wrong");
			return;
		}
		var need = document.getElementById("needAll").value;
		var dont = document.getElementById("dontAll").value;
		var response = ajaxRequest("newin/get_match.php?need="+need+"&dont="+dont);
		if(response != "No more") {
			//change the result
			var whole = "";
			dlert("response: "+response);
			var content = response.split("*");
			content.pop();
			for(i in content) {
				var oneLine = content[i].split("|");
				oneLine.pop();
				var out = "<tr>";
				var notShow = "See it after finishing the 3 steps!!!";
				out += "<td>***</td>";   //name
				oneLine[0] = oneLine[0].replace(/#/g,"<br />");
				out += "<td>"+oneLine[0].replace(/;/g,"&nbsp;")+"</td>";   //courses need
				oneLine[1] = oneLine[1].replace(/#/g,"<br />");
				out += "<td>"+oneLine[1].replace(/;/g,"&nbsp;")+"</td>";   //courses don't need
				out += "<td>"+notShow+"</td>";
				out += "<td>***</td>";
				out += "<tr>"
				dlert("in the result generating loop, out: "+out);
				whole += out;
			}
			/*
			var contentTbody = document.getElementById("mainContent");
			setTBodyInnerHTML(contentTbody, whole);
			*/
			dlert("the result: "+whole);
			var table = document.getElementById("mainContent");
			removeAllChildren(table);
			if(!isIE()) {
				table.innerHTML += whole;
			} else { //
				setTBodyInnerHTML(table, whole);
			}
			$("div#result").show(1000);
		} else {
			$("div#result").hide();
		}
	}
	
	
	function formSubmit() {
		var valid = (emailvalid && namevalid && passwordValid1 && passwordValid2 && calValid && situationValid);
		if(valid) {
			setInterestedCourses("n");
			setInterestedCourses("d");
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
			setQuestion();
			list.innerHTML = "<font color=RED >Sorry! Your calculation is wrong, please try again.</font>";
		}
	}



	

	
