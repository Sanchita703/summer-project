<?php
include("adminconn.php");
if (isset($_GET['Id'])) {
    $id = $conn->real_escape_string($_GET['Id']);
    $sql = "DELETE FROM adding_product WHERE Id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_product.php");
        exit(); 
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "No product ID provided";
}
$conn->close();
?>
