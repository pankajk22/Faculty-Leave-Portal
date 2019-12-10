<?php
    session_start();
    $user= 'root';
    $pass='';
    $db='Faculty';
    $match=1;
    $conn=new mysqli('localhost',$user,$pass,$db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $uname=$_POST["Username"];
    $pass=$_POST["Password"];
    //echo "Password:".$pass."and username:".$uname;
	$_SESSION["uname"]=$uname;
    $_SESSION["pass"]=$pass;
    $sql="SELECT f_password from users where username='$uname'";
    $result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) == 0)
    {
        echo "<script>alert('Username not found!!')</script>";
        echo "Username not found!!";
        exit();
    }

    if (mysqli_num_rows($result) > 0)
    {
        $row=mysqli_fetch_assoc($result);
        if(strcmp($row["f_password"],$pass)!=0)
        {
            echo "<script>alert('Enter Correct Password!!')</script>";
            echo "Enter Correct Password!!";
            $match=0;
            exit();
        }
    }
    if($match==1)
    {
        echo "Log-In Successfull!!!";
        $sql="SELECT post from faculty where id='$uname'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $dir="director";
        $dean="dean";
        $adean="associate_dean";
        $hod="hod";
        if(strcmp($row["post"],$dir)==0)
        {
            include("directorlogin.php");    
        }
        else if(strcmp($row["post"],$dean)==0)
        {
            include("deanslogin.php");  
        }
        else if(strcmp($row["post"],$adean)==0)
        {
            include("adeanslogin.php");  
        }
        else if(strcmp($row["post"],$hod)==0)
        {
            include("hodlogin.php");   
        }
        else
        {
            include("profile.php");
        }
    }

    


?>
