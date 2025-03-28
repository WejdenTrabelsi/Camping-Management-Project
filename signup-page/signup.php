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
    <title>Sign Up - Camping Adventures</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="home page yahya/assets/css/signup.css">
</head>
<body>
    <div class="form-container">
        <div class="form-logo">
            <img src="home page yahya/assets/img/logo.svg" alt="Camping Adventures">
        </div>
        <h1 class="form-title">Create Your Account</h1>
        
        <?php if (isset($_SESSION['signup_message'])): ?>
            <div class="message <?= strpos($_SESSION['signup_message'], 'success') ? 'success' : 'error' ?>">
                <?= $_SESSION['signup_message'] ?>
            </div>
            <?php unset($_SESSION['signup_message']); ?>
        <?php endif; ?>

        <form action="signup_process.php" method="POST" enctype="multipart/form-data">
            <div class="input-box">
                <input type="email" name="email" placeholder="Email Address" required>
                <i class='bx bxl-gmail' ></i>
            </div>    
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" minlength="4" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" minlength="8" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="scroll-btn">
                <select name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="client">Camper</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            
<!--==================== profile icon ====================-->
<label for="image" class="file-label">
    <input type="file" name="image" id="image" class="file-input" accept="image/jpg, image/jpeg, image/png" onchange="updateFileName()">
</label>
<p id="file-name" class="file-name">Choose profile icon</p>

<style>
/* Hide the default file input button */
.file-input {
    display: none;
}

/* Style the label as a custom file input button */
.file-label {
    display: inline-block;
    margin-top: -10px;
    margin-bottom: 6px;
    padding: 5px 10px;
    background-image: url('home page yahya/assets/img/placeholder-profile-icon.svg');
    background-size: cover;
    background-position: center;
    color: white;
    font-size: 14px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    filter: invert(1);
    margin-left: auto;
    margin-right: auto;
}
.file-label:hover {
    box-shadow: 0 0 10px rgb(255, 255, 255); /* White glow effect */
    filter: brightness(1.2); /* Slightly increases brightness */
    transition: all 0.3s ease-in-out;
}


/* Style for the file name display */
.file-name {
    text-align: center;
    font-size: 20px;
    color: white;
    margin-top: 2px;
    margin-bottom: 13px;
    font-family: Arial, sans-serif;
}
</style>

<script>
function updateFileName() {
    var input = document.getElementById('image');
    var fileName = input.files.length > 0 ? input.files[0].name : "Choose profile icon";
    document.getElementById('file-name').textContent = fileName;
}
</script>


<!--==================== profile icon ====================-->
            <button type="submit">Sign Up</button>
        </form>
        
        <div class="login-link">
            Already have an account?<a href="index.php">Log In</a>
        </div>
    </div>
    <script src="home page yahya/assets/js/gsap.min.js"></script>

    <script>
        gsap.from('.form-logo',1.2, {opacity: 0, y:-50, delay: .3})
        gsap.from('.form-container',1.2, {opacity: 0, y:-50, delay: .1})
        gsap.from('.form-title',1.2, {opacity: 0, y:-50, delay: .5})
        gsap.from('.input-box',1.2, {opacity: 0, y:-50, delay: .7})
        gsap.from('.scroll-btn',1.2, {opacity: 0, y:-50, delay: 1})
        gsap.from('.file-label',1.2, {opacity: 0, y:-50, delay: 1.2})
        gsap.from('.file-name',1.2, {opacity: 0, y:-50, delay: 1.4})
        gsap.from('button',1.2, {opacity: 0, y:-50, delay: 1.6})
        gsap.from('.login-link',1.2, {opacity: 0, y:-50, delay: 1.8})
    </script>
</body>
</html>