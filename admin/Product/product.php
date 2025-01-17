<?php
// Start session at the top before any output
session_start();

// Check if the admin session exists
if ((!$_SESSION['admin'])) {
    // Redirect to login page if session is invalid
    header('Location: ../login/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>description</th>
                <th>Image</th>
                <th>Date</th>
                <th>Delete</th>
                <th>Update</th>
                <!-- <th>Update</th>
      <th>Delete</th> -->
            </tr>

        </thead>
        <tbody>

            <!-- data -->
            <?php`
            include '../database/connect.php';
            $sql = "SELECT `product_id`,`title`, `base_price`, `description`, `image_path`, `date_added` FROM `products`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                     <tr>
                        <td>$row[product_id]</td>
                        <td>$row[title]</td>
                        <td>$row[base_price]</td>
                        <td>$row[description]</td>
                        <td><img src='../product_images/$row[image_path]' height='100px' width='200px' object-fit='contain'></td>
                        <td>$row[date_added]</td> 
                        <td><a class='btn btn-danger' href='delete.php?Id=$row[product_id]'>Delete</a></td>
                        <td><a class='btn btn-primary' href='update.php?Id=$row[product_id]'>Update</a></td>
                     </tr>
            
            
            ";
                }
            }
          ?>

        </tbody>
    </table>
</body>

</html>