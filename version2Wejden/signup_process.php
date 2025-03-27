<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'db.php';

// 1. Validate request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['signup_message'] = "Invalid request method";
    header("Location: signup.php");
    exit();
}

// 2. Validate inputs
$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$role = in_array($_POST['role'] ?? '', ['client', 'admin']) ? $_POST['role'] : 'client';

// Validation checks
$errors = [];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
if (strlen($username) < 4) $errors[] = "Username must be at least 4 characters";
if (strlen($password) < 8) $errors[] = "Password must be at least 8 characters";

if (!empty($errors)) {
    $_SESSION['signup_message'] = implode("<br>", $errors);
    header("Location: signup.php");
    exit();
}

// 3. Check for existing email
try {
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['signup_message'] = "Email already registered";
        header("Location: signup.php");
        exit();
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $_SESSION['signup_message'] = "System error. Please try later.";
    header("Location: signup.php");
    exit();
}

// 4. Create account
try {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Test connection first
    if (!$conn) {
        throw new Exception("No database connection");
    }
    
    // Test with simple query
    $conn->query("SELECT 1")->fetch();
    
    // Your actual query
    $stmt = $conn->prepare("INSERT INTO users 
        (email, username, password, role, created_at, is_active) 
        VALUES (?, ?, ?, ?, NOW(), 0)");
        
    if (!$stmt->execute([$email, $username, $hashedPassword, $role])) {
        throw new Exception("Execute failed");
    }
    
    $_SESSION['signup_message'] = "Registration successful! Awaiting admin activation.";
    header("Location: signup.php");
    exit();

} catch (Exception $e) {
    $errorInfo = $conn->errorInfo() ?? ['No DB info available'];
    error_log("SIGNUP ERROR: " . $e->getMessage() . " | DB Error: " . print_r($errorInfo, true));
    
    $_SESSION['signup_message'] = "Error: " . $e->getMessage() . " | DB Error: " . $errorInfo[2];
    header("Location: signup.php");
    exit();
}