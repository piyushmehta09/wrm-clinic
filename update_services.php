<?php
require_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $imageName = '';
    $originalImageName = isset($_POST['image_name']) ? $conn->real_escape_string($_POST['image_name']) : '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        $targetFile = $targetDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            die("Error uploading image. Check folder permissions.");
        }
    }

    $sql = "";

    // Check if there's an existing record in 'services' table
    $result = $conn->query("SELECT * FROM services ORDER BY created_at DESC LIMIT 1");
    
    if ($result->num_rows > 0) {
        // Update the latest existing record instead of inserting a new one
        $row = $result->fetch_assoc();
        $existingImage = $row['image'];
        $existingImageName = $row['image_name'];

        $imageToUpdate = !empty($imageName) ? $imageName : $existingImage;
        $nameToUpdate = !empty($originalImageName) ? $originalImageName : $existingImageName;

        $sql = "UPDATE services SET image='$imageToUpdate', image_name='$nameToUpdate', updated_at=NOW() ORDER BY created_at DESC LIMIT 1";
    } else {
        // Insert new record if no data exists
        if (!empty($imageName) || !empty($originalImageName)) {
            $imageValue = !empty($imageName) ? "'$imageName'" : "NULL";
            $nameValue = !empty($originalImageName) ? "'$originalImageName'" : "NULL";
            $sql = "INSERT INTO services (image, image_name, created_at, updated_at) VALUES ($imageValue, $nameValue, NOW(), NOW())";
        }
    }

    // Execute query only if it's not empty
    if (!empty($sql)) {
        if ($conn->query($sql) === TRUE) {
            header("Location: services.php?success=1");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "No new data uploaded.";
    }
}
?>
