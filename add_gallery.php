<?php
require_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $imageName = basename($_FILES["image"]["name"]);
    $targetDir = "uploads/";
    $targetFile = $targetDir . $imageName;


    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        die(" Image Upload Failed!");
    }


    $stmt = $conn->prepare("INSERT INTO gallery (image, created_at) VALUES (?, NOW())");
    $stmt->bind_param("s", $imageName);

    if ($stmt->execute()) {
        echo " Image inserted into database successfully!";
        header("Location: gallery.php?success=1");
        exit;
    } else {
        die(" Database Insert Error: " . $conn->error);
    }
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
                    <h3 class="mb-4">Add Image to Gallery</h3>
                    <form action="add_gallery.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Select Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Upload</button>
                        <a href="gallery.php" class="btn btn-secondary">Back to Gallery</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/script.php"); ?>
</body>
</html>
