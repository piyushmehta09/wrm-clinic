<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

// echo "PHP is running...<br>";


$host = "localhost";
$username = "root"; 
$password = "@Mehta7773"; 
$database = "wrm-clinic"; 

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
