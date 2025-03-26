<?php
require_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $content = $conn->real_escape_string($_POST['content']);
    $imageName = '';


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        $targetFile = $targetDir . $imageName;


        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {

        } else {
            echo "Error uploading image.";
            exit;
        }
    }


    $result = $conn->query("SELECT * FROM about WHERE id = '$id'");
    
    if ($result->num_rows > 0) {

        if (!empty($imageName)) {
            $sql = "UPDATE about SET content='$content', image='$imageName' WHERE id='$id'";
        } else {
            $sql = "UPDATE about SET content='$content' WHERE id='$id'";
        }
    } else {

        $sql = "INSERT INTO about (content, image) VALUES ('$content', '$imageName')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: about.php?success=1"); 
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
