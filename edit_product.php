<?php
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

$product = null; // Initialize $product to avoid undefined variable error

// Fetch product details if Product_name is set
if (isset($_GET['Product_name'])) {
    $product_name = $conn->real_escape_string($_GET['Product_name']);
    $sql = "SELECT * FROM adding_product WHERE Product_Name = '$product_name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    }
}

// Fetch distinct categories
$sql_categories = "SELECT DISTINCT Name FROM catagories";
$result_categories = $conn->query($sql_categories);
$categories = [];
if ($result_categories->num_rows > 0) {
    while($row = $result_categories->fetch_assoc()) {
        $categories[] = $row['Name'];
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Id']) && isset($_POST['Product_Name']) && isset($_POST['Catagory']) && isset($_POST['Quantity']) && isset($_POST['Price'])) {
        $Id = $conn->real_escape_string($_POST['Id']);
        $Product_Name = $conn->real_escape_string($_POST['Product_Name']);
        $Catagory = $conn->real_escape_string($_POST['Catagory']);
        $Quantity = $conn->real_escape_string($_POST['Quantity']);
        $Price = $conn->real_escape_string($_POST['Price']);

        // Update product in database
        $sql = "UPDATE adding_product SET Product_Name='$Product_Name', Catagory='$Catagory', Quantity='$Quantity', Price='$Price' WHERE Id='$Id'";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Product updated successfully');
                    window.location.href = 'admin.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Error updating product: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url("image/banner.webp");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="number"], select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #800000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #400000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <?php if ($product): ?>
        <form method="POST" action="">
            <input type="hidden" name="Id" value="<?php echo htmlspecialchars($product['Id']); ?>">
            
            <label for="Product_Name">Product Name:</label>
            <input type="text" id="Product_Name" name="Product_Name" value="<?php echo htmlspecialchars($product['Product_Name']); ?>" required>
            
            <label for="Catagory">Product Category:</label>
            <select id="Catagory" name="Catagory" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category); ?>" <?php if ($category == $product['Catagory']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($category); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="Quantity">Product Quantity:</label>
            <input type="number" id="Quantity" name="Quantity" value="<?php echo htmlspecialchars($product['Quantity']); ?>" required>

            <label for="Price">Product Price:</label>
            <input type="number" id="Price" name="Price" value="<?php echo htmlspecialchars($product['Price']); ?>" required>
            
            <input type="submit" value="Update Product">
        </form>
        <?php else: ?>
        <p>Product not found or no product name provided.</p>
        <?php endif; ?>
    </div>
</body>
</html>
