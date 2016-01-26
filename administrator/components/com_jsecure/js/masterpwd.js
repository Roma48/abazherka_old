function hideMasterPassword(optionsValue){
if(optionsValue.value != undefined)
{
	if(optionsValue.value == "1"){
		document.getElementById("master_password").style.display = "";
		document.getElementById("verify_master_password").style.display = "";
		document.getElementById("include_basic_confg").style.display = "";
		document.getElementById("include_adminpwdpro").style.display = "";
		document.getElementById("include_mail").style.display = "";
		document.getElementById("include_ip").style.display = "";
		document.getElementById("include_mastermail").style.display = "";
		document.getElementById("include_log").style.display = "";
		document.getElementById("include_showlogs").style.display = "";
		document.getElementById("include_directorylisting").style.display = "";
		document.getElementById("include_adminid").style.display = "";
		document.getElementById("include_logincontrol").style.display = "";
		document.getElementById("include_metatags").style.display = "";
		document.getElementById("include_purgesessions").style.display = "";
		document.getElementById("quick_select").style.display = "";
		document.getElementById("legend").style.display = "";
		

	} else {
		document.getElementById("master_password").style.display = "none";
		document.getElementById("verify_master_password").style.display = "none";
		document.getElementById("include_basic_confg").style.display = "none";
		document.getElementById("include_adminpwdpro").style.display = "none";
		document.getElementById("include_mail").style.display = "none";
		document.getElementById("include_ip").style.display = "none";
		document.getElementById("include_mastermail").style.display = "none";
		document.getElementById("include_log").style.display = "none";
		document.getElementById("include_showlogs").style.display = "none";
		document.getElementById("include_directorylisting").style.display = "none";
		document.getElementById("include_adminid").style.display = "none";
		document.getElementById("include_logincontrol").style.display = "none";
		document.getElementById("include_metatags").style.display = "none";
		document.getElementById("include_purgesessions").style.display = "none";
		document.getElementById("quick_select").style.display = "none";
		document.getElementById("legend").style.display = "none";
	}
}
}
Joomla.submitbutton = function(pressbutton){
	var submitForm = document.adminForm;
	
	
	if(pressbutton=="help"){
		submitForm.task.value=pressbutton;
		submitForm.submit();
	}	
	
	if(submitForm.master_password.value !=undefined)
	{
	if(submitForm.master_password.value != "" && submitForm.ret_master_password.value == ""){
		alert("Please enter Verify Master Password");
		submitForm.ret_master_password.focus();
		return false;
	}
	if((submitForm.master_password.value != "") && (submitForm.ret_master_password.value != submitForm.master_password.value)){
		alert("Please enter Verify Master Password Same as of Master Password");
		submitForm.ret_master_password.focus();
		return false;
	}
	if(submitForm.master_password.value == "" && submitForm.ret_master_password.value != ""){
		alert("Please enter Master Password first");
		submitForm.ret_master_password.value="";
		submitForm.master_password.focus();
		return false;
	}
	}
	if(!alphanumeric(submitForm.master_password.value)){
		submitForm.master_password.value="";
		alert("Master password should not have special characters. Please enter Alpha-Numeric Key");
		submitForm.master_password.focus();
		return false;
	}
	
	if(pressbutton=="save"){
		submitForm.task.value='saveMasterpwd';
		submitForm.submit();
	}	


	submitForm.task.value=pressbutton;
	submitForm.submit();
}

function checkEMail(email){
	var reg = /^[A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4}(?:[,;][A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4})*$/i;
	if(reg.test(email) == false) {
		return false;
	} else {
		return true;
	}
}


//*/
function isNumeric(val)
{
	val.value=val.value.replace(/[^0-9*]/g, '');
	if (val.value.indexOf('*') != '-1')
		val.value = '*';
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