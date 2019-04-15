<?php
session_start();
$_SESSION['servername'] = "localhost";
$_SESSION['username'] = "root";
$_SESSION['password'] = "";
$conn = new mysqli($_SESSION['servername'], $_SESSION['username'],$_SESSION['password']);
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}

$createDb = "CREATE DATABASE easyenroll";
$useDb = "USE easyenroll";
$conn->query($createDb);
$conn->query($useDb);

$createUserTb = "CREATE TABLE user(username varchar(50) PRIMARY KEY,password varchar(25),
email varchar(40),name varchar(40) )";
$conn->query($createUserTb);

$createAdminTb = "CREATE TABLE sasadmin(username varchar(50) PRIMARY KEY,password varchar(25),
email varchar(40),name varchar(40) )";
$conn->query($createAdminTb);

$addAdmin ="  INSERT into sasadmin values('admin1','admin123','admin@gmail.com','Admin One')";
$conn->query($addAdmin);

$createApplicantTb = "CREATE TABLE applicant(
username varchar(50) PRIMARY KEY,
idtype varchar(10),
idno varchar(20),
mobileNo varchar(14),
dateOfBirth date,
foreign key (username) references user(username))";
$conn->query($createApplicantTb);

$createQualificationTb ="CREATE TABLE qualification(
qualificationID int auto_increment not null primary key,
qualificationName varchar(50),
minimumScore int(10),
maximumScore int(10),
method varchar(20),
numOfSubject int(5),
gradeList varchar(200))";
$conn->query($createQualificationTb);

$setIDindex = "alter table qualification AUTO_INCREMENT=10001";
$conn->query($setIDindex);

$qualificationObtainedTb = "CREATE table qualificationObtained(
qobtainedID int auto_increment primary key not null,
username varchar(50),
qualificationID int,
overallScore int(10),
foreign key (username) references user(username),
foreign key (qualificationID) references qualification(qualificationID))";
$conn->query($qualificationObtainedTb);

$setID = "alter table qualificationObtained AUTO_INCREMENT=20001";
$conn->query($setID);

$resultTb = "CREATE table result(
resultID int not null auto_increment primary key,
username varchar(50),
subject varchar(30),
grade varchar(5),
foreign key (username) references user(username))";
$conn->query($resultTb);

$programmeTb = "create table programme(
programmeID int auto_increment primary key not null,
UniID VARCHAR(12),
programmeName varchar(1000),
duration varchar(50),
totalFee int(10),
progDescription varchar(2000),
closingDate date,
imgURL varchar(200),
foreign key (UniID) references university(UniID))";
$conn->query($programmeTb);

$setProgID = "alter table programme AUTO_INCREMENt = 40001";
$conn->query($setProgID);

$entryReqTb = "CREATE TABLE entryReq(
programmeID int,
qualificationID int,
entryScore decimal(6,1),
foreign key (programmeID) references programme(programmeID),
foreign key (qualificationID) references qualification(qualificationID))";
$conn->query($entryReqTb);

$applicationTb = "create table application(
applicationID int auto_increment primary key,
applicationDate date,
applicationStatus varchar(20),
applicant varchar(50),
progID int,
foreign key (applicant) references applicant(username),
foreign key (progID) references programme(programmeID));";
$conn->query($applicationTb);

