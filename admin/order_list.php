<?php
include 'database/connect.php';

// Handle Approve button click
if (isset($_GET['Id'])) {
    $oid = intval($_GET['Id']); // Secure input by converting to integer

    $sq = "UPDATE orders SET status='Approved' WHERE order_id = ?";
    $stmt = $conn->prepare($sq);
    $stmt->bind_param("i", $oid);

    if ($stmt->execute()) {
        // Redirect to the same page to reflect the changes
        header("Location: order_list.php");
        exit(); // Prevent further execution
    } else {
        echo "<script>alert('Error updating order status!');</script>";
    }
    $stmt->close();
}

// Fetch orders from the database
$sql = "
    SELECT 
        orders.order_id as id, 
        user.name, 
        user.number, 
        user.address, 
        products.title as Product, 
        products.base_price as Unit_Price, 
        products.image_path AS Image, 
        product_options.option_name AS litre,  
        order_details.price as Total_Price, 
        order_details.quantity as Quantity, 
        orders.status 
    FROM 
        order_details 
    INNER JOIN 
        orders 
    ON 
        order_details.order_id = orders.order_id 
    INNER JOIN 
        user 
    ON 
        orders.userid = user.id 
    INNER JOIN 
        products 
    ON 
        order_details.product_id = products.product_id 
    INNER JOIN 
        product_options 
    ON 
        order_details.option_id = product_options.option_id
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Adjust the main content to accommodate the sidebar */
        .main-content {
            margin-left: 250px;
            /* Adjust this value based on your sidebar width */
            padding: 20px;
            /* Add padding for better spacing */
        }

        /* Ensure the table is responsive */
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include the sidebar -->
            <?php include 'sidebar.php'; ?>
            <div class="main-content-order mt-5">
                <h2 class="mb-4">Order List</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Address</th>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Image</th>
                                <th>Size (Litre)</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['id']) ?></td>
                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                        <td><?= htmlspecialchars($row['number']) ?></td>
                                        <td><?= htmlspecialchars($row['address']) ?></td>
                                        <td><?= htmlspecialchars($row['Product']) ?></td>
                                        <td>Rs. <?= number_format($row['Unit_Price'], 2) ?></td>
                                        <td><img src='product_images/<?= htmlspecialchars($row['Image']) ?>'
                                                alt='Product Image' style='width:50px;height:50px;'></td>
                                        <td><?= htmlspecialchars($row['litre']) ?> L</td>
                                        <td><?= htmlspecialchars($row['Quantity']) ?></td>
                                        <td>Rs. <?= number_format($row['Total_Price'], 2) ?></td>
                                        <td>
                                            <span
                                                class="badge <?= $row['status'] === 'Approved' ? 'bg-success' : 'bg-warning' ?>">
                                                <?= htmlspecialchars($row['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($row['status'] !== 'Approved'): ?>
                                                <a class="btn btn-primary btn-sm" href="?Id=<?= $row['id'] ?>"
                                                    onclick="return confirm('Are you sure you want to approve this order?')">Approve</a>
                                            <?php else: ?>
                                                <button class="btn btn-secondary btn-sm" disabled>Approved</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan='12' class="text-center">No data found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>