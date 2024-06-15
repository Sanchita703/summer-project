<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT ID, Product_Name, Catagory, Quantity, Price, image_path FROM adding_product LIMIT 6";
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "No products found";
}
if (isset($_POST['add_to_cart'])) {
    $products_name = $_POST['Product_Name'];
    $products_price = $_POST['Price'];
    $products_quantity = $_POST['Quantity'];

    // Check if the product is already in the cart
    $check_query = "SELECT * FROM cart WHERE Name = '$products_name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $display_msg = "Product is already in the cart.";
    } else {
        // Assuming 'user_id' is a required field in 'cart' table and using a placeholder value '1'
        $query = "INSERT INTO cart (Name, Price, Quantity, user_id) VALUES ('$products_name', '$products_price', '$products_quantity', '1')";
        if (mysqli_query($conn, $query)) {
            $display_msg = "Product added successfully";
        } else {
            $display_msg = "Error: " . mysqli_error($conn);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="search.css">
</head>
<body>
    <header class="header">
        <a href="#" class="logo"><i class="fas fa-shopping-basket">Titaura</i></a>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#products">product</a>
            <a href="#catagories">catagories</a>
            <a href="#review">review</a>
            <a href="login.php">log Out</a>
        </nav>
        <div class="icons">
        <a href="mycart.php" class="btn">My Cart</a>
            </div>
        <form action="index.php" class="login-form">
            <h3> Log Out</h3>
        </form>
        </header>

    <!--home-->
    <section class="home" id="home">

        <div class="content">

            <h3>High Quality and Great Taste Products for you</h3>
            <h1 class="heading"><span> Sweet Spicy Tangy </span> </h1>

        </div>
    </section>
    <!--product-->
    
<?php
if (!empty($display_msg)) {
    echo '<div class="display_msg">
            <span>' . $display_msg . '</span>
            <i class="fa fa-times" onclick="this.parentElement.style.display=\'none\'"></i>
          </div>';
}
?>
<section class="products" id="products">
        <h1 class="heading"> Our <span>Products</span> </h1>
        <a href="viewallproduct.php">View All Products </a>
        <div class="swiper product-slider">
            <div class="swiper-wrapper" id="product-container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM adding_product");
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                    <section class="product">
                        <form method="POST">
                            <div class="swiper-slide box">
                                <img src="<?php echo htmlspecialchars($fetch_products['image_path']); ?>" alt="<?php echo htmlspecialchars($fetch_products['Product_Name']); ?>">
                                <h3><?php echo htmlspecialchars($fetch_products['Product_Name']); ?></h3>
                                <div class="price">Rs.<?php echo htmlspecialchars($fetch_products['Price']); ?>/-</div>
                                <div class="quantity">Quantity: <?php echo htmlspecialchars($fetch_products['Quantity']); ?></div>
                                <input type="hidden" name="Product_Name" value='<?php echo htmlspecialchars($fetch_products['Product_Name']); ?>'>
                                <input type="hidden" name="Product_ID" value='<?php echo htmlspecialchars($fetch_products['ID']); ?>'>
                                <input type="hidden" name="Price" value='<?php echo htmlspecialchars($fetch_products['Price']); ?>'>
                                <input type="hidden" name="Quantity" value='<?php echo htmlspecialchars($fetch_products['Quantity']); ?>'>
                                <input type="submit" value="Add to Cart" class="btnAddAction" name="add_to_cart">
                            </div>
                        </form>
                    </section>
                    <?php
                }
            } else {
                echo "No Products";
            }
            ?>
        </div>
    </div>
</section>
<!--catagory-->
    <section class="catagories" id="catagories">

        <h1 class="heading">Product<span>Categories</span></h1>


        <div class="box-container">
            <div class="box">
                <img src="" alt="">
                <h3>Sweet</h3>
                <a href="sweet.php" class="btn">Shop now</a>

            </div>
            <div class="box">
                <img src="" alt="">
                <h3>Spicy</h3>
                <a href="spicy.php" class="btn">Shop now</a>

            </div>
            <div class="box">
                <img src="" alt="">
                <h3>Tangy</h3>
                <a href="tangy.php" class="btn">Shop now</a>

            </div>
            <div class="box">
                <img src="" alt="">
                <h3>Salty</h3>
                <a href="salty.php" class="btn">Shop now</a>

            </div>
        </div>
    </section>
    <section class="review" id="review">
    <h1 class="heading">Customer's<span>Review</span></h1>
    <?php
    

    // Fetch reviews from database
    $sql = "SELECT * FROM review ORDER BY Rating DESC LIMIT 5"; // Correct column names and remove unnecessary quotes
    $result = $conn->query($sql);

    // Check if query executed successfully
    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    // Display reviews if there are any
    if ($result->num_rows > 0) {
        echo '<div class="review-content">';
        while ($row = $result->fetch_assoc()) {
            echo "<div class='review-item'>";
            echo "<p>Rating: " . $row["Rating"] . " Stars</p>"; // Correct column name
            echo "<p>Review: " . $row["Review"] . "</p>"; // Correct column name
            echo "</div>";
        }
        echo '</div>';
    } else {
        echo "<p>No reviews yet.</p>";
    }

   ?>

<div class="give-review-container">
    <a href="submit_review.php" class="give-review-btn">Give Review</a></div>
    </section>
    <!--footer-->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3> Contact Info</h3>
                <a href="#" class="links"><i class="fas fa-phone"></i> 9816737883</a>
                <a href="#" class="links"><i class="fas fa-phone"></i> 011-6655372</a>
                <a href="#" class="links"><i class="fas fa-envelop"></i> Buddhapau@gmail.com</a>
                <a href="#" class="links"><i class="fas fa-map-marker-alt"></i> Sanga-14,Kavre,Nepal </a>
            </div>
            <div class="box">
                <h3> Quick links</h3>
                <a href="#" class="links"><i class="fas fa-arrow-right"></i>home</a>
                <a href="#" class="links"><i class="fas fa-arrow-right"></i>products</a>
                <a href="#" class="links"><i class="fas fa-arrow-right"></i>catagories</a>
                <a href="#" class="links"><i class="fas fa-arrow-right"></i>Review</a>
            </div>
        </div>
        </div>
        <div class="credit"> Created by <span>Sanchita Joshi </span></div>
    </section>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   </body>
</html>