function hideCustomPath(optionsValue){
if(optionsValue.value != undefined)
{
	if(optionsValue.value == "1"){
		document.getElementById("custom_path").style.display = "";
	} else {
		document.getElementById("custom_path").style.display = "none";
	}
	}
}
Joomla.submitbutton = function(pressbutton){
	var submitForm = document.adminForm;
	
	if(pressbutton=="help"){
		submitForm.task.value=pressbutton;
		submitForm.submit();
	}
	
	if(!alphanumeric(submitForm.key.value)){
		submitForm.key.value="";
		alert("Secret Key should not have special characters. Please enter Alpha-Numeric Key");
		submitForm.key.focus();
		return false;
	}
	if(pressbutton=="save"){
		submitForm.task.value='saveBasic';
		submitForm.submit();
		return true;
	}	
	
 
	submitForm.task.value=pressbutton;
	submitForm.submit();
}

function alphanumeric(keyValue){
	
	var numaric = keyValue;
	for(var j=0; j<numaric.length; j++){
		  var alphaa = numaric.charAt(j);
		  var hh = alphaa.charCodeAt(0);
		  if(!((hh > 47 && hh<58) || (hh > 64 && hh<91) || (hh > 96 && hh<123))){
		  	return false;
		  }
	}
	return true;
}
function isNumeric(val)
{
	val.value=val.value.replace(/[^0-9*]/g, '');
	if (val.value.indexOf('*') != '-1')
		val.value = '*';
}