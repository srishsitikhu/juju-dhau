<?php
include("header.php");
include("database/connect.php");

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    echo "<script>window.location.href = 'index.php?notify=3';</script>";
    exit();
}

// Fetch user information
$name = $_SESSION['name'];

// If the user confirms the deletion
if (isset($_POST['confirm_delete'])) {
    // Prepare SQL to delete user
    $sql = "DELETE FROM user WHERE name = '$name'";

    if ($conn->query($sql) === TRUE) {
        // Successfully deleted, so end the session
        session_unset();
        session_destroy();
        echo "<script>window.location.href = 'index.php?notify=10';</script>"; // Redirect to home or login page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h1 class="profile-heading">Delete Account</h1>
        <p class="warning-text">Are you sure you want to delete your account? This action cannot be undone.</p>

        <form method="POST" action="" class="profile-form">
            <div class="profile-actions">
                <button type="submit" name="confirm_delete" class="button-link delete-button">Yes, Delete My Account</button>
                <a href="user_profile.php" class="button-link">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php include("footer.php"); ?>
