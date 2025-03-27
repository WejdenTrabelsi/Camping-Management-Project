<?php
// camping_project/navbar.php
$isLoggedIn = isset($_SESSION['username']);
$isAdmin = $isLoggedIn && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'superadmin');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= $isLoggedIn ? 'admin_dashboard.php' : 'index.php' ?>">
            <i class="fas fa-campground me-2"></i> Camping Management
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if ($isLoggedIn): ?>
            <ul class="navbar-nav me-auto">
                <?php if ($isAdmin): ?>
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="locations.php">
                        <i class="fas fa-map-marker-alt me-1"></i> Locations
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>