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

$errorResult = "";
$save="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$qualification = $_POST['qualification'];
	$checkQual = false;
	$checkQualObtain = "select * from qualificationobtained where username='".$_SESSION['loginUser']."' and qualificationID = $qualification";
	$getQualObtain = $conn->query($checkQualObtain);
	if($getQualObtain->num_rows == 0){
		
	
	$subjectList = $_POST['subject'];
    $gradeList = $_POST['grade'];
	
	$getNumSubject = "SELECT numOfSubject from qualification where qualificationID='".$qualification."'";
    $noSubject = $conn->query($getNumSubject);
	
	if($noSubject->num_rows > 0){

        while($noSub = $noSubject->fetch_assoc()){
			for($i = 0;$i < $noSub['numOfSubject'] ;$i++){
                if($gradeList[$i] == ""){
					$errorResult = "Must at least enter ".$noSub['numOfSubject']." subject and ".$noSub['numOfSubject']." score";
				}
            }
        if(sizeof($gradeList) < $noSub['numOfSubject']){
			
            $errorResult = "Must at least enter ".$noSub['numOfSubject']." subject and ".$noSub['numOfSubject']." score";
        }
      }
      }
	$save = $qualification;}else{$checkQual = true;}
	if($errorResult ==""){
		if($checkQual == false){
	  $getMethod = "SELECT method,numOfSubject from qualification where qualificationID = '".$qualification."'";
      $methodRow = $conn->query($getMethod);
      $overallScore = 0;
      if($methodRow->num_rows > 0){
                while($row = $methodRow->fetch_assoc()){
                  $method = $row["method"];
                  $numOfSubject = $row["numOfSubject"];
                  if($method == "total"){
                    rsort($gradeList);
                    for($i = 0;$i < $numOfSubject ;$i++){
                      $overallScore =  ($overallScore + $gradeList[$i]);
                    }
                  }else{
					for($i = 0;$i < $numOfSubject ;$i++){
						rsort($gradeList);
                      $overallScore =  ($overallScore + $gradeList[$i]);
                    }
					$overallScore = ($overallScore / $numOfSubject);
				  }
                }}

     	$insertQualObtained = "INSERT into qualificationobtained (username,qualificationID,overallScore) values ('".$_SESSION['loginUser']."','$qualification','$overallScore')";
		  $conn->query($insertQualObtained);



      for($i = 0;$i < sizeof($subjectList) ;$i++){
        $subject = $subjectList[$i];
        $grade = $gradeList[$i];
        $insertResult = "INSERT into result (username,subject,grade,qID) values('".$_SESSION['loginUser']."','$subject','$grade','$qualification')";
     		$conn->query($insertResult);
		}
		$checkQual=true;}
	if($checkQual == true){
	  $overallScore ="";
	$qualificationobtained = "";
	$getScore = "select * from qualificationobtained where username = '".$_SESSION['loginUser']."'";
	$getResult = $conn->query($getScore);
	if($getResult->num_rows > 0){
		while($row = $getResult->fetch_assoc()){
			$overallScore = $row['overallScore'];
			$qualificationobtained = $row['qualificationID'];
	}}
	  
	  $getEntry = "SELECT * from entryreq where programmeID = '".$_SESSION['selectedProgramme']."'";
	$entryArray = $conn->query($getEntry);
	if($entryArray->num_rows > 0){
		while($entry = $entryArray->fetch_assoc()){
			if($qualificationobtained == $entry['qualificationID']){
			if($overallScore < $entry['entryScore']){
				$insertApplication = "INSERT into application (applicationDate,applicationStatus,applicant,progID,qID) values (curdate(),'Not Eligible','".$_SESSION['loginUser']."','".$_SESSION['selectedProgramme']."','$qualification') ";
				if($conn->query($insertApplication)===FALSE){
          echo "Error inserting Application with NOT ELIGIBLE application" . $conn->error;
        }
					
			}else{
				$insertApplication = "INSERT into application (applicationDate,applicationStatus,applicant,progID,qID) values(curdate(),'New','".$_SESSION['loginUser']."','".$_SESSION['selectedProgramme']."','$qualification') ";
				if($conn->query($insertApplication)===FALSE){
          echo "Error inserting Application With Valid Application" . $conn->error;
        }
			}
			}
			
		}
	}
	echo "<script>alert ('Application successful submitted.');window.location.href='programmeList.php';</script>";  
	}}
	
}?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/form.css">
      <link rel="stylesheet" type="text/css" href="../css/applyProgramme.css">
      <link rel="stylesheet" type="text/css" href="../css/topcover.css">
    <title>Programme List</title>
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="../main/home.php">EasyEnroll</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../main/home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="programmeList.php">Programme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">University</a>
          </li>

        </ul>
        <?php
			if(isset($_SESSION['loginUser'])){
				echo '<ul class="dropdown nav navbar-nav navbar-right ml-auto">';
					echo '<li class="nav-item dropdown" >';
					echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
					$getName = "select * from user where username ='".$_SESSION['loginUser']."'";
					$user=$conn->query($getName);
					if($user->num_rows > 0){
						while($name = $user->fetch_assoc()){
							echo "Welcome, ".$name['name']."</a>";
						}
					}
					echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
					echo '<a class="dropdown-item" href="signout.php">Logout</a>';
					echo '</div></li></ul>';
                }else{
					echo '<ul class="nav navbar-nav navbar-right ml-auto">';
					echo '<li class="nav-item" ><a class="nav-link" href="signin.php">Register/Login</a></li></ul>';
				
                }
        ?>

      </div>



    </nav>

    <div class="top-cover top-overlay top-title">
      <div class="top-inner">
           <div class="container">
               <div class="row">
                   <div class="col-md-12 text-center">
                       <h1 class="page-title">Programme</h1>
                       <ul>
                           <li>
                               <a class="active" href="../main/home.php">Home</a>
                           </li>
                           <li>
                               <a class="active" href="programmeList.php">Programme</a>
                           </li>
                           <li>
                               <a class="active" href="#">Programme Details</a>
                           </li>
                           <li>Apply Programme</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
    </div>

    <!--main role="main" class="container"-->

      <div class="container">
	  
        <div class="addQualification">
			<div class="">
				<h1>Qualification</h1>
			</div>
        <div class="col">
		<form action="qualificationForApply.php" onsubmit="return validation()" method="post" >
		<div>
		<label>Select a qualification</label>
            <select id="selectQualification" name="qualification" class="form-control">
            
            <option value="" disabled selected>Qualification</option>
            <?php
                $getQualification = "SELECT entryreq.qualificationID,qualificationName from qualification,entryreq where qualification.qualificationID=entryreq.qualificationID and programmeID = '".$_SESSION['selectedProgramme']."'";
                $qualification = $conn->query($getQualification);
                if($qualification->num_rows > 0){
                    while($row = $qualification->fetch_assoc()){
						echo "<option value='" .$row["qualificationID"] ."'>" .$row["qualificationName"] ."</option>";
                    }
                }
                ?>
            </select>
			<span id="errorQualification" class="error"></span>
		</div>
		<span id="viewBtn"><br><input type="button" class="btn btn-primary btn-sm " onclick="viewGradeList()" value="View Grade List"></span>
		<div id="row">
		<div id="table">
						   <br>
                             <table class="table" id="result" name="result">
                               <thead>
                                 <tr>
                                   <th>Subject</th>
                                   <th>Score</th>
                                 </tr>
                               </thead>
                               <tbody>
                                 <tr>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="subject1" name="subject[]" class="form-control" placeholder="Subject">
                                       <label for="subject">Subject</label>
                                     </div>
                                   </td>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="score1" name="grade[]" class="form-control" placeholder="Grade">
                                       <label for="grade">Score</label>
                                     </div>
                                   </td>
                                 </tr>
                                 <tr>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="subject2" name="subject[]" class="form-control" placeholder="Subject">
                                       <label for="subject">Subject</label>
                                     </div>
                                   </td>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="score2" name="grade[]" class="form-control" placeholder="Grade">
                                       <label for="grade">Score</label>
                                     </div>
                                   </td>
                                 </tr>
                                 <tr>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="subject3" name="subject[]" class="form-control" placeholder="Subject">
                                       <label for="subject">Subject</label>
                                     </div>
                                   </td>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="score3" name="grade[]" class="form-control" placeholder="Grade">
                                       <label for="grade">Score</label>
                                     </div>
                                   </td>
                                 </tr>



                                 <tr><td><input type="button" class="btn btn-primary btn-sm " onclick="addSubject()" value="Add Subject"></td></tr>
                               </tbody>

                             </table>
							 </div>
							 <div id="gradeList" class="gradeList">
							 <br>
	<?php
	$getGradeList = "SELECT qualificationName,gradeList from qualification";
    $gradeList = $conn->query($getGradeList);
    if($gradeList->num_rows > 0){
    while($row = $gradeList->fetch_assoc()){
	echo $row["qualificationName"]."<br>";
	echo $row["gradeList"]."<br><br>";}

    }
									/*echo "<script>";
									echo 'var qualification = document.getElementById("qualification");';
									echo "var value = qualification[qualification.selectedIndex].value;";
									echo 'qualification.onchange = function(){';
									echo 'if(value == "Q01"){';
									echo ' alert("got");';
									echo 'var list = document.getElementById("gradeList");';
									echo 'list.innerHTML = "<p>cde</p>";}';
									echo 'else{list.innerHTML = "<p>xyz</p>";}} ';
									echo "</script>";*/
								?>
							 </div></div>
		
		<div><span id="errorResult" class="error"><?php if($errorResult !=""){echo $errorResult;}?></span></div>
              <div class="text-center" id="addButton">
              <input class="btn btn-lg btn-primary" type="submit" value="Apply Programme">
              </div>
          </div>
          <hr>
        </div>
		</form>

		
        </div>
		
