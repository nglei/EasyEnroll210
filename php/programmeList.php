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
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/form.css">
      <link rel="stylesheet" type="text/css" href="../css/list.css">
      <link rel="stylesheet" type="text/css" href="../css/topcover.css">
      <link rel="stylesheet" type="text/css" href="../css/programmeList.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Programme List</title>
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
                       <h1 class="page-title">Programme</h1>
                       <ul>
                           <li>
                               <a class="active" href="../main/home.php">Home</a>
                           </li>
                           <li>Programme</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
    </div>

    <!--main role="main" class="container"-->

      <div class="container">
          <!-- Example row of columns -->
		  <div class="content">
          <div class="row">
			
			
<?php
	$getProgramme = "SELECT * FROM programme";
	$programme = $conn->query($getProgramme);
	if($programme->num_rows > 0){
		while($row = $programme->fetch_assoc()){
			echo '<div class="col-12 col-lg-4">';
			echo '<div class="single-top-popular-course d-flex align-items-center flex-wrap mb-30 wow fadeInUp" data-wow-delay="400ms">';
			echo '<div class="progImg"><img src="'.$row['imgURL'].'"></div>';
			echo '<div class="popular-course-content">';
			echo '<h5>'.$row['programmeName'].'</h5>';
			$getUniID = "select * from university where UniID = '".$row['UniID']."'";
			$result = $conn->query($getUniID);
			if($result->num_rows == 1){
				while($uniid = $result->fetch_assoc()){
					echo '<span><i class="fa fa-map-marker"></i> '.$uniid['UniName'].'</span>';
				}
			}
			echo '<p><b>Duration: </b>'.$row['duration'].'</br>';
			echo '<b>Closing Date: </b>'.$row['closingDate'].'</br></p>';
			echo '<a href="coursedetail.php?pID='.$row['programmeID'].'" class="btn btn-success btn-sm">View Details</a>';
			echo '</div></div></div>';
		}
	}
?>			
				
				
          </div>

          <hr>

        </div>
		</div>



    <!--/main>< /.container -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
