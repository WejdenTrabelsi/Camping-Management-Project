<?php
include 'db.php';

// Fetch pending and active admins
$query = $conn->query("SELECT * FROM users WHERE role='admin'");
$admins = $query->fetchAll();
?>

<h2>Admin Account Requests</h2>
<?php foreach ($admins as $admin): ?>
    <p>
        <?= $admin['username'] ?> (<?= $admin['email'] ?>) - Status: <strong><?= $admin['status'] ?></strong>
        <?php if ($admin['status'] == 'pending' || $admin['status'] == 'deactivated'): ?>
            <a href="activate.php?id=<?= $admin['id'] ?>">Activate</a>
        <?php endif; ?>
        <?php if ($admin['status'] == 'active'): ?>
            <a href="deactivate.php?id=<?= $admin['id'] ?>">Deactivate</a>
        <?php endif; ?>
    </p>
<?php endforeach; ?>
