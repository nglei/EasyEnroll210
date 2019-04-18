<!--designed by Lim Kian Wei B1700814-->
<?php
session_start();
$_SESSION['servername'] = "localhost";
$_SESSION['username'] = "root";
$_SESSION['password'] = "";
$conn = new mysqli($_SESSION['servername'], $_SESSION['username'],$_SESSION['password']);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$uniName="";

$sqlUseDb = "USE easyenroll";
$sqlcreateTbl = "CREATE TABLE IF NOT EXISTS University (
    UniID VARCHAR(5) PRIMARY KEY DEFAULT '0' NOT NULL, UniName VARCHAR(55), adminUsername VARCHAR(50), foreign KEY (adminUsername) references user(username));";
    if($conn->query($sqlUseDb) === TRUE){
        echo "Use Database Successful";
    }
    else{
        echo "Error Using Database " . $conn->error;
    }
    if($conn->query($sqlcreateTbl)===TRUE){
        echo "Create Table Successfully";
    }
    else{
        echo "Error creating table " . $conn->error;
    }
    $sqlcreateuniIndexTbl = "CREATE TABLE IF NOT EXISTS UniIndexTable( id INT PRIMARY KEY NOT NULL AUTO_INCREMENT);";
    if ($conn->query($sqlcreateuniIndexTbl) === TRUE){
        echo "Create uniIndex Table successful";
    }
    else{
        echo "Error creating uniIndex table " . $conn->error;
    }
    $sqlcreatetriggeruninumindex = "CREATE TRIGGER uniIndex_trigger BEFORE INSERT ON University FOR EACH ROW BEGIN INSERT INTO UniIndexTable VALUES(NULL); SET NEW.UniID = CONCAT('U',IF(LAST_INSERT_ID()>999,LAST_INSERT_ID(),LPAD(LAST_INSERT_ID(),'3','0')));END ";
    
    if($conn ->query($sqlcreatetriggeruninumindex) === TRUE){
        echo "Create Trigger Successfully";
    }
    else{
        echo "Error Create Trigger" . $conn->error;
    }
    $duplicateusername="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $uniadminfull=$_POST['uniadminfullname'];
        $uniadminpassword=$_POST['uniadminpw'];
        $uniadminemail=$_POST['uniadminemail'];
        $uniadminusername=$_POST['uniadminusername'];
        if(isset($_POST['uniadminusername'])){
            $checkuserexist="SELECT username FROM user where username ='$uniadminusername';";
            $sameusername=$conn->query($checkuserexist);
            if($sameusername->num_rows>0){
                $duplicateusername="User exists. Please change a different username";
            }else{
                $recorduniadmin= "INSERT INTO USER VALUES('$uniadminusername','$uniadminpassword','$uniadminemail','$uniadminfull'); ";
                if($conn->query($recorduniadmin) === TRUE){
                    echo "Uni Admin Record Added Successfully";
                }
                else{
                     echo "Uni Admin Record: " . $conn->error;
                    }
                    /*University Register*/
                    $uniName = $_POST['uniName'];
                    $insertUni = "Insert into University (UniName,adminUsername) VALUES('$uniName','$uniadminusername');";
                    if($conn->query($insertUni) === TRUE){
                         echo "Data added successfully";
                        }
                        else{
                            echo "Error entering data " . $conn->error;
                        }
                    }
                }
        
        $conn->close();
		header('location:addUniversityList.php');
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/topcover.css">
      <link rel="stylesheet" type="text/css" href="../css/form.css">
    <title>Add Univeristy</title>
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="sasadminLogin.php">EasyEnroll</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="sasadminLogin.php">Home</a>
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
                       <h1 class="page-title">Add University</h1>
                       <ul>
                           <li>
                               <a class="active" href="sasadminLogin.php">Home</a>
                           </li>
                           <li><a href="addUniversityList.php">University</a></li>
                           <li>Add University</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
    </div>
<?php
    
 ?>
    <main role="main" class="container">
      <div class="application">


      <form class="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validation()">
        <div class="mb-4">
          <h3 class="h3 mb-3 font-weight-normal">New University</h3>
        </div>

        <div class="form-label-group">
          <input type="text" id="inputUniversity" name="uniName" class="form-control" placeholder="University Name"  autofocus>
          <span id="errorUni" class="error"></span>
          <label for="inputUniversity">University Name</label>
        </div>

        <div>
          <h3 class="h3 mb-3 font-weight-normal">University Admin Account Details</h3>
        </div>

        <div class="form-label-group">
          <input type="text" id="inputUsername" name="uniadminusername" class="form-control" placeholder="Username">
          <span id="errorUsername" class="error"><?php echo($duplicateusername)?></span>
          <label for="inputUsername">Username</label>
        </div>

        <div class="form-label-group">
          <input type="password" id="inputPassword" name ="uniadminpw" class="form-control" placeholder="Password" >
          <span id="errorPassword" class="error"></span>
          <label for="inputPassword">Password</label>
        </div>

        <div class="form-label-group">
          <input type="text" id="inputName" class="form-control" name="uniadminfullname" placeholder="Full Name">
          <span id="errorName" class="error"></span>
          <label for="inputName">Full Name</label>
        </div>

        <div class="form-label-group">
          <input type="email" id="inputEmail" class="form-control" name="uniadminemail" placeholder="Email Address">
          <span id="errorEmail" class="error"></span>
          <label for="inputEmail">Email Address</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Add University</button>
      </form>
      </div>




    </main><!-- /.container -->
    <script src="../js/addUniversity.js">

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
