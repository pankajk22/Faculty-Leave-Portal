<?php
$user= 'root';
$pass='';
$db='Faculty';  
$conn=new mysqli('localhost',$user,$pass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $id=$_POST["id"];
    //delete from users table
    $sql="SELECT username FROM users WHERE username='$id'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==0)
    {
        echo "NO SUCH FACULTY IN THE DATABASE<br>";
        exit();
    }
    $sql1="DELETE FROM users WHERE username='$id'";         //delete from users table
    mysqli_query($conn,$sql1);
    $sql2="DELETE FROM leave_application WHERE applicant_id='$id'";    //delete their leaves application
    mysqli_query($conn,$sql2);
    $ed="";             
    $sql3="SELECT hod_id FROM hod WHERE hod_id='$id' and end_date='$ed'";       //delete from hod post
    $result=mysqli_query($conn,$sql3);
    if(mysqli_num_rows($result)!=0)
    {
        $sql4="DELETE FROM hod WHERE hod_id='$id' and end_date='$ed'";
        mysqli_query($conn,$sql4);
    }
    $sql5="DELETE FROM faculty WHERE id='$id'";     //delete from faculty
    $result=mysqli_query($conn,$sql5);

    $ed="";             
    $sql6="SELECT d_id FROM director WHERE d_id='$id' and end_date='$ed'";       //delete from director post
    $result=mysqli_query($conn,$sql6);
    if(mysqli_num_rows($result)!=0)
    {
        $sql7="DELETE FROM director WHERE d_id='$id'and end_date='$ed'";
        mysqli_query($conn,$sql7);
    }

    $ed="";             
    $sql8="SELECT id FROM crosscutting WHERE id='$id' and end_date='$ed'";       //delete from crosscutting post
    $result=mysqli_query($conn,$sql8);
    if(mysqli_num_rows($result)!=0)
    {
        $sql9="DELETE FROM crosscutting WHERE id='$id'and end_date='$ed'";
        mysqli_query($conn,$sql9);
    }

    echo "DELETED SUCCESSFULLY<br>";
?>