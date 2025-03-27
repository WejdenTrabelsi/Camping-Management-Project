<?php
session_start();
include'db.php';

// Check if admin is logged in and activated
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}

// Check if user is an admin and account is active
$stmt = $conn->prepare("SELECT status FROM users WHERE username = ? AND role = 'admin'");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch();

if (!$user || $user['status'] != 'active') {
    header("Location: index.php");
    exit;
}
// Fetch all clients
$query = $conn->query("SELECT * FROM users WHERE role='client'");
$clients = $query->fetchAll(PDO::FETCH_ASSOC);

// Count client statuses
$totalClients = count($clients);
$pendingClients = 0;
$activeClients = 0;

foreach ($clients as $client) {
    if ($client['status'] == 'pending') $pendingClients++;
    if ($client['status'] == 'active') $activeClients++;
}

// Fetch locations count
try {
    $locationsQuery = $conn->query("SELECT COUNT(*) as count FROM locations");
    $locationsCount = $locationsQuery->fetch(PDO::FETCH_ASSOC)['count'];
} catch (PDOException $e) {
    $locationsCount = 0; // Default to 0 if table doesn't exist
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fc;
        }
        .sidebar {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            min-height: 100vh;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
            padding: 1rem;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            color: #fff;
        }
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .badge-pending {
            background-color: #f6c23e;
        }
        .badge-active {
            background-color: #1cc88a;
        }
        .badge-deactivated {
            background-color: #e74a3b;
        }
        .add-location-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 24px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="admin_dashboard.php">
                                <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="locations.php">
                                <i class="fas fa-fw fa-map-marker-alt"></i> Locations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-fw fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Client Management</h1>
                    <div class="text-muted">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Clients</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalClients ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending Clients</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pendingClients ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Active Clients</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $activeClients ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Client Table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Client Accounts</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clients as $client): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($client['username']) ?></td>
                                        <td><?= htmlspecialchars($client['email']) ?></td>
                                        <td>
                                            <span class="badge badge-<?= strtolower($client['status']) ?>">
                                                <?= ucfirst($client['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($client['status'] == 'pending' || $client['status'] == 'deactivated'): ?>
                                                <a href="activate_client.php?id=<?= $client['id'] ?>" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i> Activate
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($client['status'] == 'active'): ?>
                                                <a href="deactivate_client.php?id=<?= $client['id'] ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-times"></i> Deactivate
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Floating Add Button -->
    <a href="add_location.php" class="btn btn-primary add-location-btn">
        <i class="fas fa-plus"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>