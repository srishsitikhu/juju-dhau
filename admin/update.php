<?php
// Database connection
include 'header.php';
include('../database/connect.php');
@session_start();

// Check if the admin session exists
if (!isset($_SESSION['admin'])) {
    header('Location: login/login.php');
    exit;
}

// Fetch product details
if (isset($_GET['Id'])) {
    $product_id = intval($_GET['Id']);
    $sql = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Product not found'); window.location.href='index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='index.php';</script>";
    exit;
}

// Handle form submission for updating the product
if (isset($_POST['update_product'])) {
    $list_title = $_POST['list_title'];
    $title = $_POST['title'];
    $base_price = $_POST['base_price'];
    $description = $_POST['description'];
    $img = $product['image_path'];

    // Handle image upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $img_temp = $_FILES['img']['tmp_name'];
        $img_type = $_FILES['img']['type'];

        if (!in_array($img_type, $allowed_types)) {
            echo "<script>alert('Only JPG, PNG, and GIF images are allowed.'); window.location.href='update.php?id=$product_id';</script>";
            exit;
        }

        // Generate a unique filename
        $img = uniqid() . '_' . basename($_FILES['img']['name']);
        $upload_dir = "./product_images/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        move_uploaded_file($img_temp, $upload_dir . $img);
    }

    // Update product in database
    $sql = "UPDATE `products` SET `list_title`='$list_title', `title`='$title', `base_price`='$base_price', `description`='$description', `image_path`='$img' WHERE `product_id`='$product_id'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Handle selected options
        if (isset($_POST['select_options'])) {
            $options = implode(',', $_POST['select_options']);
            $update_sql = "UPDATE `products` SET `product_options`='$options' WHERE `product_id`='$product_id'";
            mysqli_query($conn, $update_sql);
        }

        echo "<script>alert('Product updated successfully'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<div class="container-fluid">
    <div class="d-flex gap-3">
        <?php include 'sidebar.php'; ?>
        <div class="main-content-insert">
            <div class="insert_product">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>List Title</label>
                        <input type="text" name="list_title" class="form-control"
                            value="<?php echo $product['list_title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $product['title']; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Base Price</label>
                        <input type="number" step="0.01" name="base_price" class="form-control"
                            value="<?php echo $product['base_price']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control"
                            required><?php echo $product['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="img" class="form-control">
                        <img src="./product_images/<?php echo $product['image_path']; ?>" width="100"
                            alt="Current Image">
                    </div>
                    <div class="form-group">
                        <label>Options</label>
                        <div>
                            <?php
                            $sql = "SELECT * FROM `product_options`";
                            $res = mysqli_query($conn, $sql);
                            $selected_options = explode(',', $product['product_options']);
                            while ($row = mysqli_fetch_assoc($res)) {
                                $checked = in_array($row['option_id'], $selected_options) ? 'checked' : '';
                                echo "<div class='form-check'>";
                                echo "<input class='form-check-input' type='checkbox' name='select_options[]' value='" . $row['option_id'] . "' id='option_" . $row['option_id'] . "' $checked>";
                                echo "<label class='form-check-label' for='option_" . $row['option_id'] . "'>" . $row['option_name'] . " ltr</label>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="update_product" value="Update Product">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>