<?php
include 'adminconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Delete the item from the cart table
    $delete_query = "DELETE FROM cart WHERE Id = $id";
    if (mysqli_query($conn, $delete_query)) {
        echo "Item removed successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
