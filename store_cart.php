<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming the productId is sent via POST request
$productId = $_POST['productId'];

// Insert the productId into the database
$sql = "INSERT INTO cart (product_id) VALUES ('$productId')";

if ($conn->query($sql) === TRUE) {
    $response = array("success" => true);
    echo json_encode($response);
} else {
    $response = array("success" => false);
    echo json_encode($response);
}

$conn->close();
?>
