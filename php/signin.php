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
$checkPass ="";
$errorMessage="";
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];
    $userType = $_POST['userType'];

    if($userType == "applicant"){
	$getUser = "SELECT username from applicant where username = '".$loginUsername."'";
    $checkPassword = "SELECT username,password from user where username='".$loginUsername."' and password = '".$loginPassword."'";
    $result = $conn->query($getUser);
	$checkPass = $conn->query($checkPassword);
  }else if($userType == "uniadmin"){
	$getUser = "SELECT adminUsername from university where adminUsername = '".$loginUsername."'";
	$result = $conn->query($getUser);
	$checkPassword = "SELECT username,password from user where username='".$loginUsername."' and password = '".$loginPassword."'";
	$checkPass = $conn->query($checkPassword);

  }else{
	$getUser = "SELECT username from sasadmin where username = '".$loginUsername."'";
    $checkPassword = "SELECT username,password from sasadmin where username='".$loginUsername."' and password = '".$loginPassword."'";
    $result = $conn->query($getUser);
	$checkPass = $conn->query($checkPassword);
  }
    if($result->num_rows != 1 || $checkPass->num_rows != 1){
      $errorMessage = "Incorrect username or password, Please Try Again.";

    }else{
      $_SESSION['loginUser'] = $loginUsername;
      $_SESSION['usertype'] = $userType;
		if($userType == "uniadmin"){
		  header('Location: uniadminLogin.php');
		}
		else if($userType == "sasadmin"){
		header('Location: sasadminLogin.php');
		}
		else if($_SESSION['selectedProgramme'] != ''){
		  header('location:coursedetail.php?pID='.$_SESSION['selectedProgramme'].'');
		}
        else{
			header('Location:../main/home.php');
		}
    }
  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/pages.css">
      <link rel="stylesheet" type="text/css" href="../css/signin.css">
      <link rel="stylesheet" type="text/css" href="../css/form.css">
    <title>Sign In</title>
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="../main/index.php">EasyEnroll</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../main/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="programmeList.php">Programme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Universities</a>
          </li>
        </ul>
      </div>
    </nav>

      <div class="container">

      <form class="form-signin form" method="post" action="signin.php">
        <div class="text-center mb-4">
          <h1 class="h3 mb-3 font-weight-normal">Sign in</h1>
          <!--p>Build form controls with floating labels via the <code>:placeholder-shown</code> pseudo-element. <a href="https://caniuse.com/#feat=css-placeholder-shown">Works in latest Chrome, Safari, and Firefox.</a></p-->
        </div>

        <div class="form-label-group">
          <input type="text" name="loginUsername" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
          <label for="inputUsername">Username</label>
		  <span class="error"></span>
        </div>

        <div class="form-label-group">
          <input type="password" name="loginPassword" id="inputPassword" class="form-control" placeholder="Password" required>
          <label for="inputPassword">Password</label>
		  <span class="error"><?php if($errorMessage != ""){echo $errorMessage;}?></span>
        </div>
        <div class="form-group">
                      <label for="userType">Sign in as:</label>
                      <select id="selectIDType" name="userType" class="form-control">
                        <option value="applicant" selected="">Applicant</option>
                        <option value="uniadmin">Uni Admin</option>
                        <option value="sasadmin">SAS Admin</option>
                      </select>
        </div>


        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <div class="signup-p">
          <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
      </form>

      </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>
