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
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="navbar.css">
    <title>Log I</title>
    <link rel="icon" href="img/contextmenu/4.jpg" type="image/x-xicon">
</head>

<body>
    <!--this page is the page after login-->
<!--self made navigation bar-->
    <div id="Topnav" class="topnav ">
        
        <a id ="floatright" href="javascript:void(0);" class="hamburger" onclick="popNaviUp()">&#9776;</a>    
        <a href="../html/qualificationList.html">Maintain Qualification</a>
        <a href="../html/addProgrammeList.html">Add Programme</a>
        <a href="../html/addUniversityList.html">Add Universities</a>
        <a href="../html/reviewApplication.html">Review Applications</a>
        <div class="dropdown">
            <button class="dropselection">Applicant See here</button>
            <div class="dropdown-item">
                <a href="../html/programmeList.html">Programme </a>
                <a href="../html/programmeList.html">Programme List</a>
            </div>
        </div>
        <div class="logout">
        <a href="index.html" >Log out</a>
    </div>
    </div>
    <script type="text/javascript">
        function popNaviUp(){
            //add on a class name to be responsive on screen size
            //refer to CSS
            var nav = document.getElementById("Topnav");
            var icon = document.getElementById("floatright");
        if(nav.className === "topnav"){
            nav.className += " smallscrn";
            //change icon
            icon.innerHTML = "&times;";
            icon.style.fontSize ="44";
            icon.style.textDecoration = "bold";
        }
        else{
            nav.className = "topnav" ;
            icon.innerHTML = "&#9776;";
            icon.style.fontSize ="17";
        }}</script>
        <!--self made navigation bar-->
        
    
<!--welcome message-->
    <div class="header">
        <h1>Welcome, <?php $_SESSION['loginuser']?></h1>
        <br>
        <p><?php $_SESSION['loginuser']?><b>applicantID</b></p>
    </div>
<!--welcome message-->
<!--content body-->
<?php
$application = "SELECT * FROM Application WHERE applicant ='". $_SESSION['loginuser']."';";
if($numrows = $conn ->query($application) === TRUE){
if ($numrows ->num_rows > 0){
    while($appli = $numrows -> fetch_assoc()){
        echo "application " . $appli['applicationID'] . " - applicationDate - ".$appli['applicationDate']." - applicantSTATUS - " . $appli['applicationStatus'] . " - applicant - ". $appli['applicant']. " - progID - " . $appli['progID'];
    }
}
    
}

else{   
    echo "<div class='content'>";
// Yale University Part-->
            echo "<div class='yale'>";
            echo "<a href='../html/programmeList.html'>";
            echo"    <img src='img/Yale/Campus=committee.jpg' alt='Yale'>";
                echo"<br><br>";
               echo" <h2>Yale</h2>";
              echo  "<div class='Yalecontent'>";
                echo"<p>Even before our nation’s founders immortalized their eloquent vision of life, liberty, and the pursuit of happiness, Yale College was instilling similar values in its students. Since our founding in 1701, generations of undergraduates have sought education and enlightenment at Yale in a dedicated pursuit of knowledge and leadership skills.</p></div>";
                echo"<div class='YaleReadMe'>";
                echo"<p >please click me</p>";
            echo "</div></a></div>";
//ANU University Part-->
            echo"<div class='anu'>";
                echo"<a href='../html/programmeList.html'>";

                echo"<img src='img/ANU/ANU_Campus_Aerial.jpg' alt='AustralianNationalUniversity'>";
                echo"<br><br>";
                echo"<h2>Australian National University</h2><br>";
                echo"<div class='Anu-wrapup'>";
                     echo"<p>ANU is privileged to have hosted a number of Nobel Laureates whose ground-breaking research has increased our understanding of our world, and improved it for the better.</p>";
                echo"<br></div>";
                echo"<div class='anuReadMore'>";
                echo"<p href='../html/programmeList.html'>READ MORE >></p>";
            echo"</div>";
            echo"</a></div>";
// Australia Monash University Part-->
            echo"<div class='monash'>";
                echo"<a href='../html/programmeList.html'>";
                echo"<img src='img/monash-png.png' alt='monash'>";
                echo"<br>";
                echo"<h2>One of the top University in Australia</h2>";
                echo"<br>";
                echo"<p>For sixty years our work has changed the world.";
                echo"        But this is only the beginning. Now it's over to you. ";
                echo"        Because we’re not asking you, we’re telling you:</p> ";
                echo"        <div class='monashRdM'> ";
                echo"        <p>IF YOU DON’T LIKE IT, CHANGE IT.</p></div></a>";
            echo"</div>";



        //Australia Western University Part-->
            echo"<div class='western'>";
                echo"<a href='../html/programmeList.html'>";
                echo"<img src='img/Western/UWA4coastWhy.jpg' alt='UniversityofWesternAustralian'><br><br>";
                echo"<h2>University of Western Australian</h2><br>";
                echo"<div class='western-contain'>";
                echo"<p style='color:grey'>Government School in Western Australian</p><br><br>";
                echo"<p>Over the years the University has acquired an international reputation for excellence and enterprise. It is regarded as one of Australia's top research institutions, attracting researchers of world standing across the range of disciplines, with international leaders in many diverse fields.";
                    echo"In 2018, the University sits at 93 on the Academic Ranking of World Universities produced by Shanghai Jiao Tong University. Having achieved our aim of being in the top 100 by our centenary, we are now striving to be considered a top 50 university by 2050.";
                echo"</p><br></div>";
                echo"<div class='westernRdM'>";
                echo"<p href='../html/programmeList.html'>READ MORE >></p></div>";
            </a>

            </div>
<!--Tokyo U >Part-->
            <div class="tokyo">
                <a href="/EasyEnroll210/html/programmeList.html">
                <img src="img/University-Tokyo.png" alt="UniversityTokyo">
                <br><br>
                <h2>東京大學</h2><br>
                <p style="color:grey"> University Tokyo</p>
                <br><div class="tokyo-content">
                <p>
                  The University of Tokyo aims to be a world-class platform for research and education, contributing to human knowledge in partnership with other leading global universities. The University of Tokyo aims to nurture global leaders with a strong sense of public responsibility and a pioneering spirit, possessing both deep specialism and broad knowledge. The University of Tokyo aims to expand the boundaries of human knowledge in partnership with society. Details about how the University is carrying out this mission can be found in the University of Tokyo Charter and the Action Plans.                </p>
                <br>
                <p>
                    独立行政法人等の保有する情報の公開に関する法律(平成13年12月5日法律第140号。以下「情報公開法」という。)に基づき、東京大学(以下「本学」という。)の保有する情報の一層の公開を図り、もって本学の有するその諸活動を国民に説明する責務を全うするため、国民のみなさまに法人文書を開示する制度です。
                    情報公開法では、開示請求があったときは本学の総長は、不開示情報が記録されている場合を除き、法人文書を開示しなければならないこととされています。
                </p></div>
</a>
            </div>

        

    </div>
}?>
    <footer>
        <p>Powered by Abdul Qayoom</p>
    </footer>

</body>

</html>
