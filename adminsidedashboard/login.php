<?php
// Include your database connection file
include 'db_connect.php';

// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username_or_email']) && isset($_POST['password'])) {
        $username_or_email = $_POST['username_or_email'];
        $password = $_POST['password'];

        // Validate that fields are not empty
        if (empty($username_or_email) || empty($password)) {
            echo "All fields are required!";
            exit; // Stop the script execution
        }

        // Prepare the SQL statement
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username_or_email, $username_or_email);
        
        // Execute and get the result
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Verify the password (ensure passwords are hashed during registration)
                if (password_verify($password, $row['password'])) {
                    // Password is correct, log the user in
                    // Set session variables to track the user
                    $_SESSION['user_id'] = $row['id']; // Assuming you have an 'id' column
                    $_SESSION['username'] = $row['username']; // Store username for session

                    // Redirect to the dashboard
                    header("Location: dashboards.php");
                    exit; // Ensure no further code is executed
                } else {
                    echo "Invalid password!";
                }
            } else {
                echo "User does not exist or invalid credentials!";
            }
        } else {
            echo "Error executing query: " . $stmt->error;
        }
    } else {
        echo "All fields are required!";
    }
}
?>