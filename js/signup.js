var username = document.getElementById("inputUsername");
var inPassword = document.getElementById("inputPassword");
var confirmPass = document.getElementById("inputConfirmPass");
var fullName = document.getElementById("inputName");
var email = document.getElementById("inputEmail");
var idNo = document.getElementById("inputIDNo");
var mobileNo = document.getElementById("inputMobile");
var idType = document.getElementById("selectIDType");
var date = document.getElementById("inputDateOfBirth");
var qualification = document.getElementById("selectQualification");
var score = document.getElementsByName("grade[]");
var subject = document.getElementsByName("subject[]");


function validation(){
	var selectValue = idType[idType.selectedIndex].value;
	var selectQual = qualification[qualification.selectedIndex].value;

	validUser();
	validPassword();
	validConfirmPass();
	validName();
	validEmail();
	validIDNo();
	validMobileNo();
	validIDtype();
	validDate();
	validQualification();


	if(validUser()){
		if(validPassword()){
			if(validConfirmPass()){
				if(validName()){
					if(validEmail()){
						if(validIDNo()){
							if(validMobileNo()){
								if(validIDtype()){
									if(validDate()){
										if(validQualification()){
										
								return true;
	}}}}}}}}}}
	
	return false;



	//validate username
	function validUser(){
	if(username.value == ""){
		document.getElementById("errorUsername").innerHTML="Please enter a username";
        username.style.borderColor="red";
		username.focus();
		return false;
	}
	else if(username.value.length < 5 || username.value.length > 15){
		document.getElementById("errorUsername").innerHTML="Username should be between 5-15 characters";
        username.style.borderColor="red";
		username.focus();
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
		inPassword.focus();
		return false;
	}else if(inPassword.value.length < 8){
		document.getElementById("errorPassword").innerHTML="Must have at least 8 characters";
        inPassword.style.borderColor="red";
		inPassword.focus();
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
		confirmPass.focus();
		return false;
	}else if(confirmPass.value != inPassword.value){
		document.getElementById("errorConfirmPass").innerHTML="Password not match";
        confirmPass.style.borderColor="red";
		confirmPass.focus();
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
		fullName.focus();
		return false;
	}else{
		return true;
	}}
	//validate email address
	function validEmail(){
	if(email.value == ""){
		document.getElementById("errorEmail").innerHTML="Please enter your email";
        email.style.borderColor="red";
		email.focus();
		return false;
	}else{
		return true;
	}}
	//validate ID No
	function validIDNo(){
	if(idNo.value == ""){
		document.getElementById("errorIDNo").innerHTML="Please enter your ID number";
        idNo.style.borderColor="red";
		idNo.focus();
		return false;
	}else{
		return true;
	}}
	//validate mobile number
	function validMobileNo(){
		var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{7})$/;
		var phoneno2 = /^\(?([0-9]{3})\)?[-. ]?([0-9]{8})$/;
	if(mobileNo.value == ""){
		document.getElementById("errorMobileNo").innerHTML="Please enter your mobile number";
        mobileNo.style.borderColor="red";
		mobileNo.focus();
		return false;
	}/*else if(mobileNo.value.length < 10 || mobileNo.value.length > 11){
		document.getElementById("errorMobileNo").innerHTML="Invalid mobile number format";
        mobileNo.style.borderColor="red";
		return false;
	}*/else if(!(mobileNo.value.match(phoneno) || mobileNo.value.match(phoneno2))) {
		document.getElementById("errorMobileNo").innerHTML="Invalid mobile number format";
				mobileNo.style.borderColor="red";
				mobileNo.focus();
		return false;
	}
	else{
		return true;
	}}
	//validate ID type
	function validIDtype(){
		if(selectValue == "type"){
			document.getElementById("errorIDType").innerHTML="Please choose your ID Type";
			idType.style.borderColor="red";
			idType.focus();
			return false;
		}
		else{
			return true;
		}}
		//validate date of birth
		function validDate(){
			if(date.value == ""){
				document.getElementById("errorDate").innerHTML="Please fill up the date";
				date.style.borderColor="red";
				date.focus();
				return false;
			}
			else{
				return true;
			}
		}
		function validQualification(){
			if(selectQual == "type"){
				document.getElementById("errorQualification").innerHTML="Please Choose a Qualification";
				qualification.style.borderColor="red";
				qualification.focus();
				return false;
			}
			else{
				return true;
			}}
		//validate result
		function validResult(){
		countR = 0;
		countG = 0;
		var resultError = document.getElementById("errorResult");
		for(i=0;i< score.length;i++){
			if(score[i].value != ""){
				countR++;
			}
		}
		for(i=0;i< subject.length;i++){
			if(subject[i].value != ""){
				countG++;
			}
		}
		if(countR < 3 || countG < 3 ){
			resultError.innerHTML = "Must at least enter 3 subject and 3 score";
			return false;
		}else{
			return true;
		}
		}
}

username.onkeyup = function(){
	if(username.value.length >= 5 && username.value.length <=15){
		username.style.borderColor="white";
		document.getElementById("errorUsername").innerHTML="";

	}
	else if(username.value == ""){
		document.getElementById("errorUsername").innerHTML="Please enter a username";
        username.style.borderColor="red";
	}
	else if(username.value.length < 5 || username.value.length > 15){
		document.getElementById("errorUsername").innerHTML="Username should be between 5-15 characters";
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
	var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{7})$/;
	var phoneno2 = /^\(?([0-9]{3})\)?[-. ]?([0-9]{8})$/;
	if(mobileNo.value.match(phoneno) || mobileNo.value.match(phoneno2)){
		document.getElementById("errorMobileNo").innerHTML="";
        mobileNo.style.borderColor="white";
	}
	else if(mobileNo.value == ""){
		document.getElementById("errorMobileNo").innerHTML="Please enter your mobile number";
        mobileNo.style.borderColor="red";
	}else if(!(mobileNo.value.match(phoneno) || mobileNo.value.match(phoneno2))) {
		document.getElementById("errorMobileNo").innerHTML="Invalid mobile number format";
				mobileNo.style.borderColor="red";
		return false;
	}
}

idType.onchange = function(){
	var selectValue = idType[idType.selectedIndex].value;
	if(selectValue != "type"){
		document.getElementById("errorIDType").innerHTML="";
		idType.style.borderColor="white";
	}
}

date.onchange = function(){
	if(date.value!=""){
		document.getElementById("errorDate").innerHTML="";
		date.style.borderColor="white";
	}
}

qualification.onchange = function(){
	var selectValue = qualification[qualification.selectedIndex].value;
	var viewBtn = document.getElementById("viewBtn");
	if(selectValue != "type"){
		document.getElementById("errorQualification").innerHTML="";
		qualification.style.borderColor="white";
	}
}

var gradeList = document.getElementById("gradeList");
gradeList.style.display = 'none';
function viewGradeList(){
	var row = document.getElementById("row");
	var table = document.getElementById("table");
	var gradeList = document.getElementById("gradeList");
	if(gradeList.style.display === "none"){
		gradeList.style.display = "block";
		row.setAttribute("class","row");

		table.setAttribute("class","col-8");

		gradeList.setAttribute("class","col-4 gradeList");
	}else{
		gradeList.style.display = "none";
		table.setAttribute("class","col-12");
	}
}
