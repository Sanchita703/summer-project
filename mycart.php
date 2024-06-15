<?php
include 'adminconn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['remove_product'])) {
        $product_id = $_POST['product_id'];
        $delete_query = "DELETE FROM cart WHERE Id = $product_id";
        if (!mysqli_query($conn, $delete_query)) {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['update_quantity'])) {
        $product_id = $_POST['product_id'];
        $new_quantity = $_POST['quantity'];
        
        // Check if new quantity is less than or equal to available stock
        $check_stock_query = "SELECT Quantity FROM cart WHERE Id = $product_id";
        $check_stock_result = mysqli_query($conn, $check_stock_query);
        $current_stock = mysqli_fetch_assoc($check_stock_result)['Quantity'];

        if ($new_quantity > $current_stock) {
            echo "Error: Cannot add quantity more than available stock.";
        } else {
            // Update the quantity of the product in the cart table
            $update_query = "UPDATE cart SET Quantity = $new_quantity WHERE Id = $product_id";
            if (!mysqli_query($conn, $update_query)) {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } elseif (isset($_POST['empty_cart'])) {
        // Empty the cart table
        $empty_cart_query = "DELETE FROM cart";
        if (mysqli_query($conn, $empty_cart_query)) {
            header("Location: asd.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['place_order'])) {
        header("Location: order.php");
        exit();
    }
}
$query = "SELECT * FROM cart";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <div class="container">
        <h1>My Cart</h1>
        <div class="error-msg">
            <?php
            if (isset($error_message)) {
                echo $error_message;
            }
            ?>
        </div>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Total Price</th><th>Action</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                $total_price = $row['Price'] * $row['Quantity'];
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['Name']) . '</td>';
                echo '<td>Rs. ' . htmlspecialchars($row['Price']) . '</td>';
                echo '<form method="POST" action="">';
                echo '<td>';
                echo '<input type="hidden" name="product_id" value="' . $row['Id'] . '">';
                echo '<input type="number" name="quantity" value="' . htmlspecialchars($row['Quantity']) . '" min="1" max="' . $row['Quantity'] . '">';
                echo '</td>';
                echo '<td>Rs. ' . $total_price . '</td>';
                echo '<td>';
                echo '<input type="submit" name="update_quantity" value="Update">';
                echo '<input type="submit" name="remove_product" value="Remove">';
                echo '</td>';
                echo '</form>';
                echo '</tr>';
            }
            echo '</table>';
            $grand_total_query = "SELECT SUM(Price * Quantity) as GrandTotal FROM cart";
            $grand_total_result = mysqli_query($conn, $grand_total_query);
            $grand_total_row = mysqli_fetch_assoc($grand_total_result);
            echo '<h3>Grand Total: Rs. ' . $grand_total_row['GrandTotal'] . '</h3>';
            echo '<form method="POST" action="" class="cart-actions">';
            echo '<input type="submit" name="empty_cart" value="Empty Cart" class="action-btn empty-cart">';
            echo '<input type="submit" name="place_order" value="Place Order" class="action-btn place-order">';
            echo '</form>';
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
