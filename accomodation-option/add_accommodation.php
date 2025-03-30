<?php
include "config.php";

// Fetch extra options
$options_result = $conn->query("SELECT * FROM extra_options");
$options = [];
while ($option = $options_result->fetch_assoc()) {
    $options[] = $option;

}

// Handle form submission for adding accommodation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price_per_night = $_POST['price_per_night'];
    $capacity = $_POST['capacity'];
    $selected_options = isset($_POST['extra_options']) ? $_POST['extra_options'] : [];

    // Insert accommodation into the database
    $stmt = $conn->prepare("INSERT INTO accommodations (name, description, price_per_night, capacity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $name, $description, $price_per_night, $capacity);
    if ($stmt->execute()) {
        $accommodation_id = $stmt->insert_id;

        // Insert selected extra options for this accommodation
        foreach ($selected_options as $option_id) {
            $stmt = $conn->prepare("INSERT INTO accommodation_options (accommodation_id, option_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $accommodation_id, $option_id);
            $stmt->execute();
        }

        $_SESSION['success_message'] = "Accommodation added successfully!";
        header("Location: manage_accommodations.php");  // Redirect after successful insert
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
    <title>Add Accommodation</title>
</head>
<body>
    <h1>Add New Accommodation</h1>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Accommodation Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Price per Night</label>
            <input type="number" class="form-control" name="price_per_night" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" class="form-control" name="capacity" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Extra Options</label>
            <select class="form-control" name="extra_options[]" multiple>
                <?php foreach ($options as $option): ?>
                    <option value="<?= $option['id'] ?>"><?= htmlspecialchars($option['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Accommodation</button>
    </form>
</body>
</html>
