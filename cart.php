<?php
session_start();
include("database/connect.php");
include("header.php");

if (!isset($_SESSION["userid"])) {
    echo "<script>
            alert('Please log in to add items to the cart');
            window.location.href = 'form-box.php';
            </script>";
} else {
    $userid = $_SESSION["userid"];

    // Fetch cart details with option names
    $cart_query = "SELECT cd.product_id, cd.option_id, cd.quantity, cd.price, p.image_path, p.title, po.option_name, p.base_price
                   FROM cart_details cd 
                   JOIN products p ON cd.product_id = p.product_id 
                   JOIN product_options po ON cd.option_id = po.option_id 
                   WHERE cd.userid = ?";

    $stmt = $conn->prepare($cart_query);
    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $run_cart = $stmt->get_result();

    $total = 0;
}

if (isset($_GET['remove_product']) && isset($_GET['option_id'])) {
    $product_id_to_remove = filter_input(INPUT_GET, 'remove_product', FILTER_VALIDATE_INT);
    $product_option_to_remove = filter_input(INPUT_GET, 'option_id', FILTER_SANITIZE_STRING);

    if ($product_id_to_remove && $product_option_to_remove && isset($_GET['confirm_delete'])) {
        $delete_query = "DELETE FROM cart_details WHERE product_id = ? AND userid = ? AND option_id = ?";
        $stmt = $conn->prepare($delete_query);
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }
        $stmt->bind_param("iis", $product_id_to_remove, $userid, $product_option_to_remove);

        if ($stmt->execute()) {
            echo "<script>alert('Product option removed successfully');</script>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>alert('Failed to delete product option.');</script>";
        }
    }
}

