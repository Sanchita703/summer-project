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
    if (isset($_POST['Id']) && isset($_POST['Product_Name']) && isset($_POST['Category']) && isset($_POST['Quantity']) && isset($_POST['Price']) && isset($_FILES['Product_Image'])) {
        $Id = $conn->real_escape_string($_POST['Id']);
        $Product_Name = $conn->real_escape_string($_POST['Product_Name']);
        $Category = $conn->real_escape_string($_POST['Category']);
        $Quantity = $conn->real_escape_string($_POST['Quantity']);
        $Price = $conn->real_escape_string($_POST['Price']);

        // File upload path
        $target_dir = "image/";
        $target_file = $target_dir . basename($_FILES["Product_Image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Check if file is an actual image or fake image
        $check = getimagesize($_FILES["Product_Image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES["Product_Image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["Product_Image"]["tmp_name"], $target_file)) {
                // File uploaded successfully, proceed with database insertion

                // Check if quantity and price are not negative
                if ($Quantity >= 0 && $Price >= 0) {
                    // Insert product into database
                    $sql = "INSERT INTO adding_product (ID, Product_Name, Catagory, Quantity, Price, image_path) VALUES ('$Id', '$Product_Name', '$Category', '$Quantity', '$Price', '$target_file')";

                    if ($conn->query($sql) === TRUE) {
                        echo '<script>alert("New product added successfully"); window.location.href = "admin.php";</script>';
                        exit;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Quantity and Price cannot be negative.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "All fields are required.";
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
    <title>Add Product</title>
    <link rel="stylesheet"href="admin.css">
</head>
<body>
    <div class="container">
        <h2>Add New Product</h2>
        <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="Id">Id:</label>
            <input type="number" id="Id" name="Id" required>
            
            <label for="Product_Name">Product Name:</label>
            <input type="text" id="Product_Name" name="Product_Name" required>
            
            <label for="Category">Product Category:</label>
            <select id="Category" name="Category" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category); ?>">
                        <?php echo htmlspecialchars($category); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="Quantity">Product Quantity:</label>
            <input type="number" id="Quantity" name="Quantity" required>
            <span id="quantity-error" class="error-message">Quantity cannot be negative.</span>

            <label for="Price">Product Price:</label>
            <input type="number" id="Price" name="Price" step="0.01" required>
            <span id="price-error" class="error-message">Price cannot be negative.</span>
            
            <label for="Product_Image">Product Image:</label>
            <input type="file" id="Product_Image" name="Product_Image" accept="image/*" required>
            <span id="image-error" class="error-message">Image is required.</span>
            
            <input type="submit" value="Add Product">
        </form>
    </div>

    <script> 
        document.getElementById("Quantity").addEventListener("blur", function() {
            var quantity = parseInt(this.value);
            var quantityError = document.getElementById("quantity-error");
            if (quantity < 0) {
                quantityError.style.display = "block";
            } else {
                quantityError.style.display = "none";
            }
        });
        document.getElementById("Price").addEventListener("blur", function() {
            var price = parseFloat(this.value);
            var priceError = document.getElementById("price-error");
            if (price < 0) {
                priceError.style.display = "block";
            } else {
                priceError.style.display = "none";
            }
        });
        function validateForm() {
            var quantity = parseInt(document.getElementById("Quantity").value);
            var price = parseFloat(document.getElementById("Price").value);
            var image = document.getElementById("Product_Image").value;
            var quantityError = document.getElementById("quantity-error");
            var priceError = document.getElementById("price-error");
            var imageError = document.getElementById("image-error");
            var isValid = true;
            if (quantity < 0) {
                quantityError.style.display = "block";
                isValid = false;
            } else {
                quantityError.style.display = "none";
            }
            if (price < 0) {
                priceError.style.display = "block";
                isValid = false;
            } else {
                priceError.style.display = "none";
            }
            if (!image) {
                imageError.style.display = "block";
                isValid = false;
            } else {
                imageError.style.display = "none";
            }

            return isValid;
        }
    </script>
</body>
</html>
