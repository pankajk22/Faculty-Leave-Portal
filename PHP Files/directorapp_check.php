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
					<li class ="active"><a href="login.php">LOGIN</a></li>   
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
session_start(); 
    $leave_id=$_POST["leave_id"];
    $_SESSION["leave_id"]=$leave_id;
    $sql="SELECT applicant_post,applicant_id FROM leave_application WHERE leave_id='$leave_id'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $ap=$row["applicant_post"];
    $aid=$row["applicant_id"];
    echo "ap : ".$ap." aid : ".$aid."<br>";
    $uname=$_SESSION["uname"];
    $cmnt=$_POST["comment"];
    $sql3="SELECT post FROM faculty WHERE id='$uname'";
    $result=mysqli_query($conn,$sql3);
    $row=mysqli_fetch_assoc($result);
    $h=$row["post"];
    $d=$_POST["decision"];
    $cond=1;
    if($d=="Reject")
    {
        $cond=0;    
    }
    date_default_timezone_set("Asia/Calcutta");  
    $date=date("H:i:s Y-m-d");

    $sql2 = "INSERT INTO comments (app_id,comment,by_whom,accept,comment_time) VALUES('$leave_id','$cmnt','$h','$cond','$date')";
    mysqli_query($conn,$sql2);
    
    // $sql1 = "SELECT post_approval FROM hierarchy WHERE post_from='$ap'";
    // $result=mysqli_query($conn,$sql1);
    // $row=mysqli_fetch_assoc($result);
    // $app=$row["post_approval"];

    // $sql6 = "SELECT post_to FROM hierarchy WHERE post_from='$h'";
    // $result=mysqli_query($conn,$sql6);
    // $row=mysqli_fetch_assoc($result);
    // $forward=$row["post_to"];

    // $sql7 = "SELECT post_from FROM hierarchy WHERE post_to='$h'";
    // $result=mysqli_query($conn,$sql7);
    // $row=mysqli_fetch_assoc($result);
    // $backward=$row["post_from"];

    // if($app!="hod")     //forward or backward
    // {
    //     if($cond==1)        //forward
    //     {
    //         echo "Application has been forwarded <br>";
    //         $curr_status="pending by ".$forward;
    //         echo $curr_status;
            
    //         $sql5="UPDATE leave_application SET current_status='$curr_status',current_pos='$forward' WHERE leave_id='$leave_id'";
    //         if($conn->query($sql5)==FALSE)
    //         {
    //             echo "error in updating <br>";
    //         }
    //         exit();
    //     }
       
    //     else            //backward
    //     {
    //         echo "Application has been backwarded <br>"; 
    //         $curr_status="please review"; 
    //         $sql8="UPDATE leave_application SET current_status='$curr_status',current_pos='$backward' WHERE leave_id='$leave_id'";
    //         if($conn->query($sql8)==FALSE)
    //         {
    //             echo "error in updating <br>";
    //         }  
    //         exit();
    //     }
    // }
    
        if($cond==1)    //approve
        {
            $sql9="SELECT borrow,leave_days FROM leave_application WHERE leave_id='$leave_id'";
            $result=mysqli_query($conn,$sql9);
            $row=mysqli_fetch_assoc($result);
            $borrow=$row["borrow"];
            $leave_days=$row["leave_days"];

            $sql10="SELECT leavescount,nextyearleaves FROM faculty WHERE id='$aid'";
            $result=mysqli_query($conn,$sql10);
            $row=mysqli_fetch_assoc($result);   
            $daysleft1=$row["leavescount"];
            $daysleft2=$row["nextyearleaves"];
            $daysleft=$daysleft1;
            if($borrow==1)
            {
                $daysleft=$daysleft1+$daysleft2;
            }
            if($daysleft<$leave_days)       //rejection due to insufficient days
            {
                $stat="reject";
                $sql11="INSERT into application_log(application_id,applicant_id	,applicant_post	,signer_id	,signer_post	,approved_time	,log_status)
                        VALUES('$leave_id','$aid','$ap','$uname','$h','$date','$stat')";
                mysqli_query($conn,$sql11);
                $cmnt="rejection due to insufficient days";
                $by_whom="system";
                $sql12="INSERT into comments(app_id,comment,by_whom,accept,comment_time)
                        VALUES('$leave_id','$cmnt','$by_whom',0,'$date')";
                mysqli_query($conn,$sql12);
                echo "<h3>rejection due to insufficient days <br></h3>";
                $sql13 = "DELETE FROM leave_application WHERE leave_id='$leave_id'";
                mysqli_query($conn,$sql13);
                $sql14="UPDATE faculty SET have_app='$leave_id' WHERE id='$aid'";
                $conn->query($sql14);
                echo"
                <button class='button button1'><a href='home.php'>Home </a></button>
                <button class='button button1'><a href='directorlogin.php'>Director-Portal </a></button>
                ";
            }
            else
            {
                if($borrow==0)
                {
                    $daysleft1=$daysleft-$leave_days;
                }
                else
                {
                    if($leave_days<$daysleft1)
                    {
                        $daysleft1=$daysleft1-$leave_days;
                    }
                    else
                    {
                        $daysleft2=$daysleft2-($leave_days-$daysleft1);
                        $daysleft1=0;   
                    }    
                }
                $stat="accept";
                $sql11="INSERT into application_log(application_id,applicant_id	,applicant_post	,signer_id	,signer_post	,approved_time	,log_status)
                        VALUES('$leave_id','$aid','$ap','$uname','$h','$date','$stat')";
                mysqli_query($conn,$sql11);
                $cmnt="congratulations leave granted!!";
                $by_whom="director";
                $sql12="INSERT into comments(app_id,comment,by_whom,accept,comment_time)
                        VALUES('$leave_id','$cmnt','$by_whom',1,'$date')";
                $sql13 = "DELETE FROM leave_application WHERE leave_id='$leave_id'";
                mysqli_query($conn,$sql13);
                $sql14="UPDATE faculty SET have_app='$leave_id',leavescount='$daysleft1',nextyearleaves='$daysleft2' WHERE id='$aid'";
                $conn->query($sql14);
                echo "<h3>Application has been approved <br></h3>";
                echo"
                <button class='button button1'><a href='home.php'>Home </a></button>
                <button class='button button1'><a href='directorlogin.php'>Director-Portal </a></button>
                ";

            }
            
        }
        else            //reject
        {
            echo"
            <button class='button button1'><a href ='rejectd.php'> Reject</a></button>
            <button class='button button1'><a href='backwardd.php'> Backward for Review</a></button>
           ";
        }
?>
</section>
    </div>
</body>
</html>

