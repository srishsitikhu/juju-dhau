<?php
@session_start();
include 'header.php';
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
        header("Location: user_list.php?notify=12");
        exit;
    } else {
        $_SESSION['message'] = "Error updating user: {$conn->error}";
    }
}
?>

    <div class="row">
        <!-- Include the sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <div class="col mt-5">
                <h2>Edit User</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Number</label>
                        <input type="text" name="number" value="<?php echo $row['number']; ?>" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control"
                            required>
                    </div>
                    <button type="submit" class="btn btn-success">Update User</button>
                    <a href="user_list.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>