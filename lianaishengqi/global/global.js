$(document).ready(function() {
	var linkBackGround = $("a.navbar_myhome").css("background-color"); // may have problem
	var homeAndContact = $("a.navbar_myhome, a.navbar_contact");
	var homeAndContact_overcolor = "#ffd5e5";
	homeAndContact.mouseover(function() {
		$(this).css("background-color", homeAndContact_overcolor);
	});
	homeAndContact.mouseout(function() {
		$(this).css("background-color", linkBackGround);
	});
	homeAndContact.mousedown(function() {
		$(this).css("background-color", "#CCF");
	});
	homeAndContact.mouseup(function() {
		$(this).css("background-color", homeAndContact_overcolor);
	});
	
	var findAndAbout = $("a.navbar_find, a.navbar_about");
	var findAndAbout_overcolor = "#66e9ff";
	findAndAbout.mouseover(function() {
		$(this).css("background-color", findAndAbout_overcolor);
	});
	findAndAbout.mouseout(function() {
		$(this).css("background-color", linkBackGround);
	});
	findAndAbout.mousedown(function() {
		$(this).css("background-color", "#6CF");
	});
	findAndAbout.mouseup(function() {
		$(this).css("background-color", findAndAbout_overcolor);
	});
	
});


//above are auto excuted code