<?php
// Activer l'affichage des erreurs pour faciliter le débogage
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
    <title>Contact Us - Camping Adventures</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./contactus.css">
</head>
<body>
    <div class="form-container">
     <!-- Logo du site -->
        <div class="form-logo">
            <img src="./logo.svg" alt="Camping Adventures">
        </div>
    <!-- Titre du formulaire -->
        <h1 class="form-title">Get in Touch</h1>
    <!-- Vérifie si un message de session est défini et l'affiche -->
        <?php if (isset($_SESSION['contact_message'])): ?>
            <div class="message <?= strpos($_SESSION['contact_message'], 'success') ? 'success' : 'error' ?>">
                <?= $_SESSION['contact_message'] ?>
            </div>
            <?php unset($_SESSION['contact_message']); ?>
        <?php endif; ?>
    <!-- Formulaire de contact -->
<form action="contact_process.php" method="POST">
    <!-- Champ pour le nom -->
    <div class="input-box">
        <input type="text" name="name" placeholder="Your Name" required>
        <i class='bx bxs-user'></i>
    </div>
    <!-- Champ pour l'email -->
    <div class="input-box">
        <input type="email" name="email" placeholder="Your Email" required>
        <i class='bx bxl-gmail'></i>
    </div>
    <!-- Champ pour le message -->

    <div class="input-box">
      <textarea name="message" placeholder="Your Message" required></textarea>
   
    </div>
    <br/><br/>
    <br/>

    <!-- Conteneur pour les boutons -->
            <div class="button-container">
    <!-- bouton Clear All  -->
        <button type="button" id="clear-btn">Clear All</button>
     <!-- Bouton pour envoyer le message -->

        <button type="submit" id="send-btn">send</button>

    </div>
</form>
    <!-- Lien vers la page d'inscription -->        
        <div class="login-link">
            Want to book a camping trip? <a href="signup.php">Sign Up</a>
        </div>
    </div>
     <!-- Inclusion de la bibliothèque GSAP pour les animations -->
    <script src="./gsap.min.js"></script>

    <script>
     //animation
        gsap.from('.form-logo', 1.2, {opacity: 0, y: -50, delay: .3})
        gsap.from('.form-container', 1.2, {opacity: 0, y: -50, delay: .1})
        gsap.from('.form-title', 1.2, {opacity: 0, y: -50, delay: .5})
        gsap.from('.button-container', 1.2, {opacity: 0, y: -50, delay: .7})
        gsap.from('.login-link', 1.2, {opacity: 0, y: -50, delay: 1.2})

    </script>
    <script>
    // Fonction pour vider les champs du formulaire lorsqu'on click clear all
    document.getElementById("clear-btn").addEventListener("click", function() {
        document.querySelector("form").reset();
    });
</script>

</body>
</html>
