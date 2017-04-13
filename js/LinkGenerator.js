
function saveToLocal(){
	var post_title = document.getElementById("post_title");
	var post_content = document.getElementById("post_content");

	if(storageAvailable('localStorage')){

		localStorage.setItem('title', post_title.value);
		localStorage.setItem('content', post_content.value);
		
	}
	else
		alert("localStorage not available for your browser");

	return null;

}

function getFromLocal(){
	var title =  localStorage.getItem('title');
	var content = localStorage.getItem('content');

	if(title!==null)
		document.getElementById("post_title").value+=title;
	
	if(content!==null)
		document.getElementById("post_content").value+=content;		
	
}

function storageAvailable(type) {
	try {
		var storage = window[type],
			x = '__storage_test__';
		storage.setItem(x, x);
		storage.removeItem(x);
		return true;
	}
	catch(e) {
		return false;
	}
}

function GenerateLink(){

	var linktext = document.getElementById('link_name');
	var link = document.getElementById('link');
	var a = "<a href='"+ link.value + "' class='link_s'>"+ linktext.value +"</a>";
	
	return a;
/*
	For overcoming the shortcoming of this funtion, please set the 'link_name' and 'link' input fields to 
	'required' in the html.
*/	
}

/*
	Set diffrent funtions according to the area you want to append the link <a></a>
*/
function setLink(){

	var link = GenerateLink();
	var textarea = document.getElementById('post_content');
	textarea.value+=link;
}
