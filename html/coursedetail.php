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
    if($_SESSION['usertype'] == "uniadmin"){
      header("location:addProgrammeList.php");
    }else{
	echo "<script>window.location.href = 'qualificationForApply.php?pID=".$_SESSION['selectedProgramme']."';</script>";
	}
	
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
            <a class="nav-link" href="../main/home.php">University</a>
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
                               <a class="active" href="../main/home.php">Home</a>
                           </li>
                           <li>
                               <a class="active" href="programmeList.php">Programme</a>
                           </li>
                           <li>Programme Details</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
    </div>

    <div class="container">
            <?php
			$getProgramme = "SELECT * from programme where programmeID =".$_GET['pID'];
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
					echo '<img src="'.$row['imgURL'].'" style="height:300px;width:100%;" alt="programmeImage"></div>';
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
			echo "<div>";
			echo "<b>Entry Requirement</b>";
			echo '<table class="table table-bordered">';
			echo '<thead><tr><th>Qualification</th><th>OverallScore</th></tr></thead>';
			$getEntry = "SELECT entryreq.qualificationID,qualificationName,entryScore from qualification,entryreq where qualification.qualificationID=entryreq.qualificationID and programmeID = '".$_GET['pID']."'";
			$entry = $conn->query($getEntry);
			if($entry->num_rows > 0){
				while($req=$entry->fetch_assoc()){
					echo '<tr><td>'.$req['qualificationName'].'</td>';
					echo '<td>'.$req['entryScore'].'</td></tr>';
				}
			}
			echo "</table>";
			echo "</div>";
			 ?>
				<div>
					<form method="post" action="coursedetail.php">
            <?php
			if(isset($_SESSION['usertype'])){
				if($_SESSION['usertype'] == "uniadmin"){
              echo "<input type='submit' name='apply' class='btn btn-primary' value='&#x21B0;&nbsp;Back To List of Programmes Added By UniAdmin'>";
            }else{
            echo"<input type='submit' name='apply' class='btn btn-primary' value='Apply This Programme'>";
            }}else{
            echo"<input type='submit' name='apply' class='btn btn-primary' value='Apply This Programme'>";}
            ?>
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