<script>
	var qualification = document.getElementById("selectQualification");
	function validation(){
		var selectQual = qualification[qualification.selectedIndex].value;
		if(validQualification()){
      //if (validScoreEntered()){
			return true;//}
		}
		return false;
		function validQualification(){
			if(selectQual == ""){
				document.getElementById("errorQualification").innerHTML="Please Choose a Qualification";
				qualification.style.borderColor="red";
				qualification.focus();
				return false;
			}
			else{
				return true;
			}}
	}
	
	qualification.onchange = function(){
	var selectValue = qualification[qualification.selectedIndex].value;
	var viewBtn = document.getElementById("viewBtn");
	if(selectValue != ""){
		document.getElementById("errorQualification").innerHTML="";
		qualification.style.borderColor="grey";
	}
}
  //var allScorefield = document.getElementByTagName("grade[]");
  //to check the Score should nott be alphbet
  //function validScoreEntered(){

     var count = 4;
     var table = document.getElementById("result");

     //add a row to enter subject and grade
     function addSubject(){
       var row = table.insertRow(count);
       var cell1 = row.insertCell(0);
       var cell2 = row.insertCell(1);
       cell1.innerHTML = "<div class='form-label-group'><input type='text' id='subject"+count+"' name='subject[]' class='form-control' placeholder='Subject'><label for='subject'>Subject</label></div>";
       cell2.innerHTML = "<div class='form-label-group'>" +
                                     "<input type='text' id='score"+count+"' name='grade[]' class='form-control' placeholder='Grade'>"+
                                     "<label for='grade'>Score</label></div>";
                                     count++;
                                   }

     </script>
	 <script>
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
}</script>

	 <?php
		echo "<script>";
		echo "var qualification = document.getElementById('selectQualification');";
		echo "qualification.value ='".$save."';";
		echo "</script>";
	 ?>

    <!--/main>< /.container -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
