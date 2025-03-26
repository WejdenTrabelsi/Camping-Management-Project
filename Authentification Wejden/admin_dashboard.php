<?php
include 'db.php';

// Fetch all pending and active clients
$query = $conn->query("SELECT * FROM users WHERE role='client'");
$clients = $query->fetchAll();
?>

<h2>Client Account Requests</h2>
<?php foreach ($clients as $client): ?>
    <p>
        <?= $client['username'] ?> (<?= $client['email'] ?>) - Status: <strong><?= $client['status'] ?></strong>
        <?php if ($client['status'] == 'pending' || $client['status'] == 'deactivated'): ?>
            <a href="activate_client.php?id=<?= $client['id'] ?>">Activate</a>
        <?php endif; ?>
        <?php if ($client['status'] == 'active'): ?>
            <a href="deactivate_client.php?id=<?= $client['id'] ?>">Deactivate</a>
        <?php endif; ?>
    </p>
<?php endforeach; ?>