$setapplicationID = "alter table application AUTO_INCREMENt = 60001";
$conn->query($setapplicationID);

 ?>
 <!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyEnroll Index(Before login)</title>
    <style>
    html, body{
      margin:0;
      padding:0;
      width:100%;
      height:100%;
    }
    </style>
    <!--
    <link rel="stylesheet" type="text/css" href="css/normalize.css">-->
    <link rel="stylesheet" type="text/css" href="css/circleMenu.css">
    <link rel="stylesheet" type="text/css" href="css/3.css">
    <link rel="stylesheet" type="text/css" href="css/aos.css">
    <link rel = "stylesheet" type="text/css" href="indexnavbar.css">
    <script src="js/main.js"></script>
    <script src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="js/circularmenuII.js"></script>
    <script type="text/javascript">
    //initiate right-click menu
    $(document).ready(function(){
      $('body').circleMenu({
        'menu':'GalDropDown'
      })
    });</script>
  <!--
    <link rel="stylesheet" type="text/css" href="css/demo.css"> -->
    

  </head>
  <body>
    <!--right Click circular menu-->
    <div class="circleMenu GalDropDown">
      <div class="circle" id="gal">
        <div class="ring">
          <a href="#" class="menuItem" title="Home">Home</a>
          <a href="../html/signin.html" class="menuItem" >Login</a>
          <a href="../html/signin.html" class="menuItem" >Login</a>
          <a href="../html/signup.html" class="menuItem">Sign Up</a>
          <a href="../html/signup.html" class="menuItem">Sign Up</a>
        </div>
      </div>
    </div>
    <div id="overlay"style ="opacity:1; cursor:pointer;"></div>
    <script type="text/javascript">
    /**arrange right-click menu in circular form**/
    var items=document.querySelectorAll('.menuItem')//get the menu items
      for (var i=0; i<items.length; i++){
        items[i].style.left=(50-35*Math.cos(-0.5*Math.PI-2*(1/items.length)*i*Math.PI)).toFixed(4)+"%";
        items[i].style.top=(50+35*Math.sin(-0.5*Math.PI-2*(1/items.length)*i*Math.PI))+"%"
      }
      </script>
      <!--right Click circular navigation menu-->
    <script src="js/aos.js"></script><!--flip up animation detecting scrollindex-->
    <!--Slide Slider menu-->
    <!--self made navigation bar-->
    <div id="Topnav" class="topnav">
        
      <a id ="floatright" href="javascript:void(0);" class="hamburger" onclick="popNaviUp()">&#9776;</a>    
      <a href="../html/signin.html">Log In</a>
      <a href="../html/signup.html">Sign Up</a>
      
  </div>
  <script type="text/javascript">
      function popNaviUp(){
          //add on a class name to be responsive on screen size
          //refer to CSS
          var nav = document.getElementById("Topnav");
          var icon = document.getElementById("floatright");
      if(nav.className === "topnav"){
          nav.className += " smallscrn";
          //change icon
          icon.innerHTML = "&times;";
          icon.style.fontSize ="44";
          icon.style.textDecoration = "bold";
      }
      else{
          nav.className = "topnav" ;
          icon.innerHTML = "&#9776;";
          icon.style.fontSize ="17";
      }}</script>
      <!--self made navigation bar-->
      
    <!--
      <div id="clickonmenu" class="sidepanel" >
        <span href="javascript:void(0)" class="closemenu" onclick="closemenu()">&#9957;</span>
        <a href="#">Main</a>
        <a href="../html/signin.html">Log In</a>
        <a href="../html/signup.html">Sign Up</a>
        
        <a href="../html/signin.html">Sign In</a>
        <a href="../html/signup.html">Register as</a>
        <a href="../html/signup.html">applicant</a>
      </div>
      <--Slide Slider menu
      <!-- first place to click on to navigate to other page-->
      <!--flashing menu icon
      <div class="blackmenu">
        <img src="img/menu_circular_icon_png.png" alt="menu-icon" height="100vh" width="100vw"onclick="sidemenuout()">
        <span class="menuitem">
        <img src="img/menu_circular_iconwhite.png"alt="white-sa" height="100vh" width="100vw" onclick="sidemenuout()">
        </span>
      </div>-->
      <!--flashing menu icon-->
      <!-- Content body-->
      <div id="main">
        <div class="content">
          <script type="text/javascript">
          /**block "flip up" duration**/
          AOS.init({
            duration: 600,
            });</script>
            <!--Yale University Part-->
          <div class="Yale" data-aos="flip-up">
            <a href="../html/programmeList.html">
            <div class="Yalecontainer">
            <img src="img/Yale/975pxYaleUniversityShield1.png" alt="Yale school">
            <br>
            
            <h2>Yale University</h2>
            <br>
            
            <div class="Yaledescrip">
            <p >Yale’s tree-lined campus in New Haven Connecticut has housed “a company of scholars and a society of friends” for over 250 years.Enjoy a (digital) stroll through what one architecture critic has called “the most beautiful urban campus in America.”</p></div>
            <br></div>
            <p class="YaleRdM">Read more..</p>
            </a>
          </div>
<!--ANU University Part-->
          <div data-aos="flip-up">
            <a class ="Anu" href="../html/programmeList.html">
            <div class="Anu-container">
            <img src="img/ANU/croppedANULogo.png" alt="Australian National University" >
            <br>
            
            <h2> Australian National University</h2>
            <br>
            
            <p>Our Acton campus is in the heart of Canberra - Australia's capital city - in the Australian Capital Territory (ACT).
                
                Amongst our modern lecture halls, libraries, laboratories, student residences and administration buildings, you'll find all the conveniences of a small suburb including cafes, bars, supermarkets, child care centres, a newsagency, post office and even a medical centre.
                
                The Acton Campus is well renowned for its landscape setting, with many remnant and planted trees and an obvious commitment to maintenance of open space. ANU maintains over 10,000 trees, including over 500 considered to be of exceptional significance because of their age, history or species and over 300 remnant trees predating European occupation of the area.
                
                There are eight buildings or complexes of buildings currently listed on the Commonwealth Heritage List (CHL) and following the ANU Heritage Study (2012) over 60 more buildings/complexes have been identified as meeting the threshold for listing on the Commonwealth Heritage List.</p>
            </div>
            <br>
            <p class="AnuRdM"href="TRUE.html">Read more...</p>
          </a>
          </div>
<!--Australia Western University Part-->
          <div class="west" data-aos="flip-up">
            <a href="../html/programmeList.html">
              <div class="west-container">
            <img src="img/western/UWA2Modern.jpg" alt="University Western Australia">
            <br>
            <br>
            <h2>The University of Western Australia</h2>
            <br>
            <br>
            <p>From its extensive art collections and theatre venues to its wealth of sporting, cultural, alumni and social groups, the University is a leading intellectual and creative resource to the communities it serves.

                The University's affiliated residential colleges lie north of the campus. You can explore the campus through the UWA Virtual Universe or the campus map.
                
                UWA’s distinctive mix of heritage architecture and contemporary buildings contain state-of-the-art teaching
               and research facilities, lecture and performance
                theatres, tutorial spaces, studios and subject-specific
                 laboratories, creating the perfect learning
                  environment.</p><br>
                </div>
                  <p class="westRdM">Read more...</p>
            </a>
          </div>

          
        
     <!--particles interactive background-->
            <canvas id="demo-canvas"></canvas> 
        
      </div>
      <!-- /container 
      <script src="js/TweenLite.min.js"></script>
      <script src="js/EasePack.min.js"></script>
      <script src="js/rAF.js"></script>
      <script src="js/demo-1.js"></script>
      <script src="js/Rx.min.js"></script>
      <script src="js/rxcss.min.js"></script>
      <script src="js/index.js"></script>-->
    
   </div>
  </body>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html> 