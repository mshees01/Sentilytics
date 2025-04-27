<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; // Use 'root' for XAMPP
    $dbpassword = "";   // XAMPP default is no password
    $databasename = "sentilytics";

    // Create connection
    $con = mysqli_connect($servername, $username, $dbpassword, $databasename);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Safely get POST data with fallback
    $firstName = $_POST['first_name'] ?? null;
    $lastName = $_POST['last_name'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    // Basic validation
    if (!$firstName || !$lastName || !$dob || !$gender || !$email || !$password) {
        die("All fields are required.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query using prepared statements
    $sql = "INSERT INTO signup (first_name, last_name, dob, gender, email, password, timestamp)
            VALUES (?, ?, ?, ?, ?, ?, current_timestamp())";

    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssss", $firstName, $lastName, $dob, $gender, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "✅ Successfully signed up!";
        } else {
            echo "❌ Error during signup: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ Failed to prepare SQL: " . $con->error;
    }

    $con->close();
}
?>
