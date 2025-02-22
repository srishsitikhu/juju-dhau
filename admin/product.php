<?php
// Start session at the top before any output
@session_start();

include 'header.php';
// Check if the admin session exists
if ((!$_SESSION['admin'])) {
    // Redirect to login page if session is invalid
    header('Location:login/login.php');
    exit;
}
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <div class="main-content-product">
                <h2 class="my-4">Product List</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Date Added</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'database/connect.php';
                            $sql = "SELECT `product_id`,`title`, `base_price`, `description`, `image_path`, `date_added` FROM `products`";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                    <tr>
                                        <td>$row[product_id]</td>
                                        <td>$row[title]</td>
                                        <td>$row[base_price]</td>
                                        <td>$row[description]</td>
                                        <td><img src='product_images/$row[image_path]' alt='Product Image' class='img-fluid'></td>
                                        <td>$row[date_added]</td>
                                        <td>
                                            <a class='btn btn-primary btn-sm' href='update.php?Id=$row[product_id]'>Update</a>
                                            <a class='btn btn-danger btn-sm' href='delete.php?Id=$row[product_id]'>Delete</a>
                                        </td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No products found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>