try{
	var t = document.getElementById("chapterTitle").innerHTML;
	localStorage.setItem(bookName, JSON.stringify({t:t,u:window.location.href}));
}catch(e){
	
}

var elm = document.getElementById("readProgNext");
var h = elm.getAttribute("href");
if(!h){
	elm.setAttribute("href", "javascript:;");
}