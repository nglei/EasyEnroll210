var progName = document.getElementById("progName");
var duration = document.getElementById("inputDuration");
var date = document.getElementById("closingDate");
var fee = document.getElementById("inputFee");
var description = document.getElementById("inputDescription");

function validation(){

  validProg();
  validDuration();
  validDate();
  validFee();
  validDescription();

  if(validProg()){
    if(validDuration()){
      if(validDate()){
        if(validFee()){
          if(validDescription()){
            return true;
          }
        }
      }
    }
  }

  return false;


  function validProg(){
  if(progName.value == ""){
    document.getElementById("errorProg").innerHTML="Please enter a Programme Name";
        progName.style.borderColor="red";
    return false;
  }
  else{
    return true;
  }}
  function validDuration(){

  if(duration.value == ""){
    document.getElementById("errorDuration").innerHTML="Please enter a duration";
        duration.style.borderColor="red";
    return false;
  }else{
    return true;
  }}

  function validDate(){
  if(date.value == ""){
    document.getElementById("errorDate").innerHTML="Please enter closing date of the programme";
        date.style.borderColor="red";
    return false;
  }
  else{
    return true;
  }}
  function validFee(){
  if(fee.value == ""){
    document.getElementById("errorFee").innerHTML="Please enter the tuition fee";
        fee.style.borderColor="red";
    return false;
  }else{
    return true;
  }}
  function validDescription(){
  if(description.value == ""){
    document.getElementById("errorDescription").innerHTML="Please enter description";
        description.style.borderColor="red";
    return false;
  }else{
    return true;
  }}

  }

  progName.onkeyup = function(){
  if(progName.value != 0){
    progName.style.borderColor="white";
    document.getElementById("errorProg").innerHTML="";
  }

  }

  duration.onkeyup = function(){
  if(duration.value != 0){
    document.getElementById("errorDuration").innerHTML="";
        duration.style.borderColor="white";
  }
  }

  intake.onkeyup = function(){
  if(intake.value != 0){
    document.getElementById("errorIntake").innerHTML="";
        intake.style.borderColor="white";
  }
  }

  fee.onkeyup = function(){
  if(fee.value != ""){
    document.getElementById("errorFee").innerHTML="";
    fee.style.borderColor="white";
  }
  }

  description.onkeyup = function(){
  if(description.value != ""){
    document.getElementById("errorDescription").innerHTML="";
        description.style.borderColor="white";
  }
  }
