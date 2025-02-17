<?php
include("header.php");
include("database/connect.php");

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    echo "<script>window.location.href = 'index.php?notify=3';</script>";
    exit();
}

// Fetch current user data
$name = $_SESSION['name'];
$sql = "SELECT * FROM user WHERE name = '$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $contact = $row['number'];
    $address = $row['address'];
}

// Update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newEmail = $_POST['email'];
    $newContact = $_POST['contact'];
    $newAddress = $_POST['address'];

    $sql = "UPDATE user SET email='$newEmail', number='$newContact', address='$newAddress' WHERE name='$name'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href = 'user_profile.php?notify=11';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h1 class="profile-heading">Edit Profile</h1>
        <form method="POST" action="" class="profile-form">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required class="form-input">
            </div>
            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>" required class="form-input">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required class="form-input">
            </div>
            <div class="profile-actions">
                <button type="submit" class="button-link">Save Changes</button>
                <a href="user_profile.php" class="button-link">Back to Profile</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php include("footer.php"); ?>
