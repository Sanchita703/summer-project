<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// echo "Welcome, " . $_SESSION['username'] . "!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
    <h1>welcome
   <?php
    echo " " . $_SESSION['username'] . "!";
    ?>
    
    </h1>
</body>
</html>
