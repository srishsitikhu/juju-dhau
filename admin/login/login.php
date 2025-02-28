<script src="../../js/jquery.js"></script>
<script src="../../css/all.css"></script>
<link rel="stylesheet" href="../../css/bootstrap.css">

<?php
@session_start();
include '../../database/connect.php'; // Ensure this path is correct

include '../asset/notify.php';


// Handle form submission
if (isset($_POST['sign_in'])) {
    $username = $_POST['userName'];
    $password = $_POST['userPassword'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM admin WHERE ausername = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['apassword'])) {
            $_SESSION['admin'] = $username;
            echo "<script>window.location.href = '../index.php?notify=1';</script>";
        } else {
            echo "<script>window.location.href = '" . htmlspecialchars($_SERVER['PHP_SELF']) . "?notify=2';</script>";
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="logcs.css">
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
</body>
<script src="validate.js"></script>

</html>
<?php


include('../footer.php');
?>

