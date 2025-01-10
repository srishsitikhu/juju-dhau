<?php
session_start();
include("database/connect.php");
include("header.php");

if (!isset($_SESSION["userid"])) {
    echo "<script>
            alert('Please log in to proceed to checkout');
            window.location.href = 'login.php';
          </script>";
    exit();
}

$userid = $_SESSION["userid"];
$total = 0;

// Fetch cart items for the user
$cart_query = "SELECT cd.product_id, cd.option_id, cd.price, cd.quantity, p.base_price,
                      p.image_path, p.title, po.option_name 
               FROM cart_details cd 
               JOIN products p ON cd.product_id = p.product_id 
               JOIN product_options po ON cd.option_id = po.option_id
               WHERE cd.userid=?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param("i", $userid);
if (!$stmt->execute()) {
    die("Error fetching cart items: " . $conn->error);
}
$cart_items = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $address = htmlspecialchars($_POST['address']);
    $payment_method = "Cash on Delivery";

    // Calculate total
    $stmt->execute();
    $cart_items = $stmt->get_result();
    if ($cart_items->num_rows > 0) {
        while ($cart_item = $cart_items->fetch_assoc()) {
            $quantity = $cart_item['quantity'];
            $option = $cart_item['option_name'];
            $total += $cart_item['price'] * $quantity;
        }

        // Insert order
        $order_query = "INSERT INTO orders (userid, total_amount, address,quantity) VALUES (?, ?, ?, ?)";
        $order_stmt = $conn->prepare($order_query);
        $order_stmt->bind_param("ids", $userid, $total, $address,$quantity);
        if ($order_stmt->execute()) {
            $order_id = $conn->insert_id;

            // Insert order details
            $stmt->execute();
            $cart_items = $stmt->get_result();
            while ($cart_item = $cart_items->fetch_assoc()) {
                $product_id = $cart_item['product_id'];
                $option_id = $cart_item['option_id'];
                $price = $cart_item['price'];
                

                $order_detail_query = "INSERT INTO order_details (order_id, product_id, option_id, price, quantity) 
                                       VALUES (?, ?, ?, ?, ?)";
                $detail_stmt = $conn->prepare($order_detail_query);
                $detail_stmt->bind_param("iiiid", $order_id, $product_id, $option_id, $price, $quantity);
                $detail_stmt->execute();
            }

            // Clear cart
            $clear_cart_query = "DELETE FROM cart_details WHERE userid=?";
            $clear_cart_stmt = $conn->prepare($clear_cart_query);
            $clear_cart_stmt->bind_param("i", $userid);
            $clear_cart_stmt->execute();

            echo "<script>alert('Order placed successfully'); window.location.href='order-success.php?order_id=$order_id';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to place the order. Please try again.');</script>";
        }
    }
}

// Render Checkout Page
if ($cart_items->num_rows > 0) {
    echo "<section class='checkout-section padding-top-section'>
            <div class='container'>
                <h2 class='heading underline'>Checkout</h2>
                <form action='' method='post'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <h3 class='subheading'>Billing Details</h3>
                            <div class='form-group'>
                                <label for='address'>Address</label>
                                <textarea name='address' id='address' class='form-control' rows='3' required></textarea>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <h3 class='subheading'>Your Order</h3>
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Option</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>";

    $total = 0;
    while ($row = $cart_items->fetch_assoc()) {
        $total += $row['price'];
        echo "<tr>
                <td>" . htmlspecialchars($row['title']) . "</td>
                <td>" . htmlspecialchars($row['option_name']) . " Ltr</td>
                <td>Rs. " . htmlspecialchars($row['base_price'] * $option) . "</td>
                <td>" . htmlspecialchars($row['quantity']) . "</td>
                <td>Rs. " . htmlspecialchars($row['price']). "</td>
                
              </tr>";
    }

    echo "</tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th>Rs. " . number_format($total, 2) . "</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12 text-right'>
                            <button type='submit' name='place_order' class='btn btn-primary'>Place Order (Cash on Delivery)</button>
                        </div>
                    </div>
                </form>
            </div>
          </section>";
} else {
    echo "<section class='section-gap'>
            <div class='container'>
                <h2 class='heading underline center text-center'>Your cart is empty.</h2>
                <p class='lead text-center'>Please add some products to your cart before proceeding to checkout.</p>
            </div>
          </section>";
}

include("footer.php");
?>
