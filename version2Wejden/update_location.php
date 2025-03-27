<?php
session_start();
require_once 'db.php';

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: locations.php");
    exit;
}

// Handle file upload if new image was provided
$imagePath = $_POST['current_image'];
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/locations/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $destination = $uploadDir . $filename;
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        // Delete old image if it exists
        if ($imagePath && file_exists($imagePath)) {
            unlink($imagePath);
        }
        $imagePath = $destination;
    }
}

// Update location in database
$stmt = $conn->prepare("
    UPDATE locations SET 
        name = ?, 
        type = ?, 
        price = ?, 
        capacity = ?, 
        electricity = ?, 
        water = ?, 
        description = ?, 
        image_path = ?,
        updated_at = NOW()
    WHERE id = ?
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
    $_POST['id']
]);

header("Location: locations.php?success=Location updated successfully");
exit;
?>