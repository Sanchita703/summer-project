<?php
include("adminconn.php");
$category = null; 
if (isset($_GET['Name'])) {
    $name = $conn->real_escape_string($_GET['Name']);
    $sql = "SELECT * FROM catagories WHERE Name = '$name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Id']) && isset($_POST['Name']) && isset($_POST['Description'])) {
        $id = $conn->real_escape_string($_POST['Id']);
        $name = $conn->real_escape_string($_POST['Name']);
        $description = $conn->real_escape_string($_POST['Description']);
        $sql = "UPDATE catagories SET Name='$name', Description='$description' WHERE Id='$id'";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Category updated successfully');
                    window.location.href = 'admin.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Error updating category: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <h2>Edit Category</h2>
        <?php if ($category): ?>
        <form method="POST" action="">
            <input type="hidden" name="Id" value="<?php echo htmlspecialchars($category['Id']); ?>">
            <label for="Name">Category Name:</label>
            <input type="text" id="Name" name="Name" value="<?php echo htmlspecialchars($category['Name']); ?>" required>
            <label for="Description">Category Description:</label>
            <textarea id="Description" name="Description" rows="4" required><?php echo htmlspecialchars($category['Description']); ?></textarea>
            <input type="submit" value="Update Category">
        </form>
        <?php else: ?>
        <p>Category not found or no category name provided.</p>
        <?php endif; ?>
    </div>
</body>
</html>
