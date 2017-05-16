try{
	var d = localStorage.getItem(bookName);
	if(d){
		var obj = JSON.parse(d);
		
		$("#lastRead").text(obj.t);
		
	$("#lastReadLink").attr({href:obj.u}).css({display:"block"})
	}
}catch(e){
		
}

$("#reverse").on("click", function(){$("#volumes").html($.map($("#volumes li"), function(item){return $(item).prop('outerHTML')}).reverse())})

