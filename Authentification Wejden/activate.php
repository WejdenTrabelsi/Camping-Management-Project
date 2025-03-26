<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("UPDATE users SET status='active' WHERE id=$id");

header("Location: superadmin_dashboard.php");
?>
