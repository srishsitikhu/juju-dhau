<?php
@session_start();
include 'database/connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM user WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "User deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting user: " . $conn->error;
    }
}

header("Location: user_list.php");
exit;
?>