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

$errorUsername = "";
$errorResult = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  	$username = $_POST['username'];
	$password = $_POST['password'];
   	$name = $_POST['fullName'];
   	$email = $_POST['email'];
   	$idType = $_POST['idType'];
   	$idNo = $_POST['idNo'];
   	$mobileNo = $_POST['mobileNo'];
   	$date = $_POST['date'];	

if(isset($_POST['username'])){
   	$findUser = "SELECT username from user where username = '".$username."'";
   	$result = $conn->query($findUser);
 	if($result->num_rows >=1){
        $save = array($username,$name,$email,$idType,$idNo,$mobileNo,$date);
   		$errorUsername = "Username already exist.";
   	}

    if($errorUsername == "" && $errorResult ==""){
     	$insertUser = "INSERT into user (username,password,email,name) values('$username','$password','$email','$name')";
     	$conn->query($insertUser);

     	$insertApplicant = "INSERT into applicant (username,idtype,idno,mobileNo,dateOfBirth) values('$username','$idType','$idNo','$mobileNo','$date')";
		$conn->query($insertApplicant);      
		header('location:signin.php');
     	}
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/pages.css">
      <link rel="stylesheet" type="text/css" href="../css/signup.css">
      <link rel="stylesheet" type="text/css" href="../css/form.css">
    <title>Sign Up</title>
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
  </head>
  <body>
    <header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="../main/home.html">EasyEnroll</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../main/index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="programmeList.html">Programme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../main/home.html">Universities</a>
          </li>
        </ul>
      </div>
    </nav>
</header>
    <main role="main" class="container">



      <form action="signup.php" method="post"class="formSignup test" onsubmit="return validation()">
        <div class="text-center mb-4">
          <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>
        </div>


        <div class="form-label-group">
          <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username">
          <span id="errorUsername"><?php if($errorUsername !=""){echo $errorUsername;}?></span>
          <label for="inputUsername">Username</label>
        </div>

        <div class="form-label-group">
          <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" >
          <span id="errorPassword"></span>
          <label for="inputPassword">Password</label>
        </div>

        <div class="form-label-group">
          <input type="password" id="inputConfirmPass" class="form-control" placeholder="Confirm Password" >
          <span id="errorConfirmPass"></span>
          <label for="inputConfirmPass"> Confirm Password</label>
        </div>

        <div class="form-label-group">
          <input type="text" name="fullName" id="inputName" class="form-control" placeholder="Full Name">
          <span id="errorName"></span>
          <label for="inputName">Full Name</label>
        </div>

        <div class="form-label-group">
          <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email Address">
          <span id="errorEmail"></span>
          <label for="inputEmail">Email Address</label>
        </div>


          <div class="form-label-group">
            <select id="selectIDType" name="idType" class="form-control">
              <option value="type" disabled="" selected="">ID Type</option>
              <option value="ic">IC</option>
              <option value="passport">Passport</option>
            </select>
            <span id="errorIDType"></span>


          </div>

          <div class="form-label-group">
            <input type="text" name="idNo" id="inputIDNo" class="form-control" placeholder="IDNo">
            <span id="errorIDNo"></span>
            <label for="inputIDNo">ID Number</label>
          </div>


        <div class="form-label-group">
          <input type="text" name="mobileNo" id="inputMobile" class="form-control" placeholder="Mobile Number">
          <span id="errorMobileNo"></span>
          <label for="inputMobile">Mobile Number</label>
        </div>

        <div class="form-label-group">
          <input type="date" name="date" id="inputDateOfBirth" class="form-control">
          <span id="errorDate"></span>
          <label for="inputDateOfBirth">Date of Birth</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>

      </form>
      </div>
    </div>




    </main><!-- /.container -->
	 <?php
		echo "<script>var username = document.getElementById('inputUsername');";
		echo "var fullName = document.getElementById('inputName');";
		echo "var email = document.getElementById('inputEmail');";
		echo "var idType = document.getElementById('selectIDType');";
		echo "var idNo = document.getElementById('inputIDNo');";
		echo "var mobileNo = document.getElementById('inputMobile');";
		echo "var date = document.getElementById('inputDateOfBirth');";
		echo "username.value ='". $save[0]."';";
		echo "fullName.value ='". $save[1]."';";
		echo "email.value ='". $save[2]."';";
		echo "idType.value ='". $save[3]."';";
		echo "idNo.value ='". $save[4]."';";
		echo "mobileNo.value ='". $save[5]."';";
		echo "date.value ='". $save[6]."';";
		echo "</script>";
	 ?>
    <script src="../js/signup.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>
