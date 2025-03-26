<?php
require_once("connection.php");

// Fetch images from database
$result = $conn->query("SELECT id, image FROM gallery ORDER BY created_at DESC");

// Debugging: Check if data is retrieved
if (!$result) {
    die("Query failed: " . $conn->error);
} elseif ($result->num_rows == 0) {
    echo "<p class='text-center text-danger'>No images found in the gallery.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("includes/head.php"); ?>
<body>
    <div class="wrapper">
        <?php include("includes/navigation-bar.php"); ?>

        <div id="body" class="active">
            <?php include("includes/navbar.php"); ?>

            <div class="content p-4">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Gallery</h3>
                        <a href="add_gallery.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add Image</a>
                    </div>

                    <div class="row">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <img src="<?php echo file_exists('uploads/'.$row['image']) ? 'uploads/'.$row['image'] : 'images/placeholder.jpg'; ?>" class="card-img-top" height="200">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Image: <?php echo htmlspecialchars($row['image']); ?></h5>
                                        <?php if (isset($row['id'])): ?>
                                            <a href="update_gallery.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                            <a href="delete_gallery.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a>
                                        <?php else: ?>
                                            <p class="text-danger">ID not found</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/script.php"); ?>
</body>
</html>
