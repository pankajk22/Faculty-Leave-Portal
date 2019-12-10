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
        <h1 style=background-color:black>DB-Admin Portal</h1>
        </header>
        <div id="nav" >
				<ul>
					<li><a href = 'home.php'>HOME</a></li>
					<li class ="active"><a href="DBadmin.php">DB-Admin</a></li>   
				</ul>
	    </div>
<div class="container" style="margin-top:5%;margin-left:10%;padding:1px 16px;background-color:#7a939c;">
<section>





<?php
$user= 'root';
$pass='';
$db='Faculty';  
$conn=new mysqli('localhost',$user,$pass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $pass="administheking";
    if($_POST["Password"]!=$pass)
    {
        echo "<script>alert('INCORRECT PASSWORD!!')</script>";
        include("DBadmin.php");
        
    }
?>

    
    <?php
        echo "<h2>ADMIN PORTAL</h2>";
    ?>
    <form action="resetsystem.php" method="POST">
        <input type="submit" value="RESET LEAVES">
    </form>
    <?php
        
        $sql="SELECT * FROM hierarchy";
        $result=mysqli_query($conn,$sql);
        echo "<h2> CURRENT HIERARCHY : </h2>";
        while($row=$result->fetch_array())
        {
            echo "<h3>".$row["post_from"]." -> ". $row["post_to"]."<br></h3>";
        }
    
        echo "<h2>APPROVAL POST</h2>";
        $result=mysqli_query($conn,$sql);
        while($row=$result->fetch_array())
        {
            echo "<h3>".$row["post_from"]."  BY  ". $row["post_approval"]."<br></h3>";
        }
        echo "<br>";
    ?>
    <h4>CHANGE HIERARCHY</h4>
    <form action="changehierarchy.php" method="POST">
        <input type="text" name="post_from" id="post_from" value="" placeholder="post from" required>
        <input type="text" name="post_to" id="post_to" value="" placeholder="post to" required>
        <input type="text" name="post_approval" id="post_approval" value="" placeholder="post approval" required>
        <input type="submit" value="Change hierarchy">
    </form>
    <h4> DELETE POST<h4>
    <form action="deletehierarchy.php" method="POST">
        <input type="text" name="post" id="post_from" value="" placeholder="Delete post from hierarchy" required >
        <input type="submit" value="Delete Post">
    </form> 
    <h4>DELETE FACULTY</h4>
    <form action="deletefaculty.php" method="POST">
        <input type="text" name="id" id="id" value="" placeholder="id" required>
        <input type="submit" value="Delete Faculty">
    </form>

    <?php
        echo "<h3>CURRENT DIRECTOR</h3>";
        $end_date="";
        $sql="SELECT * FROM director WHERE end_date='$end_date'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        echo "<h3>ID: ".$row["d_id"]." NAME: ".$row["d_name"]." E-MAIL: ".$row["email"]." FROM: ".$row["join_date"]."<br></h3>";
        echo "<br>";
    ?>
    <form action="changedirector.php" method="POST">
        <input type="text" name="director_id" id="director_id" value="" placeholder="id" required>
        <input type="text" name="join_date_director" id="join_date_director" value="" placeholder="join date" required>
        <input type="submit" value="Change Director">
    </form>
    <?php
        echo "<h3>CURRENT DFA</h3>";
        $end_date="";
        $post="dean";
        $sql="SELECT * FROM crosscutting WHERE end_date='$end_date' and post='$post'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        echo "<h3>ID: ".$row["id"]." NAME: ".$row["cc_name"]." E-MAIL: ".$row["email"]." FROM: ".$row["join_date"]."<br></h3>";
        echo "<br>";
    ?>
    <form action="changedfa.php" method="POST">
        <input type="text" name="DFA_id" id="DFA_id" value="" placeholder="id" required>
        <input type="text" name="join_date_DFA" id="join_date_DFA" value="" placeholder="join date" required>
        <input type="submit" value="Change DFA">
    </form>
    <?php
        echo "<h3>CURRENT ASSOCIATE DFA</h3>";
        $end_date="";
        $post="associate_dean";
        $sql="SELECT * FROM crosscutting WHERE end_date='$end_date' and post='$post'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        echo "<h3>ID: ".$row["id"]." NAME: ".$row["cc_name"]." E-MAIL: ".$row["email"]." FROM: ".$row["join_date"]."<br></h3>";
        echo "<br>";
    ?>
    <form action="changeadfa.php" method="POST">
        <input type="text" name="ADFA_id" id="ADFA_id" value="" placeholder="id" required>
        <input type="text" name="join_date_ADFA" id="join_date_ADFA" value="" placeholder="join date" required>
        <input type="submit" value="Change ASSOCIATE DFA">
    </form>
    <?php
        echo "<h3>CURRENT HODs</h3>";
        $end_date="";
        $sql="SELECT * FROM hod WHERE end_date='$end_date'";
        $result=mysqli_query($conn,$sql);
        while($row=$result->fetch_array())
        {
            echo "<h3>ID: ".$row["hod_id"]." NAME: ".$row["hod_name"]." E-MAIL: ".$row["email"]." DEPARTMENT: ".$row["department"]." FROM: ".$row["join_date"]."<br></h3>";
        }
        echo "<br>";
    ?>
    <form action="changehod.php" method="POST">
        <input type="text" name="hod_id" id="hod_id" value="" placeholder="id" required>
        <input type="text" name="dept" id="dept" value="" placeholder="department" required>
        <input type="text" name="join_date_hod" id="join_date_hod" value="" placeholder="join date" required>
        <input type="submit" value="Change HOD">
    </form>

    


    </section>
    </div>
</body>
</html>