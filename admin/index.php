<?php
@session_start();
include 'header.php';
include 'asset/notify.php';
include("../database/connect.php");
?>
<div class="container-fluid">
    <div class="d-flex gap-3">


        <?php include('sidebar.php'); ?>
        <div class="main">
            <h1>Dashboard</h1>

            <div class="insight">
                <div class="sales">
                    <span class="material-symbols-outlined">trending_up</span>
                    <div class="middle">
                        <div class="mleft">
                            <?php
                            $sales_query = "SELECT COUNT(*) AS total_sales FROM orders WHERE status = 'approved'";
                            $sales_result = $conn->query($sales_query);
                            $total_sales = $sales_result->fetch_assoc()['total_sales'] ?? 0;
                            ?>
                            <h3>Total Sales</h3>
                            <h1><?php echo $total_sales; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="expenses">
                    <span class="material-symbols-outlined">hourglass_empty</span>
                    <div class="middle">
                        <div class="mleft">
                            <?php
                            $pending_query = "SELECT COUNT(*) AS total_pending FROM orders WHERE status = 'pending'";
                            $pending_result = $conn->query($pending_query);
                            $total_pending = $pending_result->fetch_assoc()['total_pending'] ?? 0;
                            ?>
                            <h3>Total pending</h3>
                            <h1><?php echo $total_pending; ?></h1>
                        </div>

                    </div>

                </div>
                <div class="income">
                    <span class="material-symbols-outlined">people</span>
                    <div class="middle">
                        <div class="mleft">
                            <?php
                            $users_query = "SELECT COUNT(*) AS total_users FROM user";
                            $users_result = $conn->query($users_query);
                            $total_users = $users_result->fetch_assoc()['total_users'] ?? 0;
                            ?>
                            <h3>Total Customer</h3>
                            <h1><?php echo $total_users; ?></h1>
                        </div>

                    </div>
                </div>
            </div>

            <div class="recentorder">
                <h1>Recent Orders</h1>
                <?php
                $order_query = "
                    SELECT o.order_id, o.total_amount, o.order_date, od.quantity, p.title, o.status
                    FROM orders o
                    JOIN order_details od ON o.order_id = od.order_id
                    JOIN products p ON od.product_id = p.product_id
                    ORDER BY o.order_date DESC";

                if ($result = $conn->query($order_query)) {
                    if ($result->num_rows > 0) {
                        echo "<table class='table'>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Date</th>
                    <th>Payment Method</th>
                    <th>Total Items</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";
                        while ($row = $result->fetch_assoc()) {
                            $order_id = htmlspecialchars($row['order_id']);
                            $order_name = htmlspecialchars($row['title']);
                            $order_date = htmlspecialchars($row['order_date']);
                            $payment_method = "Cash on Delivery";
                            $quantity = htmlspecialchars($row['quantity']);
                            $total_amount = number_format($row['total_amount'], 2);
                            $status = htmlspecialchars($row['status']);

                            echo "<tr>
            <td>$order_id</td>
            <td>$order_name</td>
                <td>$order_date</td>
                <td>$payment_method</td>
                <td>$quantity</td>
                <td>Rs. $total_amount</td>
                <td>$status</td>
                <td><a href='order_list.php' style='color: blue;'>details</a></td>
              </tr>";
                        }
                        echo "</tbody>
          </table>";
                    } else {
                        echo "<p>No recent orders found.</p>";
                    }
                    $result->free();
                }
                ?>
            </div>
        </div>

        <div class="right">
            <div class="rtop">
                <button id="menubar">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="profile">
                    <div class="info">
                        <p><b><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></b></p>
                        <p>Admin</p>
                    </div>
                    <div class="profilephoto">
                        <img src="image/pphoto.jpg" alt="Profile Photo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>