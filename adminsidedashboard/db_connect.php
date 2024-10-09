<?php
// Database connection settings
$servername = "localhost:3307"; // Usually 'localhost'
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP is usually empty
$dbname = "user_systems"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>