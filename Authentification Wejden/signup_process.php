<?php
include 'db.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

$query = $conn->prepare("INSERT INTO users (email, username, password, role) VALUES (?, ?, ?, ?)");
$query->execute([$email, $username, $password, $role]);

echo "Wait for admin to activate your account.";
?>
