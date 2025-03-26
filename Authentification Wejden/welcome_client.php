<?php
session_start();

// Check if the user is logged in and is a client
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'client') {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username']; // Get username from session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        button {
            padding: 10px 15px;
            border: none;
            background-color: red;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>You are logged in as a client.</p>
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</div>

</body>
</html>
