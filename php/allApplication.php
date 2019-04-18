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
$_SESSION['programme'] = $_GET['pID'];}	
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/list.css  ">
      <link rel="stylesheet" type="text/css" href="../css/topcover.css">
      <link rel="stylesheet" type="text/css" href="../css/applyProgramme.css">
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
                           <li>Application List</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
    </div>

    <!--main role="main" class="container"-->
    <div class="container">

<div class="application">
      <div>
        <h1>All Application</h1>
      </div>

      <div>
        <table id= "application" class="table">
		<thead>
			<tr>
				<td>Applicant's Name</td>
				<td>Qualification Obtained</td>
				<td>Overall Score</td>
				<td>Status</td>
			</tr>
		</thead>
		<tbody>
		<?php
			$getApplication = "select * from application,user where user.username = application.applicant and application.progID =".$_GET['pID']." order by applicationStatus asc";
			$result = $conn->query($getApplication);
			if($result->num_rows >0){
				while($row = $result->fetch_assoc()){					
					echo  "<tr onclick='location.href=\"reviewApplication.php?aID=".$row['applicationID']."\";'>";
					echo "<td class='td-30'>".$row['name']."</td>";
					$getQualification = "select * from qualificationobtained,qualification where qualification.qualificationID=qualificationobtained.qualificationID and username='".$row['applicant']."'";
					$getResult = $conn->query($getQualification);
					if($getResult->num_rows > 0){
						while($qualification = $getResult->fetch_assoc()){
							echo "<td class='td-45'>".$qualification["qualificationName"]."</td>";
							echo "<td class='td-10'>".$qualification['overallScore']."</td>";
						}
					}
					if($row['applicationStatus']=="Successful"){
						echo "<td class='td-15'><div class='green'>".$row['applicationStatus']."</div></td>";
					}else if($row['applicationStatus']=="New"){
						echo "<td class='td-15'><div>".$row['applicationStatus']."</div></td>";
					}else{
						echo "<td class='td-15'><div class='red'>".$row['applicationStatus']."</div></td>";
					}										
					echo "</tr>";						
				}
			}else{
				echo "<tr><td colspan='4'>No Application at the moment</td></tr>";
			}
			?>
		</tbody>

        </table>
		</div>
		<div class="mb-30 text-center">
			<input type="button" name="back" class="btn btn-primary btn-sm" onclick="location.href = 'applicationList.php';" value="Back">
		</div>
</div>

</div>




    <!--/main>< /.container -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
