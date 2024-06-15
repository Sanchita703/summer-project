<?php
session_start(); // Start session to access session variables

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Include database connection
include 'adminconn.php';

// Retrieve cart items from the database for the logged-in user
$user_id = $_SESSION['user_id'];
$cart_query = "SELECT c.Id, p.Name, p.Price, c.Quantity FROM cart c INNER JOIN products p ON c.ProductId = p.Id WHERE c.UserId = $user_id";
$cart_result = mysqli_query($conn, $cart_query);

// Check if cart is not empty
if (mysqli_num_rows($cart_result) > 0) {
    // Display order details
    echo "<h1>Order Summary</h1>";
    echo "<table>";
    echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>";
    $grand_total = 0; // Initialize grand total
    while ($row = mysqli_fetch_assoc($cart_result)) {
        $total_price = $row['Price'] * $row['Quantity'];
        $grand_total += $total_price; // Accumulate total price for each item
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
        echo "<td>Rs. " . htmlspecialchars($row['Price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
        echo "<td>Rs. " . $total_price . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<h3>Grand Total: Rs. " . $grand_total . "</h3>";

    // Display order form
    echo "<h2>Place Your Order</h2>";
    echo "<form method='POST' action='adminpage.php'>";
    echo "<input type='hidden' name='user_id' value='$user_id'>";
    echo "<label for='customer_name'>Full Name:</label>";
    echo "<input type='text' id='customer_name' name='customer_name' required><br>";
    echo "<label for='customer_email'>Email:</label>";
    echo "<input type='email' id='customer_email' name='customer_email' required><br>";
    echo "<label for='customer_address'>Address:</label>";
    echo "<textarea id='customer_address' name='customer_address' required></textarea><br>";
    echo "<label for='customer_phone'>Phone Number:</label>";
    echo "<input type='tel' id='customer_phone' name='customer_phone' required><br>";
    echo "<input type='submit' name='place_order' value='Place Order'>";
    echo "</form>";
} else {
    echo "<p>Your cart is empty. Please add items before placing an order.</p>";
}

// Close database connection
mysqli_close($conn);
?>
