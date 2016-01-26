function checkMailStatus(sendMail){
if(sendMail.value != null)
{
	if(sendMail.value == true){
		document.getElementById("sendMailDetails").style.display = "";
		document.getElementById("emailid").style.display = "";
		document.getElementById("emailsubject").style.display = "";
	} else {
		document.getElementById("sendMailDetails").style.display  = "none";
		document.getElementById("emailid").style.display          = "none";
		document.getElementById("emailsubject").style.display     = "none";
		
	}
	}
}
Joomla.submitbutton = function(pressbutton){
	var submitForm = document.adminForm;
	
	if(pressbutton=="help"){
		submitForm.task.value=pressbutton;
		submitForm.submit();
	}	
	if(pressbutton=="cancel"){
		submitForm.task.value=pressbutton;
		submitForm.submit();
		return false;
	}	
	if(submitForm.sendemail != undefined)
	{
	if(submitForm.sendemail.value == 1){
		if(!checkEMail(submitForm.emailid.value)){
			alert("Please enter proper Email ID");
			submitForm.emailid.focus();
			return false;
		}
		if(submitForm.emailsubject.value==""){
			alert("Please enter Email Subject");
			submitForm.emailsubject.focus();
			return false;
		}
	}
	}
     
	if(pressbutton=="save"){
		
		submitForm.task.value='saveMail';
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