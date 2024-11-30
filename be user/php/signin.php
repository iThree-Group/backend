<?php
// Start the session
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form inputs are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Get form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if email and password are empty
        if (empty($email) || empty($password)) {
            echo "Email and password are required!";
        } else {
            // Prepare and bind SQL query
            $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
            $stmt->bind_param("s", $email);

            // Execute query
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if email exists in the database
            if ($result->num_rows > 0) {
                // Fetch the user data
                $user = $result->fetch_assoc();

                // Verify the password (use password_verify for hashed passwords)
                if (password_verify($password, $user['user_password'])) {
                    // Successful login
                    // Store user information in session
                    $_SESSION['user_email'] = $user['user_email'];

                    // Redirect to landing page
                    header("Location: ../landingpage.php"); // Adjust path if necessary
                    exit();
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "No user found with that email.";
            }

            // Close statement
            $stmt->close();
        }
    } else {
        echo "Email and password are required!";
    }
}

// Close the database connection
$conn->close();
?>
