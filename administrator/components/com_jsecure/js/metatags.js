Joomla.submitbutton = function(pressbutton){
	var submitForm = document.adminForm;
	
	if(pressbutton=="help"){
		submitForm.task.value=pressbutton;
		submitForm.submit();
	}	
	if(pressbutton=="save"){
		
		submitForm.task.value='saveMetatags';
		submitForm.submit();
	}	


	submitForm.task.value=pressbutton;
	submitForm.submit();
}
function hideAdminMetaTags(tagval)
{  
    if(tagval.value == "1"){
    	document.getElementById("tag_generator").style.display = "";
	    document.getElementById("tag_keywords").style.display = "";
		document.getElementById("tag_description").style.display = "";
		document.getElementById("tag_rights").style.display = "";
	} else {
	    document.getElementById("tag_generator").style.display = "none";
	    document.getElementById("tag_keywords").style.display = "none";
		document.getElementById("tag_description").style.display = "none";
		document.getElementById("tag_rights").style.display = "none";
	}
}
function checkEMail(email){
	var reg = /^[A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4}(?:[,;][A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4})*$/i;
	if(reg.test(email) == false) {
		return false;
	} else {
		return true;
	}
}
function isNumeric(val)
{
	val.value=val.value.replace(/[^0-9*]/g, '');
	if (val.value.indexOf('*') != '-1')
		val.value = '*';
}