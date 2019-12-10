<html>
<style>
    body {
    background-image: url('b.jpg');
    }

    
    ul {
  list-style-type: none;
  margin: 0;
  border:2px;
  padding: 0;
  width: 10%;
  background-color: #7a939c;
  position: fixed;
  height: 100%;
  overflow: auto;
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

li a.active {
  background-color: #4CAF50;
  color: #008000;
}

li a:hover:not(.active) {
  background-color: #555;
  color: white;
}
.button {
  background-color: black; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: #7a939c; 
  color: black; 
  border: 2px solid black;
}

.button1:hover {
  background-color: white;
  color: #7a939c;
}
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
input[type=number] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

input[type=number]:focus {
  border: 3px solid #555;
}
select {
  width: 100%;
  padding: 16px 20px;
  border: none;
  border-radius: 4px;
  background-color: #f1f1f1;
}
input[type=button], input[type=submit], input[type=reset] {
  background-color: black;
  border: 2;
  border-color:black;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
    </style> 

<body>
<header style="margin-left:10%;padding:1px 16px;height:10px;color:#7a939c;">
        <h1 style=background-color:black>Application Portal</h1>
        </header>
        <div id="nav" >
				<ul>
					<!-- <li><a href = 'home.php'>HOME</a></li> -->
					<!-- <li class ="active"><a href="login.php">LOGIN</a></li>    -->
				</ul>
	    </div>
<div class="container" style="margin-top:5%;margin-left:10%;padding:1px 16px;width:100%;height:100%;background-color:#7a939c;">
<section>



<?php
echo"<h2>HELLO APPLICANT!!</h2>";
    session_start();
    $user= 'root';
    $pass='';
    $db='Faculty';

    $conn=new mysqli('localhost',$user,$pass,$db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $uname=$_SESSION["uname"];
    $sql="SELECT have_app,post from faculty where id='$uname'"; 
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $dir="director";
    $dean="dean";
    $adean="associate_dean";
    $hod="hod";
    $applicant_post=$row["post"];
    if(strcmp($applicant_post,$dir)==0)
    {
        $path="directorlogin.php";    
    }
    else if(strcmp($applicant_post,$dean)==0)
    {
        $path= "deanslogin.php";  
    }
    else if(strcmp($applicant_post,$adean)==0)
    {
        $path="adeanslogin.php";  
    }
    else if(strcmp($applicant_post,$hod)==0)
    {
        $path= "hodlogin.php";   
    }
    else
    {
        $path= "profile.php";
    }
    if($row["have_app"]==1)
    {
        echo "<h2>Already have an application!! <br></h2>";
        echo "<button class='button button1'><a href='home.php'>Home </a></button>";
        echo "<button class='button button1'><a href='login.php'>LogIn </a></button>";
        echo "<button class='button button1'><a href='$path'>Profile </a></button>";
    }
    else
    {
        echo "initiated a new application!! <br>";
        include("app_info.php");
    }
?>

</section>
    </div>
</body>
</html>
