<?php
session_start();
header('Content-Type: application/json');

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$user_id = $_SESSION['user_id']; // Assume the user is logged in and user_id is stored in session
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['item_id']) && isset($input['quantity'])) {
    $item_id = $input['item_id'];
    $quantity = $input['quantity'];

    // Update quantity in the cart
    $sql = "UPDATE cart SET Quantity = ? WHERE Id = ? AND User_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $item_id, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cart updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
?>
