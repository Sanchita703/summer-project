
<?php
session_start();
include('adminconn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        header("Location: register.php");
        exit();
    }

    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Check for specific admin credentials
        if ($username == 'Sanchita Joshi' && $password == '12345') {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: admin.php");
            exit();
        }

        $query = "SELECT * FROM `login` WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $username;
            header("Location: asd.php");
            exit();
        } else {
            echo "Invalid username or password!";
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN </title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="admin.css">
</head>
<body>
  <div class="login-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
      <h2>Login</h2>
      <div class="input-group">
        <input type="text" id="username" name="username" placeholder="Username">
      </div>
      <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Password">
      </div>
      <button type="submit" name="login">Login</button>
      <button type="submit" name="register">Register</button>
    </form>
  </div>
</body>
</html>
