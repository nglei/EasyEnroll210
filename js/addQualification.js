var qualificationName = document.getElementById("qualificationName");
var minScore = document.getElementById("minScore");
var maxScore = document.getElementById("maxScore");
var calcMethod = document.getElementById("calcMethod");
var subNum = document.getElementById("subNum");
var gradeList = document.getElementById("gradelist");



function validation(){
	var selectMethod = calcMethod[calcMethod.selectedIndex].value;

	validQualName();
	validMinScore();
	validMaxScore();
	validCalcMethod();
	validSubNum();
	validGradeList();

	if(validQualName()){
		if(validMinScore()){
			if(validMaxScore()){
				if(validCalcMethod()){
					if(validSubNum()){
						if(validGradeList()){

								return true;
	}}}}}}

	return false;



	//validate qualification Name
	function validQualName(){
	if(qualificationName.value == ""){
		document.getElementById("errorQualification").innerHTML="Please enter a Qualification Name";
        qualificationName.style.borderColor="red";
		qualificationName.focus();
		return false;
	}
	else{
		return true;
	}}
	//validate minimum score
	function validMinScore(){

	if(isNaN(minScore.value)){
		document.getElementById("errorMinScore").innerHTML="Please enter number for minimum score";
        minScore.style.borderColor="red";
		minScore.focus();
		return false;
	}else if(minScore.value == ""){
		document.getElementById("errorMinScore").innerHTML="Please enter minimum score";
        minScore.style.borderColor="red";
		minScore.focus();
		return false;
	}
	else{
		return true;
	}}
	//validate maximum score
	function validMaxScore(){
	if(isNaN(maxScore.value)){
		document.getElementById("errorMaxScore").innerHTML="Please enter number for maximum score";
        maxScore.style.borderColor="red";
		maxScore.focus();
		return false;
	}else if(maxScore.value == ""){
		document.getElementById("errorMaxScore").innerHTML="Please enter maximum score";
        maxScore.style.borderColor="red";
		maxScore.focus();
		return false;
	}
	else{
		return true;
	}}
	//validate subject number
	function validSubNum(){
	if(subNum.value == ""){
		document.getElementById("errorSubNum").innerHTML="Please the number of subject";
        subNum.style.borderColor="red";
		subNum.focus();
		return false;
	}else if(isNaN(subNum.value)){
		document.getElementById("errorSubNum").innerHTML="Please enter numeric data for number of subject";
        subNum.style.borderColor="red";
		subNum.focus();
		return false;
	}else{
		return true;
	}}
	//validate gradelist
	function validGradeList(){
	if(gradeList.value == ""){
		document.getElementById("errorGradeList").innerHTML="Please a grade list";
        gradeList.style.borderColor="red";
		gradeList.focus();
		return false;
	}else{
		return true;
	}}

	//validate calculation method
	function validCalcMethod(){
		if(selectMethod == ""){
			document.getElementById("errorMethod").innerHTML="Please choose a calculation method";
			calcMethod.style.borderColor="red";
			calcMethod.focus();
			return false;
		}
		else{
			return true;
		}}

}


qualificationName.onkeyup = function(){
	if(qualificationName.value != ""){
		document.getElementById("errorQualification").innerHTML="";
        qualificationName.style.borderColor="white";
	}
	else if(qualificationName.value == ""){
		document.getElementById("errorQualification").innerHTML="Please enter a Qualification Name";
        qualificationName.style.borderColor="red";
	}
}

minScore.onkeyup = function(){
	if(isNaN(minScore.value)){
		document.getElementById("errorMinScore").innerHTML="Please enter number for minimum score";
		minScore.style.borderColor="red";}
	else if(minScore.value != ""){
		document.getElementById("errorMinScore").innerHTML="";
        minScore.style.borderColor="white";
	}
	else if(minScore.value == ""){
		document.getElementById("errorMinScore").innerHTML="Please enter minimum score";
        minScore.style.borderColor="red";
	}
}

maxScore.onkeyup = function(){
	if(maxScore.value == ""){
		document.getElementById("errorMaxScore").innerHTML="Please enter maximum score";
        maxScore.style.borderColor="red";
	}

	else if(isNaN(maxScore.value)){
		document.getElementById("errorMaxScore").innerHTML="Please enter number for maximum score";
		maxScore.style.borderColor="red";}
	else if(maxScore.value != ""){
		document.getElementById("errorMaxScore").innerHTML="";
        maxScore.style.borderColor="white";
	}


}

subNum.onkeyup = function(){
	if(subNum.value != ""){
		document.getElementById("errorSubNum").innerHTML="";
        subNum.style.borderColor="white";
	}
	if(isNaN(subNum.value)){
		document.getElementById("errorSubNum").innerHTML="Please enter numeric data for number of subject";
	subNum.style.borderColor="red";}
	else if(subNum.value == ""){
		document.getElementById("errorSubNum").innerHTML="Please the number of subject";
        subNum.style.borderColor="red";
	}
}

gradeList.onkeyup = function(){
	if(gradeList.value != ""){
		document.getElementById("errorGradeList").innerHTML="";
        gradeList.style.borderColor="white";
	}
	else if(gradeList.value == ""){
		document.getElementById("errorGradeList").innerHTML="Please a grade list";
        gradeList.style.borderColor="red";
	}
}

calcMethod.onchange = function(){
	var selectMethod = calcMethod[calcMethod.selectedIndex].value;
	if(selectMethod.value!=""){
		document.getElementById("errorMethod").innerHTML="";
		calcMethod.style.borderColor="white";
	}
}
