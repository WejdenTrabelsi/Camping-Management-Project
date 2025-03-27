<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("UPDATE users SET status='deactivated' WHERE id=$id");

header("Location: superadmin_dashboard.php");
?>
