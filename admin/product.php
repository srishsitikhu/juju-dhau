<?php
// Start session at the top before any output
session_start();

// Check if the admin session exists
if ((!$_SESSION['admin'])) {
    // Redirect to login page if session is invalid
    header('Location:login/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
     <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .table img {
            max-width: 100px;
            height: auto;
            object-fit: contain;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-responsive {
            overflow-x: auto;
        }
        /* Minimize gap between sidebar and product table */
        .main-content {
            margin-left: 250px; /* Adjust this value based on your sidebar width */
            padding: 20px; /* Add some padding for better spacing */
        }
        /* Adjust padding between Update and Delete buttons */
        .btn-sm {
            margin: 2px; /* Reduce margin between buttons */
        }
    </style>
</head>

<body>
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
</body>

</html>