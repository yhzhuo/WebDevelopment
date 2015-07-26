function load() {
	//$('div.infoBoxPublic input, div.infoBoxPublic textarea, div.infoBoxPrivate input, div.infoBoxPrivate textarea').attr("disabled", true);
	var elements = $('div.infoBoxPublic input, div.infoBoxPublic textarea, div.infoBoxPrivate input, div.infoBoxPrivate textarea');
	elements.attr("disabled", true);
	var shadowMove = 7;
	var shadowSize = 9;
	elements.css("background-color", "#fffdff");
	elements.animate({
	/*
		-webkit-box-shadow: shadowMove+"px "+shadowMove+"px "+shadowSize+"px rgba(0,0,0,.28)",
		-moz-box-shadow: shadowMove+"7px "+shadowMove+"px "+shadowSize+"px rgba(0,0,0,.28)",
		*/
		/*boxShadow : shadowMove+"px "+shadowMove+"px "+shadowSize+"px rgba(0,0,0,.28)"*/
		/*boxShadow : "-30px 0 30px #699, 30px 0 30px #969, 0 -30px 30px #996, 0 30px 30px #669"*/
		boxShadow : "0 0 0 #699, 0 0 0 #996, 0 -0 0 #669, 5px 5px 7px #808080"
	});
	$("div.imNotHost").hide();
	
	///////below probably need to be preserved
	//<get pictureContainer's width>
	/*
	var picturesWidth = $("div#pictures").attr("width");
	var buttonWidth = $("div#pictures button").attr("width");
	var pictureContainerWidth = picturesWidth - buttonWidth*2;
	$("div#pictureContainer").attr("width", ""+pictureContainerWidth);
	*/
	//</get pictureContainer's width>
	
}