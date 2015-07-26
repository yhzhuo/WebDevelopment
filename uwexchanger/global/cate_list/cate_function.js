alert("cate_function is in");
//pre: input the category of the class and where to begin in the data searching result
//post: get the information and insert them in to the end of the class list
//@ global String cl_sortBy
function cl_getClassList(cate, begin, sortBy) {
	var response = ajaxRequest("global/cate_list/get_class_list.php?cl_cateName="+cate+"cl_begin="+begin+"cl_sortBy="+sortBy);
	if(response == "empty") {
		$("#classes").prepend("<b>No any!</b>");   //may have problems here
	} else {
		cl_insertClassList(response);
	}
}

//private void
//pre: input the ajax response of class list information
//post: make the information into presentation tier and insert it in to the end of the original class list
function cl_insertClassList(response) {
	var classes = document.getElementById("classes");
	var content = response.split("|");
	content.pop();
	cl_begin += content.length;
	for(i in content) {
		cl_classList.push(content[i]);
		var cur = content[i].split(";");
		//<div class="aClass" style="float: left; width: 100px; height: 10px;"><a href="javascript: cl_chooseThisClass(classId)">class name</a></div>
		var aClass = '<div class="aClass" style="float: left; width: 100px; height: 10px;"><a href="javascript: cl_chooseThisClass('+cur[0]+')">'+cur[1]+'</a></div>';
		//list.insertBefore(newItem,list.childNodes[0]);
		classes.insertBefore(aClass, classes.childNodes[classes.length - 1]); //may have problems here, consider to use jQuery
	}
}

//@global var cl_cateListId
function cl_chooseThisClass(classId) {   //the cl_cateListId here is the id of html element
	var cur = classId.split("_");
	var id = parseInt(cur[1]);
	var response = ajaxRequest("global/cate_list/change_today_count.php?id="+id);
	if(response != "finish") {
		selfAlert("Some error occured!");
		return;
	}
	var target = document.getElementById(cl_cateListId);    //createTextNode()   replaceChild()
	var choosenClass = document.createTextNode(document.getElementById(classId).childNodes[0]);    //may have problem here
	target.replaceChild(choosenClass, target.childNodes[0])    //choosenClass.childNodes[0]
	cl_closeCateList();  //haven't finish
}



function cl_closeCateList() {
	if(isIE()) {
		$("*").show();  //$("div[id!=cl_wrapper]").show();
	}     //may have problems here
	$("div[id=cl_wrapper]").hide();
}

function cl_openCateList() {
	//make it obvirous
	if(isIE()) {
		//$("div[id!=cl_wrapper]").hide();
		//$("[class!=cl_wrapper]").hide();
		//$("div[class=cl_wrapper]").find("*").show();           //may have problems here
		$("*").hide();
		$("div#cl_wrapper").show();
		$("div#cl_wrapper").contents().show();
		$("div.cl_containter ul.nav>li").css({    //$("div.cl_containter ul.nav").children("li").css({
			"display":"inline",
			"position":"relative",
			"top":"50%"
		});
		
		/*
		$("p").css({"color":"white","background-color":"#98bf21",
  "font-family":"Arial",
  "font-size":"20px",
  "padding":"5px"
  });
		*/
	} else {
		$("div.cl_containter div.navbar").css({
			"float": "left",
			"width": "658px"
		});
	}
}

function cl_initializeCateGlobal(cateListId, cateName) {
	cl_cateListId = cateListId;
	cl_classList = new Array();
	cl_cateName = cateName;
	cl_sortBy = "default";
	cl_begin = 0;
}

function cl_sortBy(type) {
	cl_sortBy = type;
	cl_begin = 0;
	cl_classList = new Array();
	$("div[id=cl_classes]").children("div[class=aClass]").remove();
	cl_getClassList(cl_cateName, cl_begin, cl_sortBy);
}

//function 

//pre: all the information of the cl_classList has already stored in a global variable var cl_classList
//and we have a cookie to store the length of class the user has created today
//@global var cl_cateListId
function cl_addNewClass() { //@ global var cl_classList, global var cl_cateName, global var cl_newClassName
	var cl_newClassName = document.getElementById("cl_addNewClass").value;
	if(cl_newClassName.length <= 1) {
		selfAlert("The length of the category name should be longer than 1 character");
		return;
	}
	if(getCookie("cl_hasSetLength")+cl_newClassName.length > 1000 || getCookie("cl_createTimes") > 5) {
		selfAlert("You have exceeded the times or length that you have to create category today.");
		return;
	}
	/*
	if() {
		
	}
	*/
	/*
	for(int i = 0; i < cl_classList.length; i++) {
		var cur = cl_classList[i].split(";");
		if(cur[1] == cl_newClassName) {
			selfAlert("This class has already being created!");
			cl_chooseThisClass("class_"+cur[0]);
			return;
		}
	}
	*/
	var response = ajaxRequest("global/cate_list/add_new_class.php?cl_cateName="+cl_cateName+"&cl_newClassName="+cl_newClassName);
	//response = $id.";".$cl_newClassName;
	response = response.split(";");
	if(response.length == 3) {
		selfAlert("This category has already being created!");
	} else {
		selfAlert("This category is created successfully!");
		setCookie("cl_hasSetLength", getCookie("cl_hasSetLength")+cl_newClassName.length, 86400);    //function setCookie(name, value, time); hasn't been finished
		setCookie("cl_createTimes", getCookie("cl_createTimes")+1, 86400);
	}
	cl_chooseThisClass("class_"+id[0]);
}

function cl_addNewPage() {
	cl_getClassList(cl_cateName, cl_begin, cl_sortBy);
}


/*
function cl_addNewClass() { //@ global var cl_classList, global var cl_cateName, global var cl_newClassName
	var cl_newClassName = document.getElementById("addNewClass").value;
	for(int i = 0; i < cl_classList.length; i++) {
		var cur = cl_classList[i].split(";");
		if(cur[1] == cl_newClassName) {
			selfAlert("This class has already being created!");
			chooseThisClass("class_"+cur[0]);
			return;
		} else if(getCookie("hasSetClassLength") > 1000 || getCookie("setCookieTimes") > 5) {
			selfAlert("You have exceeded the times or length that you have to create class today.");
		} else {
			var response = ajaxRequest("global/cate_list/add_new_class.php?cl_cateName="+cl_cateName+"&cl_newClassName="+cl_newClassName);
			//response = $id.";".$cl_newClassName;
			if(response == "failed") {
				selfAlert("Some error occured!");
				return;
			}
			var id = response.split(";");
			cl_insertClassList(response);
			chooseThisClass("class_"+id[0]);
		}
	}
}
*/