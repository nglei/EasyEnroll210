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

$errorQualification ="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $qualificationName = $_POST['qualificationName'];
    $minScore = $_POST['minScore'];
    $maxScore = $_POST['maxScore'];
    $method = $_POST['calcMethod'];
    $numOfSub = $_POST['subNum'];
    $gradeList = $_POST['gradelist'];

   	if(isset($_POST['qualificationName'])){
        $findQualification = "SELECT qualificationName from qualification where qualificationName = '".$qualificationName."'";
        $result = $conn->query($findQualification);
        if($result->num_rows >=1){
            $save = array($qualificationName,$minScore,$maxScore,$method,$numOfSub,$gradeList);
            $errorQualification = "Qualification already exist";
        }else{
            $insertQualification ="INSERT into qualification (qualificationName,minimumScore,maximumScore,method,numOfSubject,gradeList) values
            ('$qualificationName','$minScore','$maxScore','$method','$numOfSub','$gradeList')";
            $conn->query($insertQualification);
			echo "<script>alert ('Qualification has been recorded.');window.location.href = 'qualificationList.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/topcover.css">
      <link rel="stylesheet" type="text/css" href="../css/form.css">
    <title>Add Qualification</title>
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="../main/home.html">EasyEnroll</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="sasadminLogin.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addUniversityList.php">University</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="qualificationList.php">Qualification</a>
          </li>

        </ul>
        <?php
			if(isset($_SESSION['loginUser'])){
				echo '<ul class="dropdown nav navbar-nav navbar-right ml-auto">';
					echo '<li class="nav-item dropdown" >';
					echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
					$getName = "select * from sasadmin where username ='".$_SESSION['loginUser']."'";
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
                       <h1 class="page-title">Add Qualification</h1>
                       <ul>
                           <li>
                               <a class="active" href="../main/home.html">Home</a>
                           </li>
                           <li><a href="qualificationList.html">Qualification</a></li>
                           <li>Add Qualification</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
    </div>

    <main role="main" class="container">
      <div class="content">


      <form class="form-add-programme" method="post" action="addQualification.php" onsubmit="return validation()">
        <div class="mb-4">
          <h1 class="h3 mb-3 font-weight-normal">New Qualification</h1>
        </div>

        <div class="form-label-group">
          <input type="text" name="qualificationName" id="qualificationName" class="form-control" placeholder="Qualification Name" autofocus>
          <label for="qualificationName">Qualification Name</label>
		  <span id="errorQualification" class="error"><?php if($errorQualification!=""){echo $errorQualification;}?></span>
        </div>
		
		<div class="row">
		<div class="col-6">
        <div class="form-label-group">
          <input type="text" name="minScore" id="minScore" class="form-control" placeholder="Minimum Score" >
          <label for="minScore">Minimum Score</label>
		  <span id="errorMinScore" class="error"></span>
        </div></div>
		
		<div class="col-6">
        <div class="form-label-group">
          <input type="text" name="maxScore" id="maxScore" class="form-control" placeholder="Maximum Score" >
          <label for="maxScore">Maximum score</label>
		  <span id="errorMaxScore" class="error"></span>
        </div></div>
		</div>

        <div class="form-group">
          <label for="overallCal">Overall Result Calculation</label>
          <div class="row">
										<div class ="col-6">
										<select id="calcMethod" name="calcMethod" class="form-control">
										<option value="" disabled="" selected="">Calculation Type</option>
										<option value="average">Average</option>
										<option value="total">Total</option>
										</select>
										<span id="errorMethod" class="error"></span>
										</div>
										<div class ="col-6">
										<input type="text" id="subNum" name="subNum" class="form-control" placeholder="Number of subject">
										<span id="errorSubNum" class="error"></span>
										</div>
										</div>
        </div>
		
		<div id="myModal" class="modal">

										<!-- Modal content -->
										<div class="modal-content">
										<span class="close">&times;</span>
										<h6> Grade List</h6>
										<p>A   (4.00)<br>
										A-	(3.67)<br>
										B+ (3.33)<br>
										B    (3.00)<br>
										B-  (2.67)<br>
										C+  (2.33)<br>
										C   (2.00)<br>
										B+ (1.67)<br>
										D+ (1.33)<br>
										D  (1.00)<br>
										F  (0.00)<br>
										</p>
										</div>

										</div>

        <div class="form-group">
          <label for="gradelist">Grade List</label><button id="example" type="button" class="btn btn-link btn-sm">Example</button>
          <textarea name="gradelist" id="gradelist" class="form-control"  rows="5" cols="80" placeholder="Grade List" ></textarea>
		  <span id="errorGradeList" class="error"></span>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Add Qualification</button>
      </form>
      </div>



    </main><!-- /.container -->
		<script>

var modal = document.getElementById('myModal');
var btn = document.getElementById("example");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script src = "../js/addQualification.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
