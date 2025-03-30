<?php
session_start();
include "config.php";

// Check if an ID is provided in the URL to delete an option
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the option from the database
    $stmt = $conn->prepare("DELETE FROM extra_options WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Set the success message and redirect to manage_option.php
        $_SESSION['success_message'] = 'Option deleted successfully!';
    } else {
        // If there is an error
        $_SESSION['error_message'] = 'Error deleting option. Please try again.';
    }

    // Redirect back to manage_option.php
    header("Location: manage_option.php");
    exit;
}
?>