if (isset($_POST['update_cart']) || isset($_POST['checkout'])) {
    $quantities = $_POST['qty'];
    $update_success = false;

    foreach ($quantities as $key => $quantity) {
        list($product_id, $option_id) = explode('-', $key);

        // Fetch the base price and option name from the cart
        $update_cart_query = "SELECT p.base_price, po.option_name 
                              FROM cart_details cd 
                              JOIN products p ON cd.product_id = p.product_id
                              JOIN product_options po ON cd.option_id = po.option_id
                              WHERE cd.product_id = ? AND cd.userid = ? AND cd.option_id = ?";
        $stmt = $conn->prepare($update_cart_query);
        if (!$stmt) {
            echo "<script>alert('Failed to prepare select query for product ID $product_id and option ID $option_id.');</script>";
            continue;
        }
        $stmt->bind_param("iis", $product_id, $userid, $option_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product_data = $result->fetch_assoc();

        if ($product_data) {
            $baseprice = $product_data['base_price']; // Get the base price
            $option_name = $product_data['option_name']; // Get the option name (multiplier)

            // Calculate the total price for the product based on the updated quantity
            $total_price = $baseprice * $quantity * $option_name;

            // Update the cart with the new quantity and recalculated price
            $update_price_query = "UPDATE cart_details SET quantity = ?, price = ? WHERE product_id = ? AND userid = ? AND option_id = ?";
            $stmt = $conn->prepare($update_price_query);
            if (!$stmt) {
                echo "<script>alert('Failed to prepare update query for product ID $product_id and option ID $option_id.');</script>";
                continue;
            }
            $stmt->bind_param("iiisi", $quantity, $total_price, $product_id, $userid, $option_id);
            if ($stmt->execute()) {
                $update_success = true;
            } else {
                echo "<script>alert('Failed to update quantity and price for product ID $product_id and option ID $option_id.');</script>";
            }
        }
    }

    if ($update_success) {
        echo "<script>
                alert('Cart updated successfully!');
                window.location.href = window.location.href; // Refresh the page
              </script>";
    }

    if (isset($_POST['checkout'])) {
        // Proceed to checkout after updating cart
        header("Location: checkout.php?user_id=$userid");
        exit();
    }
}

if (isset($run_cart) && $run_cart->num_rows > 0) {
    echo "<section class='cart-section padding-top-section'>
            <div class='container'>
                <form action='' method='post'>
                    <table class='cart-list margin-bottom-cart'>
                        <thead>
                            <tr>
                                <th class='product-remove'></th>
                                <th class='product-thumbnail'>Image</th>
                                <th class='product-name'>Product Name</th>
                                <th class='product-price'>Price</th>
                                <th class='product-liter'>Litre</th>
                                <th class='product-quantity'>Quantity</th>
                                <th class='product-subtotal'>Total</th>
                            </tr>
                        </thead>
                        <tbody>";

    while ($row_cart = $run_cart->fetch_assoc()) {
        $pro_id = $row_cart['product_id'];
        $option_id = $row_cart['option_id'];
        $option_name = htmlspecialchars($row_cart['option_name'], ENT_QUOTES, 'UTF-8');
        $image = htmlspecialchars($row_cart['image_path'], ENT_QUOTES, 'UTF-8');
        $baseprice = $row_cart['base_price'];
        $single_price = $baseprice * $option_name;
        $quantity = $row_cart['quantity'];
        $product_name = htmlspecialchars($row_cart['title'], ENT_QUOTES, 'UTF-8');
        $single_total = $single_price * $quantity;

        echo "<tr data-product-id='$pro_id' data-option-id='$option_id' data-price='$baseprice'>
                <td class='product-remove'>
                    <a href='" . $_SERVER['PHP_SELF'] . "?remove_product=$pro_id&option_id=$option_id&confirm_delete' 
                       onclick='return confirm(\"Are you sure you want to delete this product option?\")'>Cancel</a>
                </td>
                <td class='product-thumbnail' style='width: 30%;'>
                    <img src='./admin/product_images/$image' alt='$product_name'>
                </td>
                <td class='product-name'>
                    $product_name
                </td>
                <td class='product-price'>
                    <span class='price-symbol'>Rs.</span> $single_price
                </td>
                <td class='product-liter'>
                    <span>$option_name</span>
                </td>
                <td class='product-quantity'>
                   <div class='quantity'>
                       <span class='minus-btn btn-quantity'>-</span>
                       <input type='number' class='quantity-input' name='qty[$pro_id-$option_id]' value='$quantity' min='1' max='10' step='1'>
                       <span class='plus-btn btn-quantity'>+</span>
                   </div>
                </td>
                <td class='product-subtotal'>
                    <input type='hidden' name='qty-price' value='$single_total'>
                    <span class='price-symbol'>Rs.</span> <span class='subtotal-value'>$single_total</span>
                </td>
            </tr> ";
        $total += $single_total;
    }
    echo "</tbody></table>
        
          <div class='cart-collaterals margin-bottom-cart'>
            <div class='row justify-content-end'>
           
                <div class='col-sm-6'>
                 <div class='btn-container'>
                            <input type='submit' name='update_cart' class='btn btn-success checkout-btn' value='Update Cart'>
                    </div>
                    <h2 class='heading underline'>Cart totals</h2>
                    <table>
                        <tbody>
                            <tr class='cart-subtotal'>
                                <th>Subtotal</th>
                                <td><span class='price-symbol'>Rs.</span> <span id='cart-subtotal'>$total</span></td>
                            </tr>
                            <tr class='order-total'>
                                <th>Total</th>
                                <td><strong><span class='price-symbol'>Rs.</span> <span id='cart-total'>$total</span></strong></td>
                            </tr>
                        </tbody>
                    </table>
                     <div class='btn-container'>
                    <input type='submit' name='checkout' class='btn btn-success checkout-btn' value='Proceed to checkout'>
                    </div>
                </div>
            </div>
          </div>
          </form>
          </div>
          </section>";
} else {
    echo "<section class='section-gaps'>
            <div class='container'>
                <h2 class='heading underline center text-center'>Your shopping cart is empty.</h2>
                <p class='lead text-center'>Add some products to your cart before proceeding. 
                   <a href='shop_list.php' class='btn btn-primary'>Browse Shop</a></p>
            </div>
          </section>";
}

include("footer.php");
?>