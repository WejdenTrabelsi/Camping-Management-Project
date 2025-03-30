<?php
session_start(); // Start the session to store success messages

include "config.php";

// Fetch available extra options
$options_result = $conn->query("SELECT * FROM extra_options");
$options = [];
while ($option = $options_result->fetch_assoc()) {
    $options[] = $option;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if we are adding or updating an accommodation
    if (isset($_POST['id'])) {  // Update existing accommodation
        $id = $_POST['id']; // Accommodation ID to update
        $name = $_POST['name'];
        $price = $_POST['price_per_night'];
        $capacity = $_POST['capacity'];
        $description = $_POST['description'];
        $selected_options = isset($_POST['extra_options']) ? $_POST['extra_options'] : [];

        // Handle Image Upload (optional)
        $image_name = null;
        if (!empty($_FILES["image"]["name"])) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $image_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $image_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ["jpg", "jpeg", "png", "gif"];

            if (in_array($imageFileType, $allowed_types) && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Image uploaded successfully
            } else {
                $image_name = null; // Ignore invalid image
            }
        }

        // If no new image uploaded, keep the old image
        if ($image_name === null) {
            $stmt = $conn->prepare("SELECT image_path FROM accommodations WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $existing_image = $result->fetch_assoc()['image_path'];
            if ($existing_image) {
                $image_name = $existing_image; // Keep the old image
            }
        }

        // Update the accommodation record
        $stmt = $conn->prepare("UPDATE accommodations SET name=?, price_per_night=?, capacity=?, description=?, image_path=? WHERE id=?");
        $stmt->bind_param("sdissi", $name, $price, $capacity, $description, $image_name, $id);

        if ($stmt->execute()) {
            // Remove existing options
            $conn->query("DELETE FROM accommodation_options WHERE accommodation_id = $id");

            // Add selected options
            foreach ($selected_options as $option_id) {
                $stmt_options = $conn->prepare("INSERT INTO accommodation_options (accommodation_id, option_id) VALUES (?, ?)");
                $stmt_options->bind_param("ii", $id, $option_id);
                $stmt_options->execute();
            }

            // Set a success message in session
            $_SESSION['success_message'] = 'Accommodation updated successfully!';

            header("Location: index.php"); // ✅ Auto-refresh page to show success message
            exit;
        } else {
            echo "<script>alert('❌ Error: " . $stmt->error . "');</script>";
        }
    } else {  // Add new accommodation
        $name = $_POST['name'];
        $price = $_POST['price_per_night'];
        $capacity = $_POST['capacity'];
        $description = $_POST['description'];
        $selected_options = isset($_POST['extra_options']) ? $_POST['extra_options'] : [];

        // Handle Image Upload
        $image_name = null;
        if (!empty($_FILES["image"]["name"])) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $image_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $image_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ["jpg", "jpeg", "png", "gif"];

            if (in_array($imageFileType, $allowed_types) && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Image uploaded successfully
            } else {
                echo "<script>alert('❌ Error: Invalid image format.');</script>";
                exit;
            }
        }

        // Insert new accommodation record
        $stmt = $conn->prepare("INSERT INTO accommodations (name, price_per_night, capacity, description, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdsss", $name, $price, $capacity, $description, $image_name);

        if ($stmt->execute()) {
            $new_accommodation_id = $stmt->insert_id;

            // Insert selected options for the new accommodation
            foreach ($selected_options as $option_id) {
                $stmt_options = $conn->prepare("INSERT INTO accommodation_options (accommodation_id, option_id) VALUES (?, ?)");
                $stmt_options->bind_param("ii", $new_accommodation_id, $option_id);
                $stmt_options->execute();
            }

            // Set a success message in session
            $_SESSION['success_message'] = 'Accommodation added successfully!';

            header("Location: index.php"); // ✅ Auto-refresh page to show success message
            exit;
        } else {
            echo "<script>alert('❌ Error: " . $stmt->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Accommodations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <h2><i class="fas fa-house me-2"></i> Camping Accommodations</h2>
    
    <!-- Display Success Message if set -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
            <strong>Success!</strong> <?= $_SESSION['success_message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?> <!-- Clear the message after showing -->
    <?php endif; ?>

    <!-- Button to open modal -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccommodationModal">
        <i class="fas fa-plus"></i> Add Accommodation
    </button>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-3">
        <?php
        $result = $conn->query("SELECT * FROM accommodations");
        while ($row = $result->fetch_assoc()):
            $accommodation_id = $row['id'];
            $options_result = $conn->query("SELECT extra_options.name FROM accommodation_options 
                                            JOIN extra_options ON accommodation_options.option_id = extra_options.id 
                                            WHERE accommodation_options.accommodation_id = $accommodation_id");
            $options_list = [];
            while ($option = $options_result->fetch_assoc()) {
                $options_list[] = $option['name'];
            }
        ?>
        <div class="col">
            <div class="card location-card shadow-sm">
                <?php if (!empty($row['image_path'])): ?>
                <img src="uploads/<?= htmlspecialchars($row['image_path']) ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                <?php else: ?>
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 180px;">
                    <i class="fas fa-image fa-3x"></i>
                </div>
                <?php endif; ?>
                
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                    <p class="text-muted">Capacity: <?= $row['capacity'] ?> people</p>
                    <p class="text-muted">Price: €<?= number_format($row['price_per_night'], 2) ?>/night</p>
                    <p class="text-muted">Extras: <?= empty($options_list) ? 'None' : implode(', ', $options_list) ?></p>
                    
                    <div class="d-flex justify-content-between">
                        <!-- Edit Button to Open Modal with Data -->
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editAccommodationModal" 
                           data-id="<?= $row['id'] ?>"
                           data-name="<?= htmlspecialchars($row['name']) ?>"
                           data-price="<?= $row['price_per_night'] ?>"
                           data-capacity="<?= $row['capacity'] ?>"
                           data-description="<?= htmlspecialchars($row['description']) ?>"
                           data-image="<?= htmlspecialchars($row['image_path']) ?>"
                           data-options="<?= implode(',', $options_list) ?>">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <a href="delete_accommodation.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?');">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Add Accommodation Modal -->
<div class="modal fade" id="addAccommodationModal" tabindex="-1" aria-labelledby="addAccommodationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAccommodationModalLabel"><i class="fas fa-plus"></i> Add Accommodation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Accommodation Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price_per_night" class="form-label">Price per Night (€)</label>
                        <input type="number" step="0.01" class="form-control" id="price_per_night" name="price_per_night" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="extra_options" class="form-label">Extra Options</label>
                        <div id="extra_options">
                            <?php foreach ($options as $option): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extra_options[]" id="option<?= $option['id'] ?>" value="<?= $option['id'] ?>">
                                    <label class="form-check-label" for="option<?= $option['id'] ?>">
                                        <?= htmlspecialchars($option['name']) ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Accommodation Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Accommodation Modal -->
<div class="modal fade" id="editAccommodationModal" tabindex="-1" aria-labelledby="editAccommodationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAccommodationModalLabel"><i class="fas fa-edit"></i> Edit Accommodation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Accommodation Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-price_per_night" class="form-label">Price per Night (€)</label>
                        <input type="number" step="0.01" class="form-control" id="edit-price_per_night" name="price_per_night" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-capacity" class="form-label">Capacity</label>
                        <input type="number" class="form-control" id="edit-capacity" name="capacity" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-extra_options" class="form-label">Extra Options</label>
                        <div id="edit-extra_options">
                            <?php foreach ($options as $option): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extra_options[]" id="edit-option<?= $option['id'] ?>" value="<?= $option['id'] ?>">
                                    <label class="form-check-label" for="edit-option<?= $option['id'] ?>">
                                        <?= htmlspecialchars($option['name']) ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-image" class="form-label">Accommodation Image</label>
                        <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Edit Modal JavaScript
    const editModal = document.getElementById('editAccommodationModal');
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const price = button.getAttribute('data-price');
        const capacity = button.getAttribute('data-capacity');
        const description = button.getAttribute('data-description');
        const image = button.getAttribute('data-image');
        const options = button.getAttribute('data-options').split(',');

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-price_per_night').value = price;
        document.getElementById('edit-capacity').value = capacity;
        document.getElementById('edit-description').value = description;

        // Set the image (optional)
        if (image) {
            document.getElementById('edit-image').value = image;
        }

        // Select the appropriate options
        options.forEach(optionId => {
            const checkbox = document.getElementById('edit-option' + optionId);
            if (checkbox) checkbox.checked = true;
        });
    });
</script>
</body>
</html>
