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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['Product_Name']) && isset($_POST['Catagory']) && isset($_POST['Quantity']) && isset($_POST['Price'])) {
        $id = $conn->real_escape_string($_POST['id']);
        $Product_Name = $conn->real_escape_string($_POST['Product_Name']);
        $Catagory = $conn->real_escape_string($_POST['Catagory']);
        $Quantity = $conn->real_escape_string($_POST['Quantity']);
        $Price = $conn->real_escape_string($_POST['Price']);

        // Update product in the database
        $sql = "UPDATE adding_product SET Product_Name='$Product_Name', Catagory='$Catagory', Quantity=$Quantity, Price=$Price WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Product updated successfully";
        } else {
            echo "Error updating product: " . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }

    // Close connection
    $conn->close();
}
?>
