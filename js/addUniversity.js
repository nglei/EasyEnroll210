var username = document.getElementById("inputUsername");
var inPassword = document.getElementById("inputPassword");
var fullName = document.getElementById("inputName");
var email = document.getElementById("inputEmail");
var university = document.getElementById("inputUniversity");


function validation(){
	validUser();
	validPassword();
	validName();
	validEmail();
  validUni();

	if(validUser()){
		if(validPassword()){
if(validUni()){
				if(validName()){
					if(validEmail()){
								return true;
	}}}}}

	return false;


  function validUni(){
    if(university.value == ""){
  		document.getElementById("errorUni").innerHTML="Please enter University Name";
          university.style.borderColor="red";
  		return false;
  	}
    else{
      return true;
    }
  }
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
	}else if(inPassword.value.length < 5){
		document.getElementById("errorPassword").innerHTML="Must have at least 8 characters";
        inPassword.style.borderColor="red";
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


}

username.onkeyup = function(){
	if(username.value.length >= 5){
		username.style.borderColor="grey";
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
	if(inPassword.value.length >=5){
		document.getElementById("errorPassword").innerHTML="";
        inPassword.style.borderColor="grey";
	}
	else if(inPassword.value == ""){
		document.getElementById("errorPassword").innerHTML="Please enter a password";
        inPassword.style.borderColor="red";
	}else if(inPassword.value.length < 5){
		document.getElementById("errorPassword").innerHTML="Must have at least 8 characters";
        inPassword.style.borderColor="red";
	}
}

fullName.onkeyup = function(){
	if(fullName.value != ""){
		document.getElementById("errorName").innerHTML="";
		fullName.style.borderColor="grey";
	}
	else if(fullName.value == ""){
		document.getElementById("errorName").innerHTML="Please enter your name";
        fullName.style.borderColor="red";
	}
}

email.onkeyup = function(){
	if(email.value != ""){
		document.getElementById("errorEmail").innerHTML="";
        email.style.borderColor="grey";
	}
	else if(email.value == ""){
		document.getElementById("errorEmail").innerHTML="Please enter your email";
        email.style.borderColor="red";
	}
}

university.onkeyup = function(){
  if(university.value != ""){
    document.getElementById("errorUni").innerHTML="";
    university.style.borderColor="grey";
  }
}
