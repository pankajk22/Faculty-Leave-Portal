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
	<div id="nav">
				<ul>
					<li><a href="home.php">HOME</a></li>
					<li class ="active"><a href="login.php">LOGIN</a></li>   
				</ul>
	</div>
    <header style="margin-left:7%;padding:1px 16px;height:10px;color:#7a939c;">
            <h1 style=background-color:black>DIRECTOR-PORTAL</h1>
        </header>
        <div class="container" style="margin-top:5%;margin-left:7%;padding:1px 16px;height:300px;background-color:#7a939c;" >
        
                <p><h3><?php
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
                   
                    
                    $sql="SELECT id, f_name, email, department, post, leavescount, nextyearleaves, have_app from faculty where id='$uname'";
                    $result=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_assoc($result);

                    echo "DIRECTOR-ID : ".$row["id"]."<br>";
                    echo "DIRECTOR Name : ".$row["f_name"]."<br>";
                    echo "E-Mail : ".$row["email"]."<br>";
                ?>
                </h3></p>
            <button class="button button1" onclick="window.location.href='directorapp.php';">List Of Pending Applications</button>
            <button class="button button1" onclick="window.location.href = 'home.php';">HOME</button>
				
		</div>
		
		
	</body>
</html>