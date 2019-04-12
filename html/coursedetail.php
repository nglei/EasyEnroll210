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
if(isset($_GET['pID'])){
$_SESSION['selectedProgramme'] = $_GET['pID'];}	
$universityName = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_SESSION['loginUser'])){
		
	
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
				$insertApplication = "INSERT into application (applicationDate,applicationStatus,applicant,progID) values (curdate(),'Not Eligible','".$_SESSION['loginUser']."','".$_SESSION['selectedProgramme']."') ";
				$conn->query($insertApplication);
					
			}else{
				$insertApplication = "INSERT into application (applicationDate,applicationStatus,applicant,progID) values(curdate(),'New','".$_SESSION['loginUser']."','".$_SESSION['selectedProgramme']."') ";
				$conn->query($insertApplication);
			}
			}
			
		}
	}
	echo "<script>alert ('Application successful submitted.');window.location.href = 'programmeList.php';</script>";
	
	
}else{
	header("location:signin.php");
}}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/form.css">
      <link rel="stylesheet" type="text/css" href="../css/list.css">
      <link rel="stylesheet" type="text/css" href="../css/topcover.css">
      <link rel="stylesheet" type="text/css" href="../css/programmeList.css">
      <link rel="stylesheet" type="text/css" href="../css/coursedetail.css">
    <title>Course Detail</title>
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
            <a class="nav-link" href="../main/home.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="programmeList.html">Programme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../main/home.html">University</a>
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
                       <h1 class="page-title">Programme Details</h1>
                       <ul>
                           <li>
                               <a class="active" href="../main/home.html">Home</a>
                           </li>
                           <li>
                               <a class="active" href="programmeList.html">Programme</a>
                           </li>
                           <li>Course 001</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
    </div>

    <div class="container">
            <?php
			$getProgramme = "SELECT * from programme where programmeID =".$_SESSION['selectedProgramme'];
			$result = $conn->query($getProgramme);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
											
					$getUniversity = "SELECT * FROM university where UniID ='".$row['UniID']."'";
					$uniArray = $conn->query($getUniversity);
					if($uniArray->num_rows > 0){
						while($uni = $uniArray->fetch_assoc()){
							$universityName = $uni['UniName'];
						}
					}
					echo '<div class="mb-30 main col-12">';
					echo '<div class="coursedetail">';
					echo '<div class="mb-30">';
					echo '<img src="../'.$row['imgURL'].'" style="height:300px;width:100%;" alt="programmeImage"></div>';
					echo '<h2>'.$row['programmeName'].'</h2></br>';
					echo '<div class="row"><div class="col-6">';
					echo '<b>Duration: </b></br>'.$row['duration'].'</div>';
					echo '<div class="col-6">';
					echo '<b>Closing Date: </b></br>'.$row['closingDate'].'</div>';
					echo '<div class="col-6">';
					echo '</br><b>Programme Fee: </b></br>RM'.$row['totalFee'].'</div>';
					echo '</div>';
					echo '<div class="mb-30"></br><b>About this Programme</b><br></div>';
					echo '<p>'.$row['progDescription'].'</p>';
				}
			}
			 ?>
				<div>
					<form method="post" action="coursedetail.php">
									<input type="submit" name="apply" class="btn btn-primary" value="Apply This Programme">
									</form>
				</div>
            </div>
        </div>
	
          </div>

          <hr>




    <!--/main>< /.container -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>