<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "camping_db";

// Establish connection to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection failed and stop execution if there's an error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to update all notifications where is_read is 0 (unread notifications) to mark them as read
$sql = "UPDATE notifications SET is_read = 1 WHERE is_read = 0";

// Execute the query
$conn->query($sql);

// Close the database connection
$conn->close();
?>
