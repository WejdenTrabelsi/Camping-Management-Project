<?php
session_start();
require_once 'db.php';

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Handle file upload
$imagePath = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/locations/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $destination = $uploadDir . $filename;
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        $imagePath = $destination;
    }
}

// Get current user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch();

// Save location to database
$stmt = $conn->prepare("
    INSERT INTO locations (
        name, type, price, capacity, electricity, water, 
        description, image_path, created_by
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->execute([
    $_POST['name'],
    $_POST['type'],
    $_POST['price'],
    $_POST['capacity'],
    isset($_POST['electricity']) ? 1 : 0,
    isset($_POST['water']) ? 1 : 0,
    $_POST['description'],
    $imagePath,
    $user['id']
]);

header("Location: locations.php?success=Location added successfully");
exit;
?>