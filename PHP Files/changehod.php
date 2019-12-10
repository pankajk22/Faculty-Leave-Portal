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
    if($_POST["hod_id"]!="")       //change hod
    {
        echo "change hod<br>";
        $d_id=$_POST["hod_id"];
        $jd=$_POST["join_date_hod"];
        $dept=$_POST["dept"];
        $ed="";

        $sql1="SELECT f_name,email,department FROM faculty WHERE id='$d_id'";
        $result=mysqli_query($conn,$sql1);
        if(mysqli_num_rows($result)==0)
        {
            echo "No existing faculty with this id";     //error check
            echo "
            <button  class='button button1' onclick='goBack()'>DB-admin Portal</button>

            <script>
            function goBack() {
            window.history.go(-1);
            }
            </script>
            ";
            echo "<button  class='button button1'><a href='home.php'>Home </a></button>";
        }
        $row=mysqli_fetch_assoc($result);
        $name=$row["f_name"]; 
        $email=$row["email"];
        $f_dept=$row["department"];

        if($dept!=$f_dept)
        {
            echo "faculty doesn't belong to ".$dept."<br>";
            
            echo "
            <button  class='button button1' onclick='goBack()'>DB-admin Portal</button>

            <script>
            function goBack() {
            window.history.go(-1);
            }
            </script>
            ";
            echo "<button  class='button button1'><a href='home.php'>Home </a></button>";
        }

        $ed="";
        $sql="SELECT * FROM hod WHERE department='$dept' and end_date='$ed'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==0)
        {
            echo "no hod of this department<br>";
            $sql2="INSERT INTO hod (hod_id,hod_name,email,department,join_date,end_date)
                    VALUES('$d_id','$name','$email','$dept','$jd','$ed')";
            mysqli_query($conn,$sql2);
            $post="hod";
            $sql3="UPDATE faculty SET post='$post' WHERE id='$d_id'";
            $conn->query($sql3);
            echo "hod added<br>";
            echo "
            <button  class='button button1' onclick='goBack()'>DB-admin Portal</button>

            <script>
            function goBack() {
            window.history.go(-1);
            }
            </script>
            ";
            echo "<button  class='button button1'><a href='home.php'>Home </a></button>";
        }
        else
        {
            $sql5="SELECT hod_id FROM hod WHERE department='$dept' and end_date='$ed'";
            $result=mysqli_query($conn,$sql5);
            $row=mysqli_fetch_assoc($result);
            $id=$row["hod_id"];

            if($id==$d_id)      //already at the post of hod
            {
                echo "already at the post of hod!!<br>";
                echo "
                <button class='button button1'onclick='goBack()'>DB-admin Portal</button>

                <script>
                function goBack() {
                window.history.back();
                }
                </script>
                ";
                echo "<button  class='button button1'><a href='home.php'>Home </a></button>";
            }

            $post="employee";
            $sql6="UPDATE faculty SET post='$post' WHERE id='$id'";
            $conn->query($sql6);

            $sql4="UPDATE hod SET end_date='$jd' WHERE department='$dept' and end_date='$ed'";
            $conn->query($sql4);

            $sql2="INSERT INTO hod (hod_id,hod_name,email,department,join_date,end_date)
                    VALUES('$d_id','$name','$email','$dept','$jd','$ed')";
            mysqli_query($conn,$sql2);

            $post="hod";
            $sql3="UPDATE faculty SET post='$post' WHERE id='$d_id'";
            $conn->query($sql3);

            echo "hod changed<br>";
            echo "
            <button class='button button1'onclick='goBack()'>DB-admin Portal</button>

            <script>
            function goBack() {
            window.history.back(); 
            }
            </script>
            ";
            echo "<button class='button button1'><a href='home.php'>Home </a></button>";
        }
    }
?>
</section>
    </div>
</body>
</html>
