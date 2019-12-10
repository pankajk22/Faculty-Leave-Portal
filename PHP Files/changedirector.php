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
        <h1 style=background-color:black>DB-Admin Portal</h1>
        </header>
        <div id="nav" >
				<ul>
					<li><a href = 'home.php'>HOME</a></li>
					<li class ="active"><a href="DBadmin.php">DB-Admin</a></li>   
				</ul>
	    </div>

    <div class="container" style="margin-top:5%;margin-left:10%;padding:1px 16px;height:100%;background-color:#7a939c;">
    <section>



<?php
$user= 'root';
$pass='';
$db='Faculty';  
$conn=new mysqli('localhost',$user,$pass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
    if($_POST["director_id"]!="")       //change director
    {
        echo "change director<br>";
        $d_id=$_POST["director_id"];
        $jd=$_POST["join_date_director"];
        $ed="";

        $sql1="SELECT f_name,email FROM faculty WHERE id='$d_id'";
        $result=mysqli_query($conn,$sql1);
        if(mysqli_num_rows($result)==0)
        {
            echo "<h3>No faculty with the existing id</h3>";     //error check
            echo"
            <button class='button button1'><a href ='home.php'> Home</a></button>";
            exit();
        }
        $row=mysqli_fetch_assoc($result);
        $name=$row["f_name"]; 
        $email=$row["email"];

        $ed="";
        $sql="SELECT * FROM director where end_date='$ed'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==0)
        {
            echo "<h3>No Director<br></h3>";
            $sql2="INSERT INTO director (d_id,d_name,email,join_date,end_date)
                    VALUES('$d_id','$name','$email','$jd','$ed')";
            mysqli_query($conn,$sql2);
            $post="director";
            $sql3="UPDATE faculty SET post='$post' WHERE id='$d_id'";
            $conn->query($sql3);
            echo "<h3>Director added<br></h3>";
        }
        else
        {
            $sql5="SELECT d_id FROM director WHERE end_date='$ed'";
            $result=mysqli_query($conn,$sql5);
            $row=mysqli_fetch_assoc($result);
            $id=$row["d_id"];

            if($id==$d_id)      //already at the post of director
            {
                echo "<h3>Already at the post of director!!<br></h3>";
                
            }
            else
            {
            $post="employee";
            $sql6="UPDATE faculty SET post='$post' WHERE id='$id'";
            $conn->query($sql6);

            $sql4="UPDATE director SET end_date='$jd' WHERE end_date='$ed'";
            $conn->query($sql4);

            $sql2="INSERT INTO director (d_id,d_name,email,join_date,end_date)
                    VALUES('$d_id','$name','$email','$jd','$ed')";
            mysqli_query($conn,$sql2);

            $post="director";
            $sql3="UPDATE faculty SET post='$post' WHERE id='$d_id'";
            $conn->query($sql3);

            echo "<h2>director changed<br></h2>";}
        }
    }
?>
</section>
    </div>
</body>
</html>

