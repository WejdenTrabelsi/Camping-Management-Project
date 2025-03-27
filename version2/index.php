<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Camping Adventures</title>
    <style>
        /* Same CSS as signup.php - maintain consistency */
        :root {
            --forest-green: #2a5c45;
            --leaf-green: #4a7c59;
            --light-tan: #f5f1e6;
            --warm-brown: #8b5a2b;
            --sunset-orange: #e07a5f;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-tan);
            color: #333;
            margin: 0;
            padding: 0;
            background-image: url('assets/img/nature-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .form-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .form-logo img {
            height: 60px;
        }
        
        .form-title {
            color: var(--forest-green);
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 1.2rem;
        }
        
        input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.8);
        }
        
        input:focus {
            outline: none;
            border-color: var(--leaf-green);
            box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.2);
        }
        
        button[type="submit"] {
            background-color: var(--forest-green);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        button[type="submit"]:hover {
            background-color: var(--leaf-green);
            transform: translateY(-2px);
        }
        
        .message {
            padding: 12px;
            margin: 1rem 0;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }
        
        .signup-link a {
            color: var(--forest-green);
            text-decoration: none;
            font-weight: 500;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
        
        .forgot-password {
            text-align: right;
            margin-top: -0.8rem;
            margin-bottom: 1rem;
        }
        
        .forgot-password a {
            color: var(--warm-brown);
            font-size: 0.9rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-logo">
            <img src="assets/img/logo.svg" alt="Camping Adventures">
        </div>
        <h1 class="form-title">Welcome Back</h1>
        
        <?php if (isset($_SESSION['login_message'])): ?>
            <div class="message <?= strpos($_SESSION['login_message'], 'success') ? 'success' : 'error' ?>">
                <?= $_SESSION['login_message'] ?>
            </div>
            <?php unset($_SESSION['login_message']); ?>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
                <div class="forgot-password">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
            </div>
            <button type="submit">Log In</button>
        </form>
        
        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>