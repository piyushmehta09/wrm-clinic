<?php
require_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $content = isset($_POST['content']) ? $conn->real_escape_string($_POST['content']) : "";
    $imageName = '';

    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "uploads/";  
        $targetFile = $targetDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            die("Error uploading image. Check folder permissions.");
        }
    }

    // Check if there's existing data in the "about" table
    $result = $conn->query("SELECT * FROM about ORDER BY created_at DESC LIMIT 1");

    if ($result->num_rows > 0) {
        // Update latest record
        if (!empty($imageName)) {
            $sql = "UPDATE about SET content='$content', image='$imageName', updated_at=NOW() ORDER BY created_at DESC LIMIT 1";
        } else {
            $sql = "UPDATE about SET content='$content', updated_at=NOW() ORDER BY created_at DESC LIMIT 1";
        }
    } else {
        // Insert new record
        $imageValue = !empty($imageName) ? "'$imageName'" : "NULL";
        $sql = "INSERT INTO about (content, image, created_at, updated_at) VALUES ('$content', $imageValue, NOW(), NOW())";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: mission.php?success=1"); 
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
