var username = document.getElementById("inputUsername");
var inPassword = document.getElementById("inputPassword");
var confirmPass = document.getElementById("inputConfirmPass");
var name = document.getElementById("inputName");
var email = document.getElementById("inputEmail");
var idNo = document.getElementById("inputIDNo");
var mobileNo = document.getElementById("inputMobile");


function validation(){
	
	if(validUser()){
		if(validPassword()){
			if(validConfirmPass()){
				if(validName()){
					if(validEmail()){
						if(validIDNo()){
							if(validMobileNo()){
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
        username.style.borderColor="red";
		return false;
	}else if(inPassword.value.length < 8){
		document.getElementById("errorPassword").innerHTML="Must have at least 8 characters";
        username.style.borderColor="red";
	}
	else{
		return true;
	}}
	//validate Confirm Password
	function validConfirmPass(){
	if(confirmPass.value == ""){
		document.getElementById("errorConfirmPass").innerHTML="Please enter a password";
        username.style.borderColor="red";
		return false;
	}else if(confirmPass.value != inPassword.value){
		document.getElementById("errorConfirmPass").innerHTML="Password not match";
        username.style.borderColor="red";
	}
	else{
		return true;
	}}
	//validate full name
	function validName(){
	if(name.value == ""){
		document.getElementById("errorName").innerHTML="Please enter a username";
        username.style.borderColor="red";
		return false;
	}else{
		return true;
	}}
	//validate email address
	function validEmail(){
	if(email.value == ""){
		document.getElementById("errorEmail").innerHTML="Please enter a username";
        username.style.borderColor="red";
		return false;
	}else{
		return true;
	}}
	//validate ID No
	function validIDNo(){
	if(idNo.value == ""){
		document.getElementById("errorIDNo").innerHTML="Please enter a username";
        username.style.borderColor="red";
		return false;
	}else{
		return true;
	}}
	//validate mobile number
	function validMobileNo(){
	if(mobileNo.value == ""){
		document.getElementById("errorMobile").innerHTML="Please enter a username";
        username.style.borderColor="red";
		return false;
	}else{
		return true;
	}}
}

username.onkeyup = function(){
	if(username.value.length >= 5){
		username.style.borderColor="white";
		document.getElementById("errorUsername").innerHTML="";
		
	}
}

