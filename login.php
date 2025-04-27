<?php
    $servername = "localhost";
    $username = "root";   // or "sentilytics" if you created a user, but "root" works usually on XAMPP
    $password = "";       // empty password
    $databasename = "sentilytics"; 
    
    // Create a connection to the database
    $con = mysqli_connect($servername, $username, $password, $databasename);
    
    if(!$con){
        die("Connection to the database failed due to " . mysqli_connect_error());
    }                           

    echo "Success connecting to the DB<br>";

    // Retrieve data from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // SQL query with placeholders to prevent SQL injection
    $sql = "INSERT INTO login (email, password) VALUES (?, ?)";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    if($stmt){
        // Bind parameters and execute the statement
        $stmt->bind_param("ss", $email, $password);

        if($stmt->execute()){
            echo "Successfully inserted";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $con->error;
    }
    
    // Close the connection
    $con->close();
?>
