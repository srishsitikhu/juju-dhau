<?php
@session_start(); // Start the session

include("database/connect.php");
include("header.php");



$order_id = intval($_GET['order_id']);
$userid = $_SESSION["userid"] ?? null;

if (!$userid) {
    echo "<script>window.location.href='form-box.php?notify=3';</script>";
    exit();
}

// Fetch the order details with option_name from product_options
$order_query = "
    SELECT o.order_id, o.total_amount, o.address, o.order_date, 
           od.product_id, od.option_id, od.price, p.title, p.image_path, po.option_name,od.quantity
    FROM orders o
    JOIN order_details od ON o.order_id = od.order_id
    JOIN products p ON od.product_id = p.product_id
    JOIN product_options po ON od.option_id = po.option_id
    WHERE o.order_id = ? AND o.userid = ?";

$stmt = $conn->prepare($order_query);
$stmt->bind_param("ii", $order_id, $userid);
$stmt->execute();
$order_result = $stmt->get_result();



// Fetch the first row for delivery details
$order_details = $order_result->fetch_assoc();
$address = htmlspecialchars($order_details['address']);
$payment_method = "Cash on Delivery";
$order_date = htmlspecialchars($order_details['order_date']);

echo "<section class='order-success-section padding-top-section'>
        <div class='container'>
            <h2 class='heading underline'>Order Successful</h2>
            <p class='lead'>Thank you for your purchase! Your order has been placed successfully.</p>
            <h3 class='subheading'>Order Summary</h3>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Unit-Price</th>
                        <th>Option</th>
                        <th>Quantity</th>
                        <th>Total price</th>
                    </tr>
                </thead>
                <tbody>";

$total = 0;
do {
    $product_name = htmlspecialchars($order_details['title']);
    $option_name = htmlspecialchars($order_details['option_name']); // Get option name from product_options
    $price = $order_details['price'];
    $total += $price;
    $image_path = htmlspecialchars($order_details['image_path']);
    $quantity = $order_details['quantity'];

    echo "<tr>
            <td><img src='./admin/product_images/$image_path' alt='$product_name' class='img-fluid' style='max-width: 100px;'></td>
            <td>$product_name</td>
            <td>Rs. " . number_format($price/$quantity, 2) . "</td>
            <td>$option_name Ltr</td>
            <td>$quantity</td>
            <td>Rs. " . number_format($price, 2) . "</td>
          </tr>";
} while ($order_details = $order_result->fetch_assoc());

echo "</tbody>
            </table>
            <div class='text-right'>
                <h4>Total: Rs. " . number_format($total, 2) . "</h4>
            </div>
            <div class='order-details'>
                <h3 class='subheading'>Delivery Details</h3>
                <p><strong>Address:</strong> $address</p>
                <p><strong>Payment Method:</strong> $payment_method</p>
                <p><strong>Order Date:</strong> $order_date</p>
            </div>
            <div class='text-center section-gaps'>
                <a href='shop_list.php' class='btn btn-success'>Continue Shopping</a>
            </div>
        </div>
      </section>";

include("footer.php");
?>
