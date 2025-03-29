<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "camping_db";

// Establish connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection failed and stop execution if there's an error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all notifications, including their read status
$sql = "SELECT id, message, created_at, is_read FROM notifications ORDER BY created_at DESC";
$result = $conn->query($sql);

// Initialize an array to store notifications and a counter for unread messages
$notifications = [];
$unreadCount = 0;

// Check if there are notifications in the database
if ($result->num_rows > 0) {
    // Loop through each notification and add it to the array
    while ($row = $result->fetch_assoc()) {
        // Count unread notifications
        if ($row['is_read'] == 0) {
            $unreadCount++;
        }
        // Store the notification details in the array
        $notifications[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return the notifications and unread count as a JSON response
echo json_encode(["notifications" => $notifications, "unreadCount" => $unreadCount]);
?>
