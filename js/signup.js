var username = document.getElementById("inputUsername");
var inPassword = document.getElementById("inputPassword");
var confirmPass = document.getElementById("inputConfirmPass");
var fullName = document.getElementById("inputName");
var email = document.getElementById("inputEmail");
var idNo = document.getElementById("inputIDNo");
var mobileNo = document.getElementById("inputMobile");
var idType = document.getElementById("selectIDType");


function validation(){
	validUser();
	validPassword();
	validConfirmPass();
	validName();
	validEmail();
	validIDNo();
	validMobileNo();
	//validIDType();
	if(validUser()){
		if(validPassword()){
			if(validConfirmPass()){
				if(validName()){
					if(validEmail()){
						if(validIDNo()){
							if(validMobileNo()){
								//if(validIDType()){
								return true;
	}}}}}}}
	
	return false;
	
	
	
	//validate username
	function validUser(){
	if(username.value == ""){
		document.getElementById("errorUsername").innerHTML="Please enter a username";
        username.style.borderColor="red";
		return false;
	}
	else if(username.value.length < 5){
		document.getElementById("errorUsername").innerHTML="Must have at least 5 character";
        username.style.borderColor="red";
		return false;
	}
	else{
		return true;
	}}
	//validate password
	function validPassword(){
		
	if(inPassword.value == ""){
		document.getElementById("errorPassword").innerHTML="Please enter a password";
        inPassword.style.borderColor="red";
		return false;
	}else if(inPassword.value.length < 8){
		document.getElementById("errorPassword").innerHTML="Must have at least 8 characters";
        username.style.borderColor="red";
		return false;
	}
	else{
		return true;
	}}
	//validate Confirm Password
	function validConfirmPass(){
	if(confirmPass.value == ""){
		document.getElementById("errorConfirmPass").innerHTML="Please enter a password";
        confirmPass.style.borderColor="red";
		return false;
	}else if(confirmPass.value != inPassword.value){
		document.getElementById("errorConfirmPass").innerHTML="Password not match";
        username.style.borderColor="red";
		return false;
	}
	else{
		return true;
	}}
	//validate full name
	function validName(){
	if(fullName.value == ""){
		document.getElementById("errorName").innerHTML="Please enter your name";
        fullName.style.borderColor="red";
		return false;
	}else{
		return true;
	}}
	//validate email address
	function validEmail(){
	if(email.value == ""){
		document.getElementById("errorEmail").innerHTML="Please enter your email";
        email.style.borderColor="red";
		return false;
	}else{
		return true;
	}}
	//validate ID No
	function validIDNo(){
	if(idNo.value == ""){
		document.getElementById("errorIDNo").innerHTML="Please enter your ID number";
        idNo.style.borderColor="red";
		return false;
	}else{
		return true;
	}}
	//validate mobile number
	function validMobileNo(){
	if(mobileNo.value == ""){
		document.getElementById("errorMobileNo").innerHTML="Please enter your mobile number";
        mobileNo.style.borderColor="red";
		return false;
	}else if(mobileNo.value.length < 10 || mobileNo.value.length > 11){
		document.getElementById("errorMobileNo").innerHTML="Invalid mobile number format";
        mobileNo.style.borderColor="red";
		return false;
	}
	else{
		return true;
	}}
	//validate ID type
	/*function validIDtype(){
		if(id == "type"){
			document.getElementById("errorIDType").innerHTML="Invalid mobile number format";
			idType.style.borderColor="red";
			return false;
		}
		else{
			return true;
		}
	}*/
}

username.onkeyup = function(){
	if(username.value.length >= 5){
		username.style.borderColor="white";
		document.getElementById("errorUsername").innerHTML="";
		
	}
	else if(username.value == ""){
		document.getElementById("errorUsername").innerHTML="Please enter a username";
        username.style.borderColor="red";
	}
	else if(username.value.length < 5){
		document.getElementById("errorUsername").innerHTML="Must have at least 5 character";
        username.style.borderColor="red";
	}
}

inPassword.onkeyup = function(){
	if(inPassword.value.length >=8){
		document.getElementById("errorPassword").innerHTML="";
        inPassword.style.borderColor="white";
	}
	else if(inPassword.value == ""){
		document.getElementById("errorPassword").innerHTML="Please enter a password";
        inPassword.style.borderColor="red";
	}else if(inPassword.value.length < 8){
		document.getElementById("errorPassword").innerHTML="Must have at least 8 characters";
        inPassword.style.borderColor="red";
	}
}

confirmPass.onkeyup = function(){
	if(confirmPass.value == inPassword.value){
		document.getElementById("errorConfirmPass").innerHTML="";
        confirmPass.style.borderColor="white";
	}
	else if(confirmPass.value == ""){
		document.getElementById("errorConfirmPass").innerHTML="Please enter a password";
        confirmPass.style.borderColor="red";
	}else if(confirmPass.value != inPassword.value){
		document.getElementById("errorConfirmPass").innerHTML="Password not match";
        confirmPass.style.borderColor="red";
	}
}

fullName.onkeyup = function(){
	if(fullName.value != ""){
		document.getElementById("errorName").innerHTML="";
		fullName.style.borderColor="white";
	}
	else if(fullName.value == ""){
		document.getElementById("errorName").innerHTML="Please enter your name";
        fullName.style.borderColor="red";
	}
}

email.onkeyup = function(){
	if(email.value != ""){
		document.getElementById("errorEmail").innerHTML="";
        email.style.borderColor="white";
	}
	else if(email.value == ""){
		document.getElementById("errorEmail").innerHTML="Please enter your email";
        email.style.borderColor="red";
	}
}

idNo.onkeyup = function(){
	if(idNo.value != ""){
		document.getElementById("errorIDNo").innerHTML="";
        idNo.style.borderColor="white";	
	}
	else if(idNo.value == ""){
		document.getElementById("errorIDNo").innerHTML="Please enter your ID number";
        idNo.style.borderColor="red";
	}
}

mobileNo.onkeyup = function(){
	if(mobileNo.value.length == 10 || mobileNo.value.length == 11){
		document.getElementById("errorMobileNo").innerHTML="";
        mobileNo.style.borderColor="white";
	}
	else if(mobileNo.value == ""){
		document.getElementById("errorMobileNo").innerHTML="Please enter your mobile number";
        mobileNo.style.borderColor="red";
	}else if(mobileNo.value.length < 10 || mobileNo.value.length > 11){
		document.getElementById("errorMobileNo").innerHTML="Invalid mobile number format";
        mobileNo.style.borderColor="red";
	}
}


