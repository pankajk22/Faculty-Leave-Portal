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
        <h1 style=background-color:black>Guest Portal</h1>
        </header>
        <div id="nav" >
				<ul>
					<li><a href = 'home.php'>HOME</a></li>
					<li class ="active"><a href="guest.php">GUEST</a></li>   
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
    if($_POST["show"]=="faculty")     //display faculty
    {
        $sql="SELECT * FROM faculty";
        $result=mysqli_query($conn,$sql);
        echo "<h3>Faculties:</h3>";
        // while($row = $result->fetch_array())
        // {
        //     echo "ID: ".$row["id"]." NAME: ".$row["f_name"]." EMAIL: ".$row["email"]." DEPT: ".$row["department"]." POST: ".$row["post"]."<br>";
        // }  
        echo "
        <button class='button button1'><a href=cse.php>CSE</a></button>
        <button class='button button1'><a href=ee.php>ELECTRICAL</a></button>
        <button class='button button1'><a href=mech.php>MECHANICAL</a></button>
        "; 
    }
?>

    

<?php
    if($_POST["show"]=="hod")     //display hods
    {
        $sql="SELECT * FROM hod";
        $result=mysqli_query($conn,$sql);
        echo "<h2>HODs:</h2>";
        while($row = $result->fetch_array())
        {
            echo "<h4>ID: ".$row["hod_id"]." NAME: ".$row["hod_name"]." EMAIL: ".$row["email"]." DEPT: ".$row["department"]." JOIN-DATE: ".$row["join_date"]." END-DATE: ".$row["end_date"]."<br></h4>";
        }       
    }
    if($_POST["show"]=="crosscutting")     //display crosscutting
    {
        $sql="SELECT * FROM crosscutting";
        $result=mysqli_query($conn,$sql);
        echo "<h2>DFAs and ADFAs:</h2>";
        while($row = $result->fetch_array())
        {
            echo "<h4>ID: ".$row["id"]." NAME: ".$row["cc_name"]." EMAIL: ".$row["email"]." POST: ".$row["post"]." JOIN-DATE: ".$row["join_date"]." END-DATE: ".$row["end_date"]."<br></h4>";
        }     
    }
    if($_POST["show"]=="director")     //display director
    {
        $sql="SELECT * FROM director";
        $result=mysqli_query($conn,$sql);
        echo "<h2>DIRECTORs:</h2>";
        while($row = $result->fetch_array())
        {
            echo "<h4>ID: ".$row["d_id"]." NAME: ".$row["d_name"]." EMAIL: ".$row["email"]." JOIN-DATE: ".$row["join_date"]." END-DATE: ".$row["end_date"]."<br></h4>";
        }       
    }
?>

</section>
    </div>
</body>
</html>