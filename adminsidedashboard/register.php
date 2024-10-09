<?php
include 'db_connect.php'; // Make sure this path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if fields are set and not empty
    if (isset($_POST['fullname']) && isset($_POST['username']) && 
        isset($_POST['email']) && isset($_POST['phone']) && 
        isset($_POST['password']) && isset($_POST['confirm_password']) && 
        isset($_POST['gender']) &&
        !empty($_POST['fullname']) && !empty($_POST['username']) && 
        !empty($_POST['email']) && !empty($_POST['phone']) && 
        !empty($_POST['password']) && !empty($_POST['confirm_password']) && 
        !empty($_POST['gender'])) {

        // Retrieve form data
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $gender = $_POST['gender'];

        // You can add more validation here

        // Check if password and confirm password match
        if ($password !== $confirm_password) {
            echo "Passwords do not match!";
            exit;
        }

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL insert statement
        $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, phone, password, gender) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fullname, $username, $email, $phone, $hashed_password, $gender);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required!";
    }
} else {
    echo "Invalid request!";
}

$conn->close();
?>