<?php
include('../database/connect.php');
include('header.php');

if (isset($_GET['option_id'])) {
    $option_id = $_GET['option_id'];
    $query = "SELECT * FROM product_options WHERE option_id = $option_id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

if (isset($_POST['update_option'])) {
    $option_id = $_POST['option_id'];
    $option_name = $_POST['option_name'];

    // Check if the option already exists
    $check_query = "SELECT * FROM product_options WHERE option_name = '$option_name' AND option_id != $option_id";
    $check_result = mysqli_query($conn, $check_query);
    $number = mysqli_num_rows($check_result);

    if ($number > 0) {
        header("Location: " . $_SERVER['PHP_SELF'] . "&?notify=5");

    } else {
        $update_query = "UPDATE product_options SET option_name = '$option_name' WHERE option_id = $option_id";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            echo "<script> window.location.href='insert_option.php?notify=6';</script>";
        } else {
            echo "Error updating option: " . mysqli_error($conn);
        }
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <!-- Include the sidebar -->
        <?php include 'sidebar.php'; ?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Edit Option</div>
                        <div class="card-body">
                            <form action="" method="post">
                                <input type="hidden" name="option_id" value="<?= $data['option_id'] ?>">
                                <div class="form-group mb-3">
                                    <label for="option_name">Option Name</label>
                                    <input type="text" name="option_name" class="form-control"
                                        value="<?= $data['option_name'] ?>" required>
                                </div>
                                <button type="submit" name="update_option" class="btn btn-success">Update</button>
                                <a href="insert_option.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>