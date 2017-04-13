
function GenerateLink(){

	var textarea = document.getElementById('post_content');
	var linktext = document.getElementById('link_name');
	var link = document.getElementById('link');
	var a = "<a href="+ link.value + " class='link_s'>"+ linktext.value +"</a>";
	
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
	var textarea = document.getElementById('content');
	textarea.value+=link;
}