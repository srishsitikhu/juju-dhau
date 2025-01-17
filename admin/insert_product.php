
<?php
include('../database/connect.php');
session_start();

// Check if the admin session exists
if ((!$_SESSION['admin'])) {
    // Redirect to login page if session is invalid
    header('Location:login/login.php');
    exit;
}

if (isset($_POST['insert_product'])) {
    $list_title = $_POST['list_title'];
    $title = $_POST['title'];
    $base_price = $_POST['base_price'];
    $description = $_POST['description'];

    $img = $_FILES['img']['name'];
    $img_temp = $_FILES['img']['tmp_name'];
    move_uploaded_file($img_temp, "./product_images/$img");

    // Insert product
    $sql = "INSERT INTO `products` (`list_title`, `title`, `base_price`, `description`, `image_path`, `date_added`, `product_options`) VALUES ('$list_title', '$title', '$base_price', '$description', '$img', NOW(), NULL)";

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

        echo "<script>alert('Product inserted successfully');
        window.location.href='index.php'; 
        </script>";
    }
}


include('header.php');
?>
<style>
     /* General Form Styling */
     .insert_product {
        background: linear-gradient(135deg, #f9f9f9, #e0e0e0);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        max-width: 600px;
        margin: 50px auto;
        font-family: 'Arial', sans-serif;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        font-size: 16px;
        color: #333;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group textarea,
    .form-group input[type="file"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="number"]:focus,
    .form-group textarea:focus,
    .form-group input[type="file"]:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    .form-group textarea {
        resize: vertical;
        height: 120px;
    }

    .form-check {
        margin-bottom: 12px;
    }

    .form-check-input {
        margin-right: 10px;
        cursor: pointer;
    }

    .form-check-label {
        font-weight: normal;
        font-size: 14px;
        color: #555;
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #003d80);
        transform: translateY(-2px);
    }

    .text-danger {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    .required {
        color: #dc3545;
    }

    /* Icon Styling */
    .form-group i {
        margin-right: 10px;
        color: #007bff;
    }

    /* Success and Error Icons */
    .form-group.success input,
    .form-group.success textarea {
        border-color: #28a745;
    }

    .form-group.error input,
    .form-group.error textarea {
        border-color: #dc3545;
    }

    .form-group.success .fa-check-circle {
        color: #28a745;
        display: inline-block;
    }

    .form-group.error .fa-exclamation-circle {
        color: #dc3545;
        display: inline-block;
    }

    .form-group .fa-check-circle,
    .form-group .fa-exclamation-circle {
        display: none;
        margin-left: 10px;
    }
    
    </style>
    
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
                    echo "<input class='form-check-input' type='checkbox' name='select_options[]' value='" . $row['option_id'] . "' id='option_" . $row['option_id'] . "'>";
                    echo "<label class='form-check-label' for='option_" . $row['option_id'] . "'>" . $row['option_name'] . "</label>";
                    echo "</div>";
                }
                ?>
            </div>
            <small id="select_options_error" class="text-danger"></small>
        </div>

        <input type="submit" class="btn btn-primary" name="insert_product" value="Insert Product">
    </form>
</div>

    
</body>

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

        return isValid;
    }
</script>
