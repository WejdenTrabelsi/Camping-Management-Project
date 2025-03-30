<?php
session_start();
include "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Insert the new option into the database
    $stmt = $conn->prepare("INSERT INTO extra_options (name, description, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $description, $price);

    if ($stmt->execute()) {
        // Set the success message and redirect to manage_option.php
        $_SESSION['success_message'] = 'Option added successfully!';
        header("Location: manage_option.php");
        exit; // Make sure to stop further execution
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>
