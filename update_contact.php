<?php
require_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $tel = $conn->real_escape_string($_POST['tel']);
    $fax = $conn->real_escape_string($_POST['fax']);
    $address = $conn->real_escape_string($_POST['address']);
    $email = $conn->real_escape_string($_POST['email']);

    $result = $conn->query("SELECT * FROM contact LIMIT 1");
    
    if ($result->num_rows > 0) {
        $sql = "UPDATE contact SET tel='$tel', fax='$fax', address='$address', email='$email' LIMIT 1";
    } else {
        $sql = "INSERT INTO contact (tel, fax, address, email) VALUES ('$tel', '$fax', '$address', '$email')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: contact.php?success=1");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
