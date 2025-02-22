<?php
@session_start();
include '../../database/connect.php'; // Ensure this path is correct

// Handle form submission
if (isset($_POST['sign_in'])) {
    $username = $_POST['userName'];
    $password = $_POST['userPassword'];

    // Query the database
    $sql = "SELECT * FROM admin WHERE ausername = '$username' AND apassword = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        echo "<script>alert('Login Successful'); window.location.href = '../index.php';</script>";
    } else {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Basic CSS for the form */
         *{
              box-sizing: border-box;
            }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-box {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .form-box h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .input-group {
            display: flex;
            flex-direction: column;
        }
        .input-field {
            position: relative;
            margin-bottom: 15px;
        }
        .input-field i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .input-field input {
            width: 100%;
            padding: 10px 10px 10px 30px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2 id="title">Log In</h2>
        <form id="userForm" method="post">
            <div class="input-group">
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="userName" id="userName" placeholder="Username" />
                    <div class="error-message" id="usernameError"></div>
                </div>
                <div class="input-field">
                    <input type="password" id="userPassword" name="userPassword" placeholder="Password" />
                    <i class="fa fa-eye" id="togglePassword" aria-hidden="true"></i>
                    <div class="error-message" id="passwordError"></div>
                </div>
                <button type="submit" id="form-submit" name="sign_in">Log in</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('userForm');
            const usernameInput = document.getElementById('userName');
            const passwordInput = document.getElementById('userPassword');
            const usernameError = document.getElementById('usernameError');
            const passwordError = document.getElementById('passwordError');
            const togglePassword = document.getElementById('togglePassword');

            // Toggle password visibility
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });

            // Validate username
            usernameInput.addEventListener('input', validateUsername);
            usernameInput.addEventListener('blur', validateUsername);

            // Validate password
            passwordInput.addEventListener('input', validatePassword);
            passwordInput.addEventListener('blur', validatePassword);

            // Prevent form submission if validation fails
            form.addEventListener('submit', function (event) {
                const isUsernameValid = validateUsername();
                const isPasswordValid = validatePassword();

                if (!isUsernameValid || !isPasswordValid) {
                    event.preventDefault();
                }
            });

            // Validate username function
            function validateUsername() {
                const usernameValue = usernameInput.value.trim();
                if (usernameValue === '') {
                    usernameError.textContent = 'Username is required';
                    usernameError.style.display = 'block';
                    return false;
                } else if (usernameValue.length < 3) {
                    usernameError.textContent = 'Username must be at least 3 characters';
                    usernameError.style.display = 'block';
                    return false;
                } else {
                    usernameError.textContent = '';
                    usernameError.style.display = 'none';
                    return true;
                }
            }

            // Validate password function
            function validatePassword() {
                const passwordValue = passwordInput.value.trim();
                if (passwordValue === '') {
                    passwordError.textContent = 'Password is required';
                    passwordError.style.display = 'block';
                    return false;
                } else if (passwordValue.length < 6) {
                    passwordError.textContent = 'Password must be at least 6 characters';
                    passwordError.style.display = 'block';
                    return false;
                } else {
                    passwordError.textContent = '';
                    passwordError.style.display = 'none';
                    return true;
                }
            }
        });
    </script>
</body>
</html>