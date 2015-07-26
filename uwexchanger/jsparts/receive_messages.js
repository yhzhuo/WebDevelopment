            function go(groupId,auto){    //groupId need to be changed
                var url = "http://localhost/uwnet/phpparts/give_messages.php?groupId="+groupId+"&self="++"&auto="+auto;  //need to use array to split self cookie
                var request;
				if(navigator.appName != "Microsoft Internet Explorer") {       //not IE
					request =  new XMLHttpRequest();
				} else {
					request =  new ActiveXObject(“Microsoft.XMLHTTP”);
				}
                request.open("GET", url, true);
                request.setRequestHeader("Content-Type","application/x-javascript;");
                request.onreadystatechange = function() {
                    if (request.readyState == 4) {
                        if (request.status == 200){
                            if (request.responseText) {
								var eleAry = request.responseText.split("`");    //split may has problems
								var size = eleAry.length();
								for (var i = 0; i < size-1; i++) {
									if(i%2 == 0) {   //content
										document.getElementById("board").innerHTML = document.getElementById("board").innerHTML+"<p>"+eleAry[i];  //(change related elements, "board" is the place where shows the messages)
										//step above may has problems
									} else {
										auto = eleAry[i];   //may has problems here
									}
								}
                            }
                        }
						setTimeout(3000);
                        go(groupId,auto);
                    }
                }
                request.send(null);
            }