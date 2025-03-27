<?php
session_start(); // Start the session
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = $conn->prepare("SELECT * FROM users WHERE username = ?");
$query->execute([$username]);
$user = $query->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['username']; // Store username in session
    $_SESSION['role'] = $user['role']; // Store user role in session

    if ($user['role'] == 'admin') {
        if ($user['status'] == 'pending') {
            echo "Your admin account is pending approval. Please wait for the superadmin.";
        } elseif ($user['status'] == 'deactivated') {
            echo "Your admin account has been deactivated.";
        } elseif ($user['status'] == 'active') {
            header("Location: admin_dashboard.php");
            exit();
        }
    } elseif ($user['role'] == 'client') {
        if ($user['status'] == 'pending') {
            echo "Your client account is pending approval. Please wait for an admin.";
        } elseif ($user['status'] == 'deactivated') {
            echo "Your client account has been deactivated.";
        } elseif ($user['status'] == 'active') {
            header("Location: welcome_client.php");
            exit();
        }
    }
} elseif ($username == 'superadmin' && $password == 'superadmin') {
    $_SESSION['username'] = "superadmin";
    $_SESSION['role'] = "superadmin";
    header("Location: superadmin_dashboard.php");
    exit();
} else {
    echo "Invalid login.";
}
?>
