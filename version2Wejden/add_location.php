<?php
session_start();
require_once 'db.php';

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Add New Location</h4>
            </div>
            <div class="card-body">
                <form action="save_location.php" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Location Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Location Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="tent">Tent Spot</option>
                                <option value="caravan">Caravan Spot</option>
                                <option value="chalet">Chalet</option>
                                <option value="rv">RV Spot</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="price" class="form-label">Price per night ($)</label>
                            <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-4">
                            <label for="capacity" class="form-label">Maximum Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Amenities</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="electricity" name="electricity" value="1">
                                <label class="form-check-label" for="electricity">
                                    <i class="fas fa-bolt me-1"></i> Electricity
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="water" name="water" value="1">
                                <label class="form-check-label" for="water">
                                    <i class="fas fa-tint me-1"></i> Water
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label">Location Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="locations.php" class="btn btn-secondary me-2">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Location
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>