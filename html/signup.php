<?php
session_start();
$_SESSION['servername'] = "localhost";
$_SESSION['username'] = "root";
$_SESSION['password'] = "";
$conn = new mysqli($_SESSION['servername'], $_SESSION['username'],$_SESSION['password']);
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/pages.css">
      <link rel="stylesheet" type="text/css" href="../css/signup.css">
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
      <a class="navbar-brand" href="#">EasyEnroll</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Programme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Universities</a>
          </li>
        </ul>
      </div>
    </nav>
</header>
    <main role="main" class="container">



      <form class="formSignup test" onsubmit="return validation()" method="get">
        <div class="text-center mb-4">
          <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>
        </div>


        <div class="form-label-group">
          <input type="text" id="inputUsername" class="form-control" placeholder="Username">
          <span id="errorUsername" class="error"></span>
          <label for="inputUsername">Username</label>
        </div>

        <div class="form-label-group">
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" >
          <span id="errorPassword" class="error"></span>
          <label for="inputPassword">Password</label>
        </div>

        <div class="form-label-group">
          <input type="password" id="inputConfirmPass" class="form-control" placeholder="Confirm Password" >
          <span id="errorConfirmPass" class="error"></span>
          <label for="inputConfirmPass"> Confirm Password</label>
        </div>

        <div class="form-label-group">
          <input type="text" id="inputName" class="form-control" placeholder="Full Name">
          <span id="errorName" class="error"></span>
          <label for="inputName">Full Name</label>
        </div>

        <div class="form-label-group">
          <input type="email" id="inputEmail" class="form-control" placeholder="Email Address">
          <span id="errorEmail" class="error"></span>
          <label for="inputEmail">Email Address</label>
        </div>


          <div class="form-label-group">
            <select id="selectIDType" class="form-control">
              <option value="type" disabled="" selected="">ID Type</option>
              <option value="ic">IC</option>
              <option value="passport">Passport</option>
              <option value="other">Other</option>
            </select>
            <span id="errorIDType" class="error"></span>


          </div>

          <div class="form-label-group">
            <input type="text" id="inputIDNo" class="form-control" placeholder="IDNo">
            <span id="errorIDNo" class="error"></span>
            <label for="inputIDNo">ID Number</label>
          </div>


        <div class="form-label-group">
          <input type="text" id="inputMobile" class="form-control" placeholder="Mobile Number">
          <span id="errorMobileNo" class="error"></span>
          <label for="inputMobile">Mobile Number</label>
        </div>

        <div class="form-label-group">
          <input type="date" id="inputDateOfBirth" class="form-control">
          <span id="errorDate" class="error"></span>
          <label for="inputDateOfBirth">Date of Birth</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>

      </form>
      </div>
    </div>




    </main><!-- /.container -->
    <?php
      echo $_GET['username'];
     ?>

    <script src="../js/signup.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>
