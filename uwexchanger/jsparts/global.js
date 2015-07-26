<SCRIPT TYPE="text/javascript">
	var str=document.cookie;
	var arr=str.split("; ");
	var username;
	var uid;
	for(var i = 0; i<arr.length; i++) {
		var arrs=arr[i].split("=");
		if(arr[0] == "username") {
			username = arr[1];
		} else if(arr[0] == "uid") {
			uid = arr[1];
		}
	}
</SCRIPT>