var need = <?php echo $need; ?>     //  use #to split different indexs (such as Abbreviation, sections, and number) and use ";" to split different requests
var exchange = <?php echo $need; ?>  //use the same stategy as need to process this information
need = need.split("#");
for(n in need) {
	need[n] = need[n].split(";");
}
exchange = exchange.split("#");
for(n in exchange) {
	exchange[n] = exchange[n].split(";");
}    //this part should be a global part of all exchange pages
var autos = "";   //autos finally should be an array
var thiscount = 0;    //to decide if a polling should be stop
var listContent = "";     //autos and listContent should firstly get from the sever, but not empty like this