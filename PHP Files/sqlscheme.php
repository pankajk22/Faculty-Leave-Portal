<?php
    $user= 'root';
    $pass='';
    $db='Faculty';

    $conn=new mysqli('localhost',$user,$pass,$db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "CREATE TABLE users (
        username VARCHAR(20) NOT NULL,
        f_password VARCHAR(20) NOT NULL,
        PRIMARY KEY(username)
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table users created successfully <br>";
        } else {
            echo "Error creating table0: " . $conn->error;
        }
    $sql = "CREATE TABLE faculty (
        id VARCHAR(20) NOT NULL,
        f_name VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        department VARCHAR(20),
        post VARCHAR(50) NOT NULL,
        leavescount INT,
        nextyearleaves INT,
        have_app INT,
        PRIMARY KEY(id)
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table faculty created successfully <br>";
        } else {
            echo "Error creating table1: " . $conn->error;
        }
    $sql ="CREATE TABLE HOD(
        hod_id VARCHAR(20) NOT NULL,
        hod_name VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        department VARCHAR(20) NOT NULL,
        join_date VARCHAR(10) NOT NULL,
        end_date VARCHAR(10)

        -- FOREIGN KEY(hod_id) REFERENCES faculty(id)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table HOD created successfully <br>";
        } else {
            echo "Error creating table2: " . $conn->error;
        }
    
    $sql ="CREATE TABLE crosscutting(
        id VARCHAR(20) NOT NULL,
        cc_name VARCHAR(30) NOT NULL,
        join_date VARCHAR(10) NOT NULL,
        end_date VARCHAR(10),
        post VARCHAR(50) NOT NULL,
        email VARCHAR(50)
        -- PRIMARY KEY(id),
        -- FOREIGN KEY(id) REFERENCES faculty(id)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table crosscutting created successfully <br>";
        } else {
            echo "Error creating table3: " . $conn->error;
        }

    $sql="CREATE TABLE director(
        d_id VARCHAR(20) NOT NULL,
        d_name VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        join_date VARCHAR(10) NOT NULL,
        end_date VARCHAR(10)
        -- FOREIGN KEY(d_id) REFERENCES faculty(id)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table director created successfully <br>";
        } else {
            echo "Error creating table4: " . $conn->error;
        }

    $sql="CREATE TABLE hierarchy(
        post_from VARCHAR(50) NOT NULL,
        post_to VARCHAR(50) NOT NULL,
        post_approval VARCHAR(50) NOT NULL
    )";

        if ($conn->query($sql) === TRUE) {
            echo "Table hierarchy created successfully <br>";
        } else {
            echo "Error creating table5: " . $conn->error;
        }

    $sql="CREATE TABLE leave_application(
        leave_id INT  AUTO_INCREMENT NOT NULL,
        applicant_id VARCHAR(20) NOT NULL,
        applicant_post VARCHAR(50) NOT NULL,
        applicant_dept VARCHAR(20),
        current_status VARCHAR(30),
        current_pos VARCHAR(50) NOT NULL,
        date_from VARCHAR(20) NOT NULL,
        leave_days INT NOT NULL,
        reason VARCHAR(100),
        borrow INT NOT NULL,  
        reviewby VARCHAR(50),  
        PRIMARY KEY(leave_id,applicant_id)
    )";

        if ($conn->query($sql) === TRUE) {
            echo "Table leave_application created successfully <br>";
        } else {
            echo "Error creating table6: " . $conn->error;
        }

        $sql="CREATE TABLE application_log(
            application_id INT NOT NULL,
            applicant_id VARCHAR(20) NOT NULL,
            applicant_post VARCHAR(50) NOT NULL,
            signer_id VARCHAR(20) NOT NULL,
            signer_post VARCHAR(50) NOT NULL,
            approved_time VARCHAR(30) NOT NULL,
            log_status VARCHAR (10) NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table application_log created successfully <br>";
        } else {
            echo "Error creating table7: " . $conn->error;
        }
        $sql="CREATE TABLE comments(
            app_id INT NOT NULL,
            comment VARCHAR(100),
            by_whom VARCHAR(50),
            accept INT,
            comment_time VARCHAR(30) NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table comments created successfully <br>";
        } else {
            echo "Error creating table8: " . $conn->error;
        }

        $sql="CREATE TABLE leave_info(
            faculty_id VARCHAR(20),
            year INT,
            days_left INT
        )";
         if ($conn->query($sql) === TRUE) {
            echo "Table leave_info created successfully <br>";
        } else {
            echo "Error creating table8: " . $conn->error;
        }



    $conn->close();
?>