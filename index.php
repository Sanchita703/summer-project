


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Website</title>
        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" type ="text/css" href="style.css">
    </head>
    <body>
        <header class="header">

            <a href="#" class="logo"><i class="fas fa-shopping-basket">Titaura</i></a>

            <nav class="navbar">
                <a href="#home">home</a>
                <a href="#products">product</a>
                <a href="#catagories">catagories</a>
                <a href="#review">review</a>
                <a href="login.php">login</a>
            </nav>

            
            <div class="icons">
        <a href="login.php" class="btn">My Cart</a>
            </div>
            
            <form action="login.php" class="login-form">
    <h3> Login Now</h3>
</form>
        </header>
        <section class="home" id="home">
            <div class="content">
                <h3 >High Quality and Great Taste Products for you</h3>
                <h1 class="heading"><span> Sweet Spicy Tangy </span> </h1>
            </div>
        </section>
 <?php

//fetch product
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

$conn->close();
?>    
     <!--product-->
    <section class="products" id="products">
        <h1 class="heading"> Our <span>Products</span> </h1>
        <a href="viewallproduct.php">View All Products </a>
        <div class="swiper product-slider">
            <div class="swiper-wrapper" id="product-container">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <section class="product">
                            <div class="swiper-slide box">
                                <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['Product_Name']); ?>">
                                <h3><?php echo htmlspecialchars($product['Product_Name']); ?></h3>
                                <div class="price">Rs.<?php echo htmlspecialchars($product['Price']); ?>/-</div>
                                <div class="quantity">Quantity: <?php echo htmlspecialchars($product['Quantity']); ?></div>
                                <a href="login.php" class="btn" onclick="addToCart(<?php echo htmlspecialchars($product['ID']); ?>)">Add to cart</a>
                            </div>
                        </section>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
     <!--product-->
        <!--categories -->
        <section class="catagories" id="catagories">

            <h1 class="heading">Product<span>Categories</span></h1>
            <a href="view_catagories.php">View All Cata </a>

            <div class="box-container">
                <div class="box">
                    <img src="" alt="">
                    <h3>Sweet</h3>
                    <a href="login.php" class="btn">Shop now</a>

                </div>
                <div class="box">
                    <img src="" alt="">
                    <h3>Spicy</h3>
                    <a href="login.php" class="btn">Shop now</a>

                </div>
                <div class="box">
                    <img src="" alt="">
                    <h3>Tangy</h3>
                    <a href="login.php" class="btn">Shop now</a>

                </div>
                <div class="box">
                    <img src="" alt="">
                    <h3>Salty</h3>
                    <a href="login.php" class="btn">Shop now</a>

                </div>
            </div>
        </section>
        <!--catagories -->
        <!-- Reviews -->
<section class="review" id="review">
    <h1 class="heading">Customer's<span>Review</span></h1>

    <?php
    // Connect to database (replace with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "admin"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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

    // Close connection
    $conn->close();
    ?>

<div class="give-review-container">
    <a href="login.php" class="give-review-btn">Give Review</a></div>
    </section>
        <!--review -->
        <!--footer -->
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
        <!--footer -->      
      <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    </body>
</html>