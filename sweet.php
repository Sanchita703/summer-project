<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the category table where name is equal to 'sweet'
$sql = "SELECT ID, Product_Name, Catagory, Quantity, Price, image_path FROM adding_product WHERE Catagory = 'Sweet'";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>    
</form>
    
    <section class="products" id="products">
        <h1 class="heading"> Sweet Products</h1>

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
                                <a href="#" class="btn" onclick="addToCart(<?php echo htmlspecialchars($product['ID']); ?>)">Add to cart</a>
                            </div>
                        </section>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

         :root{
    --orange:#ff7800;
    --black:#130f40;
    --light-color:#666;
    --box-shadow:0 .5rem 1.5rem rgba(0,0,0,.1);
    --border:.2rem solid rgba(0,0,0,.1);
    --outline:.1rem solid rgba(0,0,0,.1);
    --outline-hover:.2rem solid var(--black);
    --maroon:#8B0000;

    
}
*{
    font-family: 'Poppins',sans-serif;
    margin: 0;padding: 0;
    box-sizing:border-box ;
    outline: none;border: none;
    text-decoration: none;
    text-transform: capitalize;
    transition: all .2s linear;
}
        html{
    font-size: 62.5%;
    overflow-x: hidden;
    scroll-behavior: smooth;
    scroll-padding-top: 7rem;
}

body{
   background: #eee;
}
section{
    padding: 2rem .9%;
}
.btn{
    margin-top: .1rem;
    display: inline-block;
    padding: .8rem .3rem;
    font-size: 1.7rem;
    border-radius: .5rem;
    border:.2rem solid var(--black);
    color:var(--black);
    cursor: pointer;
    background: none;


}
.btn:hover{
    background: var(--maroon);
    color:#fff ;
}

        .products .product-slider{
    padding: 1rem;
}

.products  .product-slider:first-child{
    margin-bottom: 2rem;
}

.products .product-slider .box{
    background: #fff;
    border-radius: .5rem;
    text-align: center;
    padding: 1rem 1rem;
    outline-offset: -1rem;
    outline: var(--outline);
    box-shadow: var(--box-shadow);
    transition: .2s linear;

}
.products .product-slider .box:hover{
    outline-offset: 0rem;
    outline: var(--outline-hover);
}
.products .product-slider .box img{
    width: 20rem;
    height: 15rem;

}
.products .product-slider .box h3{
    font-size: 2.5rem;
    color: var(--black);
}

.products .product-slider .box .price{
    font-size: 2rem;
    color: var(--light-color);
    padding: .5rem 0;
}


        .cart-container {
            position: relative;
            display: inline-block;
        }

        #cart-btn {
            font-size: 24px;
            cursor: pointer;
            position: relative;
        }

        #cart-count {
            
            color: white;
            border-radius: 50%;
            height:10px;
            width:10px;
            position: absolute;
            
            font-size: 12px;
            display: inline-block;
        }

        .notification {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #444;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }
    </style>
</body>
</html>