<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <h2>Add New Category</h2>
        <form action="catagories.php" method="post">
            <label for="name">Category Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"></textarea><br><br>
            <input type="submit" value="Add Category">
        </form>
    </div>
</body>
</html>
