try{
	var t = document.getElementById("chapterTitle").innerHTML;
	localStorage.setItem(bookName, JSON.stringify({t:t,u:window.location.href}));
}catch(e){
	
}