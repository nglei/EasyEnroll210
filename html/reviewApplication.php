<?php
session_start();
$_SESSION['servername'] = "localhost";
$_SESSION['username'] = "root";
$_SESSION['password'] = "";
$conn = new mysqli($_SESSION['servername'], $_SESSION['username'],$_SESSION['password']);
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}
$useDb = "USE easyenroll";
$conn->query($useDb);

if(isset($_GET['aID'])){
$_SESSION['application'] = $_GET['aID'];}	

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['accept'])){
	$updateStatus = "UPDATE application set applicationStatus='Successful' where applicationID =".$_SESSION['application'];
	$conn->query($updateStatus);
	echo "<script>alert ('Application accepted succesfully.');window.location.href = 'allApplication.php?pID=".$_SESSION['programme']."';</script>";
	}else{
	$updateStatus = "UPDATE application set applicationStatus='Unsuccessful' where applicationID =".$_SESSION['application'];
	$conn->query($updateStatus);
	echo "<script>alert ('Application rejected.');window.location.href = 'allApplication.php?pID=".$_SESSION['programme']."';</script>";	
	}
	
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/list.css  ">
      <link rel="stylesheet" type="text/css" href="../css/topcover.css">
      <link rel="stylesheet" type="text/css" href="../css/applyProgramme.css">
      <link rel="stylesheet" type="text/css" href="../css/review.css">
    <title>Review Application</title>
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="uniadminLogin.php">EasyEnroll</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="uniadminLogin.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addProgrammeList.php">Programme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="applicationList.php">Review Application</a>
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
                       <h1 class="page-title">Review Application</h1>
                       <ul>
                           <li>
                               <a class="active" href="uniadminLogin.php">Home</a>
                           </li>
                           <li>
                               <a class="active" href="applicationList.php">Review Application</a>
                           </li>
                           <li>
                               <a class="active" href="allApplication.php?pID=<?php echo $_SESSION['programme'];?>">Application List</a>
                           </li>
                           <li>Application</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
    </div>

    <!--main role="main" class="container"-->
    <div class="container">

      <div class="details">
        <div>
          <h3>Applicant Details</h3>
          <div class="box">
            <?php
				$getApplication = "select * from application,user where user.username = application.applicant and application.applicationID =".$_GET['aID'];
				$result = $conn->query($getApplication);
				if($result->num_rows >0){
					while($row = $result->fetch_assoc()){
						$getProgramme = "SELECT * from programme where programmeID =".$row['progID'];
						$programme = $conn->query($getProgramme);
						if($programme->num_rows == 1){
							while($progName = $programme->fetch_assoc()){
								echo '<div class="row"><div class="col-12"><b>Programme Name:  </b>'.$progName['programmeName'].'</div>';
							}
						}
						echo '<div class="col-12"></br><b>Applicant\'s Name:</b>  '.$row['name'].'</div>';
						$getQualification = "select * from qualificationobtained,qualification where qualification.qualificationID=qualificationobtained.qualificationID and username='".$row['applicant']."'";
						$getResult = $conn->query($getQualification);
						if($getResult->num_rows > 0){
							while($qualification = $getResult->fetch_assoc()){
								echo '<div class="col-12"></br><b>Qualification Obtained: </b>'.$qualification["qualificationName"].'</div>';
								echo '<div class="col-12"></br><b>Overall Score: </b>'.$qualification['overallScore'].'</div>';
							}
						}	
						echo "</div></div></div>";
						echo '<h2>Applicant\'s Result</h2>';
						echo '<div class="col-12"><div class=box">';	
						echo '<table class="table table-bordered">';
						echo '<thead><tr><th>Subject</th><th>Score</th></tr></thead>';
						$getSubject = "select * from result where username = '".$row['applicant']."'";
						$allSubject = $conn->query($getSubject);
						if($allSubject->num_rows > 0){
							while($subject = $allSubject->fetch_assoc()){
								echo '<tr><td>'.$subject['subject'].'</td>';
								echo '<td>'.$subject['grade'].'</td></tr>';
							}
						}
						echo "</table>";
					}
				}
			?>
			</div></div>
            <div class="col-12 mb-30 text-center">
				<form method="post" action="reviewApplication.php">									
					<input type="submit" name="accept" class="btn btn-primary btn-sm mt-15" value="Accept">
					<input type="submit" name="reject" class="btn btn-primary btn-sm mt-15" value="Reject">
					<input type="button" name="back" class="btn btn-primary btn-sm mt-15" onclick="location.href = 'allApplication.php?pID=<?php echo $_SESSION['programme'];?>';" value="Back to List">									
				</form></div>
          </div>

      </div>


</div>




    <!--/main>< /.container -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
