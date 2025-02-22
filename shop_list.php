<?php
include('header.php');
include('database/connect.php');
$select_product = "SELECT * FROM `products`";
$result = mysqli_query($conn, $select_product);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
?>

<section class="shop-section">
    <div class="shop-container">
        <h1 class="shop-title
        text-center mb-4">Shop List</h1>
        <p class="text-center">Browse our exclusive collection of products and find the best deals on your favorite items.</p>
    </div>
    <div class="container">
        <div class="row g-5">
            <?php foreach ($products as $index => $product): ?>
                <div class='col-4'>
                    <?php include('asset/product-box.php') ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="section-gaps"></div>
</section>

<?php include('footer.php'); ?>