<?php
// Database connection
include 'header.php';
include('../database/connect.php');
@session_start();

// Check if the admin session exists
if (!isset($_SESSION['admin'])) {
    // Redirect to login page if session is invalid
    header('Location: login/login.php');
    exit;
}

// Handle form submission
if (isset($_POST['insert_product'])) {
    $list_title = $_POST['list_title'];
    $title = $_POST['title'];
    $base_price = $_POST['base_price'];
    $description = $_POST['description'];

    // Handle image upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        $img = $_FILES['img']['name'];
        $img_temp = $_FILES['img']['tmp_name'];
        $img_type = $_FILES['img']['type'];

        // Check file type
        if (!in_array($img_type, $allowed_types)) {
            echo "<script>alert('Only JPG, PNG, and GIF images are allowed.');
            window.location.href='index.php'; 
            </script>";
            exit;
        }

        // Generate a unique filename
        $img = uniqid() . '_' . basename($img);

        $upload_dir = "./product_images/";

        // Ensure the upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($img_temp, $upload_dir . $img)) {
            // File uploaded successfully
        } else {
            echo "<script>alert('Failed to upload image.');
            window.location.href='index.php'; 
            </script>";
            exit;
        }
    } else {
        echo "<script>alert('Image upload error.');
        window.location.href='index.php'; 
        </script>";
        exit;
    }

    // Insert product into the database
    $sql = "INSERT INTO `products` (`list_title`, `title`, `base_price`, `description`, `image_path`, `date_added`, `product_options`) 
            VALUES ('$list_title', '$title', '$base_price', '$description', '$img', NOW(), NULL)";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        echo "Error: " . mysqli_error($conn) . "<br>";
    } else {
        // Get the last inserted product ID
        $product_id = mysqli_insert_id($conn);

        // Handle selected options
        if (isset($_POST['select_options'])) {
            $options = implode(',', $_POST['select_options']); // Create a comma-separated string of option IDs
            // Update the product with selected options
            $update_sql = "UPDATE `products` SET `product_options` = '$options' WHERE `product_id` = '$product_id'";
            mysqli_query($conn, $update_sql);
        }

        echo "<script>
        window.location.href='index.php?notify=10'; 
        </script>";
    }
}

?>
    <div class="container-fluid">
        <div class="d-flex gap-3">
            <!-- Include the sidebar -->
            <?php include 'sidebar.php'; ?>
            <div class="main-content-insert">
                <div class="insert_product">
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="list_title"><i class="fas fa-heading"></i> List Title <span class="required"></span></label>
                            <input type="text" id="list_title" required name="list_title" class="form-control" />
                            <small id="list_title_error" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="title"><i class="fas fa-tag"></i> Title <span class="required"></span></label>
                            <input type="text" id="title" required name="title" class="form-control" />
                            <small id="title_error" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="base_price"><i class="fas fa-dollar-sign"></i> Base Price <span class="required"></span></label>
                            <input type="number" step="0.01" id="base_price" required name="base_price" class="form-control" />
                            <small id="base_price_error" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="description"><i class="fas fa-align-left"></i> Description <span class="required"></span></label>
                            <textarea id="description" required name="description" class="form-control"></textarea>
                            <small id="description_error" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="img"><i class="fas fa-image"></i> Image <span class="required"></span></label>
                            <input type="file" name="img" required class="form-control">
                            <small id="img_error" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="options"><i class="fas fa-cogs"></i> Options</label>
                            <div>
                                <?php
                                $sql = "SELECT * FROM `product_options`";  // Use your actual options table
                                $res = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($res)) {
                                    echo "<div class='form-check'>";
                                    echo "<input class='form-check-input' type='checkbox' name='select_options[]' value='" . $row['option_id']  . "' id='option_" . $row['option_id'] . "'>";
                                    echo "<label class='form-check-label' for='option_" . $row['option_id'] . "'>" . $row['option_name']." ltr" . "</label>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                            <small id="select_options_error" class="text-danger"></small>
                        </div>

                        <input type="submit" class="btn btn-primary" name="insert_product" value="Insert Product">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script>
        function validateForm() {
            var isValid = true;

            // Base Price Validation
            var basePrice = document.getElementById('base_price').value.trim();
            var basePriceError = document.getElementById('base_price_error');
            if (isNaN(basePrice) || parseFloat(basePrice) <= 0) {
                basePriceError.textContent = "Enter a valid positive price";
                isValid = false;
            } else {
                basePriceError.textContent = "";
            }

            // Image Validation
            var img = document.querySelector('input[name="img"]').files[0];
            var imgError = document.getElementById('img_error');
            if (!img) {
                imgError.textContent = "Please select an image";
                isValid = false;
            } else {
                imgError.textContent = "";
            }

            return isValid;
        }
    </script>
<?php
include 'footer.php';
?>