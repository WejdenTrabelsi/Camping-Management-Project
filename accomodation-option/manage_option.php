<?php
session_start();  // Start the session to store success messages and errors
include "config.php";

// Fetch available extra options
$options_result = $conn->query("SELECT * FROM extra_options");
$options = [];
while ($option = $options_result->fetch_assoc()) {
    $options[] = $option;
}

// Display success or error messages
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $_SESSION['success_message'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['success_message']);  // Clear the message after displaying
}

if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $_SESSION['error_message'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['error_message']);  // Clear the error message after displaying
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Extra Options</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <h2><i class="fas fa-list me-2"></i> Manage Extra Options</h2>

    <!-- Button to open the modal for adding an option -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOptionModal">
        <i class="fas fa-plus"></i> Add Option
    </button>

    <!-- Table to display the extra options -->
    <div class="row row-cols-1 g-4 mt-3">
        <?php foreach ($options as $option): ?>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"> <?= htmlspecialchars($option['name']) ?> </h5>
                        <p class="card-text"> <?= htmlspecialchars($option['description']) ?> </p>
                        <p class="card-text"><strong>Price:</strong> $<?= number_format($option['price'], 2) ?></p>
                        <div class="d-flex justify-content-between">
                            <!-- Edit button that triggers the modal -->
                            <button class="btn btn-sm btn-outline-primary edit-option-btn"
                                data-id="<?= $option['id'] ?>"
                                data-name="<?= htmlspecialchars($option['name']) ?>"
                                data-description="<?= htmlspecialchars($option['description']) ?>"
                                data-price="<?= $option['price'] ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <!-- Delete button -->
                            <a href="delete_option.php?id=<?= $option['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this option?');">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal for Adding an Option -->
<div class="modal fade" id="addOptionModal" tabindex="-1" aria-labelledby="addOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOptionModalLabel"><i class="fas fa-plus"></i> Add Extra Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="add_option.php">
                    <div class="mb-3">
                        <label class="form-label">Option Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing an Option -->
<div class="modal fade" id="editOptionModal" tabindex="-1" aria-labelledby="editOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOptionModalLabel"><i class="fas fa-edit"></i> Edit Extra Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="edit_option.php">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label class="form-label">Option Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="edit-description" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" id="edit-price" name="price" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Populate the modal for editing an option when the edit button is clicked
document.querySelectorAll('.edit-option-btn').forEach(button => {
    button.addEventListener('click', function () {
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-name').value = this.dataset.name;
        document.getElementById('edit-description').value = this.dataset.description;
        document.getElementById('edit-price').value = this.dataset.price;
        new bootstrap.Modal(document.getElementById('editOptionModal')).show();
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
