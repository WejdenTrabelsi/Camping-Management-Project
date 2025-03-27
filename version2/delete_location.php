<?php
session_start();
require_once 'db.php';

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: locations.php");
    exit;
}

// First get the location to delete the image
$stmt = $conn->prepare("SELECT image_path FROM locations WHERE id = ?");
$stmt->execute([$_GET['id']]);
$location = $stmt->fetch(PDO::FETCH_ASSOC);

// Delete the location
$stmt = $conn->prepare("DELETE FROM locations WHERE id = ?");
$stmt->execute([$_GET['id']]);

// Delete the image if it exists
if ($location && $location['image_path'] && file_exists($location['image_path'])) {
    unlink($location['image_path']);
}

header("Location: locations.php?success=Location deleted successfully");
exit;
?>