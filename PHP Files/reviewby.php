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
input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

input[type=text]:focus {
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
					<li><a href = 'home.php'>HOME</a></li>
					<li class ="active"><a href="login.php">LOGIN</a></li>   
				</ul>
	    </div>
<div class="container" style="margin-top:5%;margin-left:10%;padding:1px 16px;height:100%;background-color:#7a939c;">
<section>


<?php
    session_start();
$user= 'root';
$pass='';
$db='Faculty';

$conn=new mysqli('localhost',$user,$pass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
   
    $uname=$_SESSION["uname"];
    echo"<h2>USER - $uname <br></h2>";
    $sql5="SELECT post from faculty where id='$uname'";
    $result5=mysqli_query($conn,$sql5);
    $row5=mysqli_fetch_assoc($result5);
    $applicant_post=$row5["post"];
    $asql="SELECT current_status,leave_id from leave_application where applicant_id='$uname'";
    $resulti = $conn->query($asql);
    //echo "result:".$resulti;
    if ($resulti->num_rows> 0)
    {
        $irow=mysqli_fetch_assoc($resulti);
        echo "<h2>Current Application Status : ".$irow["current_status"]."<br></h2>";
        echo "<h3>COMMENTS ON YOUR APPLICATIONS!!!<br></h3>";
        $app_id=$irow["leave_id"];
        $csql="SELECT * FROM comments WHERE app_id='$app_id'";
        $resultc = $conn->query($csql);
        while($rowc = $resultc->fetch_array())
                        {
                            echo "<h4>COMMENT - ".$rowc["comment"]." BY - ".$rowc["by_whom"]." TIME - ".$rowc["comment_time"]."<br></h4>";
                        }
        echo"
        <form action='forward.php' method='post'>
		<input type='text' name='Comment' placeholder='Add comment'>
        <input type='submit' value='FORWARD'/>
        </form>
        ";
        
    }
    else
    {
        echo"<h2>NO APPLICATION FOUND !!!<br></h2>";

    }
?>

    <button class='button button1'><a href=
    <?php 
        $dir="director";
        $dean="dean";
        $adean="associate_dean";
        $hod="hod";
        if(strcmp($applicant_post,$dir)==0)
        {
            echo "directorlogin.php";    
        }
        else if(strcmp($applicant_post,$dean)==0)
        {
            echo "deanslogin.php";  
        }
        else if(strcmp($applicant_post,$adean)==0)
        {
            echo "adeanslogin.php";  
        }
        else if(strcmp($applicant_post,$hod)==0)
        {
            echo "hodlogin.php";   
        }
        else
        {
            echo "profile.php";
        }
    ?>
    >Profile
    </a></button>
    </section>
    </div>
</body>
</html>
    
