<?php
include 'adminconn.php';

if (isset($_GET['User_id'])) {
    $user_id = $_GET['User_id'];

    $sql = "SELECT * from 'cart' where user_id='User_id'";

    $result = $conn->query($sql);
    $sqlUser = "SELECT user_name FROM login WHERE User_id = '$user_id'";
    $userResult = $conn->query($sqlUser);
    $user = $userResult->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders for <?php echo $user['Username']; ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Orders for <?php echo $user['Username']; ?></h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['order_id']}</td>
                            <td>{$row['product_id']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['total_price']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No orders found for this user</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="user.php">Back to Users</a>
</body>
</html>

<?php
$conn->close();
?>
