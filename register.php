<?php
include("adminconn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $mobilenumber = $conn->real_escape_string($_POST['mobilenumber']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmpassword = $conn->real_escape_string($_POST['confirmpassword']);
    if (!empty($username) && !empty($password) && !empty($mobilenumber) && !empty($email) && !empty($confirmpassword)) {
        if ($password === $confirmpassword) {
            if (preg_match('/^\d{10}$/', $mobilenumber)) {
                $check_mobile_sql = "SELECT * FROM `register` WHERE Mobile_Number='$mobilenumber'";
                $result = $conn->query($check_mobile_sql);
                if ($result->num_rows == 0) {
                    $sql_login = "INSERT INTO `login` (username, password) VALUES ('$username', '$password')";
                    $sql_register = "INSERT INTO `register` (Name, Mobile_Number, Email, Password, Confirm_password) VALUES ('$username', '$mobilenumber', '$email', '$password', '$confirmpassword')";
                    if ($conn->query($sql_login) === TRUE && $conn->query($sql_register) === TRUE) {
                        header("Location: login.php");
                        exit();
                    } else {
                        echo "Error: " . $conn->error;
                    }
                } else {
                    echo "Mobile number already registered!";
                }
            } else {
                echo "Mobile number must be exactly 10 digits.";
            }
        } else {
            echo "Passwords do not match!";
        }
    } else {
        echo "All fields are required!";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .register-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .login-form h2 {
            color: #800000;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #800000;
        }

        .input-group input {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #800000;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-group input:focus {
            border-color: #400000;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }

        button {
            background-color: #800000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #400000;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form" onsubmit="return validateForm()">
            <h2>Registration Form</h2>
            <div class="input-group">
                <label for="username">Name:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="mobilenumber">Mobile Number:</label>
                <input type="tel" id="mobilenumber" name="mobilenumber" pattern="[0-9]{10}" required>
                <div id="mobile-error-message" class="error-message"></div>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirmpassword">Confirm Password:</label>
                <input type="password" id="confirmpassword" name="confirmpassword" required>
                <div id="password-error-message" class="error-message"></div>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmpassword").value;
            var mobilenumber = document.getElementById("mobilenumber").value;
            var passwordErrorMessage = document.getElementById("password-error-message");
            var mobileErrorMessage = document.getElementById("mobile-error-message");
            var isValid = true;
            passwordErrorMessage.textContent = "";
            mobileErrorMessage.textContent = "";
            if (password !== confirmPassword) {
                passwordErrorMessage.textContent = "Passwords do not match!";
                isValid = false;
            }
            if (!/^\d{10}$/.test(mobilenumber)) {
                mobileErrorMessage.textContent = "Mobile number must be exactly 10 digits.";
                isValid = false;
            }

            return isValid;
        }

        // Attach event listener to input fields to clear the error message on change
        document.getElementById("password").addEventListener("input", function() {
            document.getElementById("password-error-message").textContent = "";
        });

        document.getElementById("confirmpassword").addEventListener("input", function() {
            document.getElementById("password-error-message").textContent = "";
        });

        document.getElementById("mobilenumber").addEventListener("input", function() {
            document.getElementById("mobile-error-message").textContent = "";
        });
    </script>
</body>
</html>
