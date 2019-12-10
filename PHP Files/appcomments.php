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
        <h1 style=background-color:black> Comments on Leave:</h1>
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
            
            $uname=$_SESSION["uname"];

            $user= 'root';
            $pass='';
            $db='Faculty';
            $conn=new mysqli('localhost',$user,$pass,$db);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $dir="director";
            $dean="dean";
            $adean="associate_dean";
            $hod="hod";
            $sql1="SELECT post from faculty where id='$uname'"; 
            $result=mysqli_query($conn,$sql1);
            $row=mysqli_fetch_assoc($result);
            if(strcmp($row["post"],$dir)==0)
            {
                $path="directorlogin.php";
                $path1="directorapp.php";    
            }
            else if(strcmp($row["post"],$dean)==0)
            {
                $path="deanslogin.php"; 
                $path1="deanapp.php"; 
            }
            else if(strcmp($row["post"],$adean)==0)
            {
                $path="adeanslogin.php"; 
                $path1="adeanapp.php"; 
            }
            else if(strcmp($row["post"],$hod)==0)
            {
                $path="hodlogin.php";   
                $path1="hodapp.php";
            }
            
            
            
            
            $leave_id=$_GET["leave_id"];
            $sql="SELECT * FROM comments where app_id='$leave_id'";
            $result=mysqli_query($conn,$sql);
            if($result->num_rows==0)
            {
                echo "NO COMMENTS ON APPLICATIONS <br>";
                
            }
            else
            {
                while($row = $result->fetch_array())
                {
                    echo "COMMENT - ".$row["comment"]." BY - ".$row["by_whom"]." TIME - ".$row["comment_time"]."<br>";
                }
            }
            echo "
            <button class='button button1'><a href='$path'>Portal </a></button>
            <button class='button button1'><a href='$path1'>Pending Leaves </a></button>";

        ?>
        </section>
        </div>
        
    <body>
</html>