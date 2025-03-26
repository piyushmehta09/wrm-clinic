<?php
require_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $content = $conn->real_escape_string($_POST['content']);
    $imageName = '';


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        $targetFile = $targetDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            echo "Error uploading image.";
            exit;
        }
    }

    
    $result = $conn->query("SELECT * FROM about ORDER BY created_at DESC LIMIT 1");
    
    if ($result->num_rows > 0) {
        
        if (!empty($imageName)) {
            $sql = "UPDATE about SET content='$content', image='$imageName', updated_at=NOW() ORDER BY created_at DESC LIMIT 1";
        } else {
            $sql = "UPDATE about SET content='$content', updated_at=NOW() ORDER BY created_at DESC LIMIT 1";
        }
    } else {
        
        $sql = "INSERT INTO about (content, image, created_at, updated_at) VALUES ('$content', '$imageName', NOW(), NOW())";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: about.php?success=1"); 
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
