<?php
session_start();
require_once 'db.php';

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Get location ID
if (!isset($_GET['id'])) {
    header("Location: locations.php");
    exit;
}

// Fetch location data
$stmt = $conn->prepare("SELECT * FROM locations WHERE id = ?");
$stmt->execute([$_GET['id']]);
$location = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$location) {
    header("Location: locations.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Location</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Location</h4>
            </div>
            <div class="card-body">
                <form action="update_location.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $location['id'] ?>">
                    <input type="hidden" name="current_image" value="<?= $location['image_path'] ?>">

                    <div class="mb-3">
                        <?php if ($location['image_path']): ?>
                        <label class="form-label">Current Image</label><br>
                        <img src="<?= htmlspecialchars($location['image_path']) ?>" class="img-thumbnail mb-2" style="max-height: 200px;">
                        <?php endif; ?>
                        <label for="image" class="form-label"><?= $location['image_path'] ? 'Replace Image' : 'Upload Image' ?></label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Location Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($location['name']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Location Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="tent" <?= $location['type'] == 'tent' ? 'selected' : '' ?>>Tent Spot</option>
                                <option value="caravan" <?= $location['type'] == 'caravan' ? 'selected' : '' ?>>Caravan Spot</option>
                                <option value="chalet" <?= $location['type'] == 'chalet' ? 'selected' : '' ?>>Chalet</option>
                                <option value="rv" <?= $location['type'] == 'rv' ? 'selected' : '' ?>>RV Spot</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="price" class="form-label">Price per night ($)</label>
                            <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" value="<?= $location['price'] ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="capacity" class="form-label">Maximum Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" min="1" value="<?= $location['capacity'] ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Amenities</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="electricity" name="electricity" value="1" <?= $location['electricity'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="electricity">
                                    <i class="fas fa-bolt me-1"></i> Electricity
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="water" name="water" value="1" <?= $location['water'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="water">
                                    <i class="fas fa-tint me-1"></i> Water
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($location['description']) ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="locations.php" class="btn btn-secondary me-2">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>