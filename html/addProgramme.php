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

$getQualification = "SELECT qualificationID,qualificationName from qualification";
$qualification = $conn->query($getQualification);
	
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $programmeName = $_POST['programmeName'];
    $description = $_POST['description'];
    $closingDate = $_POST['closingDate'];
	$duration = $_POST['duration'];
	$fee = $_POST['fee'];
	$imageLocation = "../img/prog-img/".$_FILES['uploadImage']['name'];
	move_uploaded_file($_FILES['uploadImage']['tmp_name'],$imageLocation);

	
    $insertProgramme ="INSERT into programme (UniID,programmeName,duration,totalFee,progDescription,closingDate,imgURL) values
    ('".$_SESSION['uniID']."','$programmeName','$duration','$fee','$description','$closingDate','$imageLocation')";
    $conn->query($insertProgramme);
	
	$getID = "SELECT * FROM programme where programmeName='".$programmeName."' and progDescription = '".$description."' and closingDate = '".$closingDate."'";
	$programme = $conn->query($getID);
	$progID = "";
	if($programme->num_rows == 1){
		while($id = $programme->fetch_assoc()){
			$progID = $id['programmeID'];
		}
	}
	
	if($qualification->num_rows > 0){
        while($row = $qualification->fetch_assoc()){
			$qID = $row['qualificationID'];
			$entryReq = $_POST[$qID];
			$insertReq = "INSERT into entryreq (programmeID,qualificationID,entryScore) values ('$progID','$qID','$entryReq')";
			$conn->query($insertReq);
				
			
		}
	}
	echo "<script>alert ('Programme added.');window.location.href = 'addProgrammeList.php';</script>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/topcover.css">
      <link rel="stylesheet" type="text/css" href="../css/form.css">
    <title>Add Programme</title>
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
            <a class="nav-link" href="addProgrammeList.html">Programme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reviewApplication.html">Review Application</a>
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
                       <h1 class="page-title">Add Programme</h1>
                       <ul>
                           <li>
                               <a class="active" href="index.html">Home</a>
                           </li>
                           <li><a href="addProgrammeList.html">Programme</a></li>
                           <li>Add Programme</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
    </div>

    <main role="main" class="container">
      <div class="content">


      <form class="form-add-programme" action="addProgramme.php" onsubmit = "return validation()" method="post" enctype="multipart/form-data">
        <div class="mb-4">
          <h1 class="h3 mb-3 font-weight-normal">New Programme</h1>
        </div>

        <div class="form-label-group">
          <input type="text" name="programmeName" id="progName" class="form-control" placeholder="Programme Name" autofocus>
          <span id="errorProg" class="error"></span>
          <label for="progName">Programme Name</label>
        </div>
		
        <div class="row">
			<div class = "col-6">
			<div class="form-label-group">
				
				<input type="text" id="duration" name="duration" class="form-control" placeholder="eg. 3 year">
				<label for="duration">Duration</label>
				<span id="errorDuration" class="error"></span>
				</div>
			</div>
			<div class = "col-6">
			<div class="form-label-group">
				
                <input type="text" id="inputFee" name="fee" class="form-control" placeholder="Cource Fee">
                <label for="inputFee">Total Fee</label>
				<span id="errorFee" class="error"></span>
				</div>
			</div>
		</div>
		<div class="row">
        <div class="col-6">
            <label for="closingDate">Closing Date</label>
            <input type="date" name="closingDate" id="closingDate" class="form-control">
            <span id="errorDate" class="error"></span>

        </div>
		<div class="col-6">
			<label>Upload image for the programme</label><br>
			<input type="file" name="uploadImage">
		</div>
		</div>
		
        <div class="form-label-group">
		<br>
          <textarea id="inputDescription" class="form-control" name="description" rows="8" cols="80" placeholder="Programme Description"></textarea>
          <span id="errorDescription" class="error"></span>
        </div>
		
		
		
		<div>
			<br>
			<h6>Entry Requirement for each qualification</h6>
			<table class="table">
			<?php
                if($qualification->num_rows > 0){
                    while($row = $qualification->fetch_assoc()){
						echo "<tr>";
						echo "<td>".$row["qualificationName"]."</td>";
						echo "<td>";
						echo "<div class='form-label-group'>";
						echo "<input type='text'  id = '".$row['qualificationID']."' name='".$row['qualificationID']."' class='form-control' placeholder='Score'>";
						echo "<label for='score'>Score</label>";
						echo "</div>";
						echo "</td>";
						echo "</tr>";                                                 
                    }
                }
			?>
										
			</table>
		</div>
		<span class="error" id="errorMessage"></span>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Add Programme</button>
      </form>
      </div>




    </main><!-- /.container -->
	<script>
	var errorMessage = document.getElementById('errorMessage');
	function checkScore(){
	<?php
	
	$countEntry = 0;
	$getQualification = "SELECT qualificationID,qualificationName from qualification";
	$qualification = $conn->query($getQualification);
	if($qualification->num_rows > 0){
	while($row = $qualification->fetch_assoc()){
		$qID = $row["qualificationID"];
		echo "var entry".$countEntry." = document.getElementById('$qID');";	
		echo "if(entry".$countEntry.".value==''){errorMessage.innerHTML = 'Please enter entry score for all qualification';";
		echo "entry".$countEntry.".focus(); return false;}";
		
		$countEntry++;
	}
	}
	echo "else{return true;}";
	?>
	}
	</script>
    <script src="../js/addProgramme.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
