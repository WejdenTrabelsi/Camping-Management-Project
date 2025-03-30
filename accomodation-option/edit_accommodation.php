<?php
include "config.php";

// Fetch extra options
$options_result = $conn->query("SELECT * FROM extra_options");
$options = [];
while ($option = $options_result->fetch_assoc()) {
    $options[] = $option;
}

// Fetch accommodation data
if (isset($_GET['id'])) {
    $accommodation_id = $_GET['id'];
    $accommodation_result = $conn->query("SELECT * FROM accommodations WHERE id = $accommodation_id");
    $accommodation = $accommodation_result->fetch_assoc();

    // Fetch selected extra options for this accommodation
    $selected_options_result = $conn->query("SELECT option_id FROM accommodation_options WHERE accommodation_id = $accommodation_id");
    $selected_options = [];
    while ($row = $selected_options_result->fetch_assoc()) {
        $selected_options[] = $row['option_id'];
    }
} else {
    echo "Accommodation not found.";
    exit;
}

// Handle form submission for updating accommodation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price_per_night = $_POST['price_per_night'];
    $capacity = $_POST['capacity'];
    $selected_options = isset($_POST['extra_options']) ? $_POST['extra_options'] : [];

    // Update accommodation data
    $stmt = $conn->prepare("UPDATE accommodations SET name = ?, description = ?, price_per_night = ?, capacity = ? WHERE id = ?");
    $stmt->bind_param("ssdii", $name, $description, $price_per_night, $capacity, $accommodation_id);
    if ($stmt->execute()) {
        // Delete existing options for this accommodation
        $conn->query("DELETE FROM accommodation_options WHERE accommodation_id = $accommodation_id");

        // Insert selected extra options for this accommodation
        foreach ($selected_options as $option_id) {
            $stmt = $conn->prepare("INSERT INTO accommodation_options (accommodation_id, option_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $accommodation_id, $option_id);
            $stmt->execute();
        }

        $_SESSION['success_message'] = "Accommodation updated successfully!";
        header("Location: manage_accommodations.php");  // Redirect after successful update
        exit;
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Accommodation</title>
</head>
<body>
    <h1>Edit Accommodation</h1>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Accommodation Name</label>
            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($accommodation['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required><?= htmlspecialchars($accommodation['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Price per Night</label>
            <input type="number" class="form-control" name="price_per_night" value="<?= $accommodation['price_per_night'] ?>" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" class="form-control" name="capacity" value="<?= $accommodation['capacity'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Extra Options</label>
            <select class="form-control" name="extra_options[]" multiple>
                <?php foreach ($options as $option): ?>
                    <option value="<?= $option['id'] ?>" <?= in_array($option['id'], $selected_options) ? 'selected' : '' ?>><?= htmlspecialchars($option['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</body>
</html>
