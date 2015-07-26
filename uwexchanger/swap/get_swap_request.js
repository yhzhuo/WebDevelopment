//assume the swap_global.js has already worked and global_function.js is required
            function getSwapRequests(autos,count){    //groupId need to be changed
				if(count != thiscount) {
					return;         //be careful about this
				}
				//get page number start
				var GETvalues = urlValues();
				var GETpage;
				if(GETvalues) {
					for(n in GETvalues) {
						if(GETvalues[n].indexOf("page") >= 0) {
							GETpage = GETvalues[n].split("=");
							GETpage = GETpage[1];
						}
					}
				} else {
					document.write("need page number!!!");
					return;
				}
				//get page number finish
				var reneed = new Array();
				var reexchange = new Array();
				var reautos;
				if(autos != "") {
					reautos = autos.join(";");
				} else {
					reautos = "";
				}
				for(n in need) {
					reneed.push(need[n].join(";"));
				}
				reneed = reneed.join("#");
				for(n in exchange) {
					reexchange.push(exchange[n].join(";"));
				}
				reexchange = reexchange.join("#");
				

				
                var url = "http://localhost/uwnet/phpparts/get_swap_requests.php?need="+reneed+"&exchange="+reexchange+"&page="+GETpage+"&autos="+reautos;  //need to use array to split self cookie
                var request =  new XMLHttpRequest();
                request.open("GET", url, true);
                request.setRequestHeader("Content-Type","application/x-javascript;");
                request.onreadystatechange = function() {
                    if (request.readyState == 4) {
                        if (request.status == 200){
                            if (request.responseText) {
								//How to process the response text depend on php code
								var temp = request.responseText.split("#");
								autos = new Array();
								for(n in temp) {
									temp[n].split(";");
									autos.push(temp[n][0]);
								}
								//process listContent start
								var listlen = listContent.length;
								var templen = temp.length;
								/*
								for(i = 0; i < listlen; i++) {
									for(n in autos) {
										if(listContent[i][0] == autos[n]) {
											listContent.splice(i,1);
											i--;
										}
									}
									
								}
								*/
								for(i = 0; i < templen; i++) {
									if(temp[i].length == 1) {
										temp.splice(i,1);
										i--;
									}
								}
								for(n = 0; n < listlen; n++) {
									var isSame = false;
									for(j in autos) {
										if(autos[j] == listContent[n][0]) {
											isSame == true;
											break;
										}
									}
									if(!isSame) {
										if(temp.length != 0) {
											listContent[n] = temp.pop();
										} else {
											listContent.splice(n,1);
											n--;
										}
										changeList(n+"Line", listContent[n]);      //n+"Line" refers to the id where should be changed, and listContent[n] describes change to what
									}      //remember to write the DOM function "changeList(id, Content)"
								}
								/*
								for(n in listContent) {
									for(j = 0; j < temp.length; j++) {
										if(listContent[n][0] == temp[j][0]) {
											temp.splice(j,1);
											break;
										}
									}
								}
								*/
									//all redundency have been eliminated
								
								//process listContent end
								
                            }
                        }
						setTimeout(10000);
                        getSwapRequests(autos,count);
                    }
                }
                request.send(null);
            }