<?php
require_once("connection.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request. Image ID is required.");
}

$id = $_GET['id'];


$result = $conn->query("SELECT * FROM gallery WHERE id = $id");

if ($result->num_rows == 0) {
    die("Image not found.");
}

$row = $result->fetch_assoc();
$oldImage = "uploads/" . $row['image'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $imageName = basename($_FILES["image"]["name"]);
    $targetDir = "uploads/";
    $targetFile = $targetDir . $imageName;


    if (file_exists($oldImage)) {
        unlink($oldImage);
    }


    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("UPDATE gallery SET image = ?, uploaded_at = NOW() WHERE id = ?");
        $stmt->bind_param("si", $imageName, $id);

        if ($stmt->execute()) {
            header("Location: gallery.php?updated=1");
            exit;
        } else {
            die("Database Error: " . $conn->error);
        }
    } else {
        die("Image Upload Failed!");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Image</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Image</h2>
        <form action="update_gallery.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" width="200" class="mb-3"><br>
            <input type="file" name="image" required>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</body>
</html>
