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


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/list.css  ">
      <link rel="stylesheet" type="text/css" href="../css/topcover.css">
	  <link rel="stylesheet" type="text/css" href="../css/programmeList.css">
	  <link rel="stylesheet" type="text/css" href="../css/singleDiv.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  
    <title>EasyEnroll</title>
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
  </head>
  <body>
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
                       <h1 class="page-title">Home</h1>
                   </div>
               </div>
           </div>
       </div>
    </div>

    <!--main role="main" class="container"-->
<div class="container">
<div class="function">
<div class="" style="background-color: #eef3f6; ">
            <div class="row">
                <!-- Single Course Area -->
                <!--div class="col-12 col-sm-6 col-lg-6 "onclick="location.href='qualificationList.php';" style="cursor: pointer;">
                    <div class="single-course-area d-flex align-items-center  wow fadeInUp" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;margin:80px;">
                        <div class="course-icon">
                            <i class="fa fa-table"></i>
                        </div>
                        <div class="course-content">
                            <a href="#"><h4>Maintain Qualification</h4></a>

                        </div>
                    </div>
                </div-->
				<div class="col-12 col-sm-6 col-lg-6" onclick="location.href='qualificationList.php';" style="cursor: pointer;">
                    <div class="single-course-area d-flex align-items-center  wow fadeInUp" data-wow-delay="400ms" style="visibility: visible; animation-delay: 400ms; animation-name: fadeInUp; margin:80px;">
                        <div class="course-icon">
                            <i class="fa fa-table"></i>
                        </div>
                        <div class="course-content">
                            <h4>Maintain Qualification</h4>
                        </div>
                    </div>
                </div>
                <!-- Single Course Area -->
                <div class="col-12 col-sm-6 col-lg-6" onclick="location.href='addUniversityList.php';" style="cursor: pointer;">
                    <div class="single-course-area d-flex align-items-center  wow fadeInUp" data-wow-delay="400ms" style="visibility: visible; animation-delay: 400ms; animation-name: fadeInUp; margin:80px;">
                        <div class="course-icon">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <div class="course-content">
                            <h4>Register University</h4>
                        </div>
                    </div>
                </div>

            </div>
			</div>
</div>
</div>
<script>
  //create university list
  var universityList = document.getElementById("universityList");
  for ( var i = 0 ;i < 8 ;i++){
    var a = document.createElement("a");
    a.setAttribute("href","#");
    a.setAttribute("class",'list-group-item list-group-item-action');
    a.innerHTML = "University " + (i+1);
    universityList.appendChild(a);
    }
</script>



    <!--/main>< /.container -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
