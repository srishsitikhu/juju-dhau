<?php
session_start();
include 'database/connect.php';

if (!isset($_GET['id'])) {
    header("Location: user_list.php");
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM user WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: user_list.php");
    exit;
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];

    $sql = "UPDATE user SET name='$name', email='$email', number='$number', address='$address' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "User updated successfully";
        header("Location: user_list.php");
        exit;
    } else {
        $_SESSION['message'] = "Error updating user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Number</label>
                <input type="text" name="number" value="<?php echo $row['number']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Update User</button>
            <a href="user_list.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>