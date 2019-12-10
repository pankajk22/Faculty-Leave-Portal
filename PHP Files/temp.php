<?php
    $user= 'root';
    $pass='';
    $db='Faculty';

    $conn=new mysqli('localhost',$user,$pass,$db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $post_from="dean";
    $post_to="director";
    $post_approval="director";
    $sql = "INSERT INTO hierarchy (post_from,post_to,post_approval)
        VALUES ('$post_from','$post_to','$post_approval')";

        if ($conn->query($sql) === TRUE) {
            echo "Registered successfully!!!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } 



        $post_from="hod";
    $post_to="dean";
    $post_approval="director";
    $sql = "INSERT INTO hierarchy (post_from,post_to,post_approval)
        VALUES ('$post_from','$post_to','$post_approval')";

        if ($conn->query($sql) === TRUE) {
            echo "Registered successfully!!!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } 


        $post_from="employee";
    $post_to="hod";
    $post_approval="hod";
    $sql = "INSERT INTO hierarchy (post_from,post_to,post_approval)
        VALUES ('$post_from','$post_to','$post_approval')";

        if ($conn->query($sql) === TRUE) {
            echo "Registered successfully!!!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } 
?>