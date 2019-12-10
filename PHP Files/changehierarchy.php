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
    $post_from=$_POST["post_from"];
    $post_to=$_POST["post_to"];
    $post_approval=$_POST["post_approval"];
    
    $sql="SELECT * FROM hierarchy WHERE post_from='$post_from'";
    $resulti = $conn->query($sql);
    if ($resulti->num_rows> 0)//update
    {
        $sql1="UPDATE hierarchy SET post_from='$post_from',post_to='$post_to',post_approval='$post_approval' WHERE post_from='$post_from'";
        $conn->query($sql1);
        echo "<h2>Already have Hierarchy ---> Updated<br></h2>";
    }
    else    //insert
    {
        $sql2 = "INSERT INTO hierarchy (post_from,post_to,post_approval) VALUES('$post_from','$post_to','$post_approval')";
        mysqli_query($conn,$sql2);
        echo "<h2>Hierarchy Inserted!!!<br></h2>";
    }


?>
?>

</section>
    </div>
</body>
</html>
