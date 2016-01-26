function hideAdminPassword(optionsValue){
if(optionsValue.value != undefined)
{
	if(optionsValue.value == "1"){
	    document.getElementById("admin_username").style.display = "";
		document.getElementById("admin_password").style.display = "";
		document.getElementById("verify_admin_password").style.display = "";
	} else {
	    document.getElementById("admin_username").style.display = "none";
		document.getElementById("admin_password").style.display = "none";
		document.getElementById("verify_admin_password").style.display = "none";
	}
	}
}
Joomla.submitbutton = function(pressbutton){
	var submitForm = document.adminForm;
	
	if(pressbutton=="cancel"){
		submitForm.task.value=pressbutton;
		submitForm.submit();
	}	
	
	if(pressbutton=="help"){
		submitForm.task.value=pressbutton;
		submitForm.submit();
	}	
	
	
	
	 if(submitForm.adminpasswordpro != undefined)
	{
	
  if(submitForm.adminpasswordpro.value == 1 && submitForm.passwordproconfig.value == 0 && pressbutton !="cancel")
  {
      if(submitForm.admin_username.value==""){
			alert("Please Enter Administrator Username");
			submitForm.admin_username.focus();
			return false;
		}
		if(submitForm.admin_password.value==""){
			alert("Please Enter Administrator Passowrd");
			submitForm.admin_password.focus();
			return false;
		}
		if(submitForm.re_admin_password.value==""){
			alert("Please Enter Varify Administrator Passowrd");
			submitForm.admin_password.focus();
			return false;
		}
	  if(submitForm.admin_password.value != submitForm.re_admin_password.value){
		alert("Please enter Verify Administrator Password Same as of Administrator Password");
		submitForm.re_admin_password.focus();
		return false;
	}
  
  }
  }
	if(pressbutton=="save"){
		submitForm.task.value='saveAdminpwdpro';
		submitForm.submit();
	}	


	submitForm.task.value=pressbutton;
	submitForm.submit();
}
//*/
function isNumeric(val)
{
	val.value=val.value.replace(/[^0-9*]/g, '');
	if (val.value.indexOf('*') != '-1')
		val.value = '*';
}