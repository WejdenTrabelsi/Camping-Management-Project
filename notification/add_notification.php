<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "camping_db";

// Establish connection to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted with a non-empty message
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['message'])) {
    $message = $_POST['message'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "INSERT INTO notifications (message) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $message);
    $stmt->execute();
    $stmt->close();

    // Display success message after adding notification
    echo "<p style='color: green;'>Notification added successfully!</p>";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notification</title>
    <style>
        /* Basic styling for the page */
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
            margin-top: 50px; 
        }
        /* Form styling */
        form { 
            display: inline-block; 
            text-align: left; 
            background: #f9f9f9; 
            padding: 20px; 
            border-radius: 5px; 
        }
        /* Input and button styles */
        input, button { 
            margin-top: 10px; 
            width: 100%; 
            padding: 10px; 
        }
    </style>
</head>
<body>

    <h2>Add a Notification</h2>
    <!-- Form to submit a new notification -->
    <form method="POST">
        <label for="message">Notification Message:</label><br>
        <input type="text" id="message" name="message" required><br>
        <button type="submit">Add Notification</button>
    </form>

</body>
</html>
