<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->  
    <style>
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
     
</head>
 <body>
    
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