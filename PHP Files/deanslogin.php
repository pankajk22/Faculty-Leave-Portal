<html>
	<head>
		<title>FACULTY PORTAL</title>
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="index.css"> -->
	</head>
    <style>
    body {
    background-image: url('b.jpg');
    }

    
    ul {
  list-style-type: none;
  margin: 0;
  border:2px;
  padding: 0;
  width: 7%;
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
    </style> 
	<body>
	<div id="nav" >
				<ul>
					<li><a href="home.php">HOME</a></li>
					<li class ="active"><a href="login.php">LOGIN</a></li>   
				</ul>
	</div>
        <header style="margin-left:7%;padding:1px 16px;height:10px;color:#7a939c;">
            <h1 style=background-color:black>Dean-PORTAL</h1>
        </header>
		<div class="container" style="margin-top:5%;margin-left:7%;padding:1px 16px;height:300px;background-color:#7a939c;" >
			<p><h3>
                <?php
                    $user= 'root';
                    $pass='';
                    $db='Faculty';
                
                    $conn=new mysqli('localhost',$user,$pass,$db);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 
                    
                    If(session_status()==PHP_SESSION_NONE)
                    {
                        session_start();
                    }
                    $uname=$_SESSION["uname"];
                    $sql5="SELECT have_app from faculty where id='$uname'";
                    $result5=mysqli_query($conn,$sql5);
                    $row5=mysqli_fetch_assoc($result5);
                    $have_app=$row5["have_app"];
                    if($have_app>1)
                    {
                        $sqla="SELECT * FROM application_log where application_id='$have_app'";
                        $resulta=mysqli_query($conn,$sqla);
                        $rowa=mysqli_fetch_assoc($resulta);
                        echo "DEAR APPLICANT DEATAILS OF YOUR LEAVE APPLICATION-<br>";
                        echo "Your Applications has been ".$rowa["log_status"]."<br>";
                        echo "Application-Id - ".$rowa["application_id"]."<br>";
                        echo "Signed By - ".$rowa["signer_id"]."<br>";
                        echo "Post Who Signed on Your Post - ".$rowa["signer_post"]."<br>";
                        $sql14="UPDATE faculty SET have_app=0 WHERE id='$uname'";
                        $conn->query($sql14);

                    }
                    
                    $sql="SELECT id, f_name, email, department, post, leavescount, nextyearleaves, have_app from faculty where id='$uname'";
                    $result=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_assoc($result);

                    echo "DEAN-ID : ".$row["id"]."<br>";
                    echo "DEAN-Name : ".$row["f_name"]."<br>";
                    echo "E-Mail : ".$row["email"]."<br>";
                    //echo "Department : ".$row["department"]."<br>";
                    echo "Leaves Count : ".$row["leavescount"]."<br>";
                    echo "Leaves Count next year: ".$row["nextyearleaves"]."<br>";
                    echo "Application In-Transit : ".$row["have_app"]."<br>";
                    $asql="SELECT current_status from leave_application where applicant_id='$uname'";
                    $resulti = $conn->query($asql);
                    
                    
                    

                ?><h3>
                </p>
            <button  class="button button1" onclick="window.location.href='deanapp.php';">List Of Pending Applications</button>
            <button class="button button1" onclick="window.location.href = 'application.php';">Apply For Application</button>
            <button class="button button1" onclick="window.location.href = 'reviewby.php';">REVIEW YOUR PENDING APPLICATION</button>
            <!-- <button onclick="window.location.href = 'home.php';">HOME</button> -->
				
		</div>
		
		
	</body>
</html>