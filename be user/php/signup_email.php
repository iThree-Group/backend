<?php
// Database connection setup
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "db_sampah_2"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $phone = $_POST['user_phone_number'];
    $address = $_POST['user_address'];
    
   
    // Validate form data
    if (empty($name) || empty($email) || empty($password) || empty($address) || empty($phone)) {
        echo "All fields are required!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query
        $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password, user_phone_number, user_address) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }
        $stmt->bind_param("sssss", $name, $email, $hashed_password, $address, $phone);

        // Execute query
        if ($stmt->execute()) {
            echo "Registration successful!";
            
            // Redirect to signup.php
            header("Location: ../user/signin.php"); // Redirect after success
            exit(); // Make sure no further code is executed after the redirect
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
