<?php
session_start();
include "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Update the existing option in the database
    $stmt = $conn->prepare("UPDATE extra_options SET name=?, description=?, price=? WHERE id=?");
    $stmt->bind_param("ssdi", $name, $description, $price, $id);

    if ($stmt->execute()) {
        // Set the success message and redirect to manage_option.php
        $_SESSION['success_message'] = 'Option updated successfully!';
        header("Location: manage_option.php");
        exit; // Make sure to stop further execution
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>
