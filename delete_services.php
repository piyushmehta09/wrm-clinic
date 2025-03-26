<?php
require_once("connection.php");

if (isset($_GET['name'])) {
    $image_name = $conn ->real_escape_string($_GET['name']);
    echo "trying to delete:" . $image_name . "<br>";
    
    $result = $conn->query("SELECT * FROM services WHERE image_name = '$image_name'");
    if ($result->num_rows > 0) {
        $sql = "DELETE from services where image_name = '$image_name'";
        if ($conn->query($sql) === TRUE) {
            header("location: services.php?deleted=1");
            exit;
        } else {
            die("error deleting product: " . $conn->error);
        }
        } else {
            die("error: product not found");
        } 
      }


  header("Location: services.php");
  exit();
  
?>
