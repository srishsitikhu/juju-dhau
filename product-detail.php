<?php
@session_start();
include('database/connect.php');

// Handle form submission for adding to cart
if (isset($_POST["cart-product"])) {
    if (!isset($_SESSION["userid"])) {
        echo "<script>
                window.location.href = 'form-box.php?notify=3';
            </script>";
    } else {
        // Sanitize and validate inputs
        $get_product_id = intval($_POST['product_id']);
        $userid = mysqli_real_escape_string($conn, $_SESSION["userid"]);
        $option_id = isset($_POST['option_id']) ? intval($_POST['option_id']) : 0;

        // Fetch base price and option multiplier
        $query = "SELECT p.base_price, po.option_name 
                  FROM products p 
                  JOIN product_options po ON po.option_id = $option_id 
                  WHERE p.product_id = $get_product_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $base_price = $row['base_price'];
            $option_multiplier = floatval($row['option_name']); // Assuming option_name is the multiplier

            // Calculate price
            $price = $base_price * $option_multiplier;

            // Check if the product is already in the cart
            $check_cart_query = "SELECT * FROM `cart_details` WHERE userid = '$userid' AND product_id = $get_product_id AND option_id = $option_id";
            $check_result = mysqli_query($conn, $check_cart_query);

            if (mysqli_num_rows($check_result) > 0) {
                // Redirect to the same page with notify=15
                header("Location: " . $_SERVER['PHP_SELF'] . "?notify=14");
                exit();
            } else {
                // Insert into cart
                $insert_query = "INSERT INTO `cart_details` (product_id, userid, option_id, price) VALUES ($get_product_id, '$userid', $option_id, $price)";
                if (mysqli_query($conn, $insert_query)) {
                    echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "?notify=13';</script>";
                }
            }
        }
    }
}

// Fetch products from the database
$select_product = "SELECT * FROM `products`";
$result = mysqli_query($conn, $select_product);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>

<div class="product" id="product">
    <?php foreach ($products as $index => $product): 
        $option_ids = explode(',', $product['product_options']);
        $option_ids_placeholder = implode(',', array_map('intval', $option_ids)); // Sanitize option IDs

        $select_options = "SELECT * FROM `product_options` WHERE `option_id` IN ($option_ids_placeholder)";
        $options_result = mysqli_query($conn, $select_options);
        $options = mysqli_fetch_all($options_result, MYSQLI_ASSOC);
    ?>
    <div class="product-item" data-base-price="<?php echo htmlspecialchars($product['base_price']); ?>" data-index="<?php echo $index; ?>"> 
        <img src="admin/product_images/<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" class="sliderImage">
        <div class="productDetail">
            <h1 class="productTitle"><?php echo htmlspecialchars($product['title']); ?></h1>
            <h2 class="productPrice">RS <?php echo htmlspecialchars($product['base_price']); ?></h2>
            <div class="productDisc"><?php echo htmlspecialchars($product['description']); ?></div>
            <form action="" method="post">
                <div class="sizes">
                    <?php foreach ($options as $optionIndex => $option): ?>
                        <div class="size">
                            <input type="radio" name="option_id" 
                                   id="option_<?php echo $index; ?>_<?php echo htmlspecialchars($option['option_id']); ?>" 
                                   value="<?php echo htmlspecialchars($option['option_id']); ?>" 
                                   data-option-name="<?php echo htmlspecialchars($option['option_name']); ?>" 
                                   onchange="updatePrice(this)" <?php echo $optionIndex === 0 ? 'checked' : ''; ?>>
                            <label for="option_<?php echo $index; ?>_<?php echo htmlspecialchars($option['option_id']); ?>">
                                <?php echo htmlspecialchars($option['option_name']); ?> ltr
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                <button class="productButton" type="submit" name="cart-product">ADD TO CART</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
    function updatePrice(selectedSize) {
        const productDiv = selectedSize.closest('.product-item'); 
        const basePrice = parseFloat(productDiv.getAttribute('data-base-price')); 
        const literValue = parseInt(selectedSize.getAttribute('data-option-name')); 
        const newPrice = basePrice * literValue; 
        const priceElement = productDiv.querySelector('.productPrice'); 
        priceElement.innerText = `RS ${newPrice.toFixed(2)}`; 
    }
</script>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>