<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Number</th>
                <th>Address</th>
                <th>Product</th>
                <th>Unit price</th>
                <th>Image</th>
                <th>litre</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include '../database/connect.php';
            $sql = "
                SELECT 
                    orders.order_id as id, 
                    user.name, 
                    user.number, 
                    user.address, 
                    products.title as Product, 
                    products.base_price as Unit_Price, 
                    products.image_path AS Image, 
                    product_options.option_name AS litre,  
                    orders.total_amount, 
                    orders.status 
                FROM 
                    cart_details 
                INNER JOIN 
                    user 
                ON 
                    cart_details.userid = user.id 
                INNER JOIN 
                    products 
                ON 
                    cart_details.product_id = products.product_id 
                INNER JOIN 
                    product_options 
                ON 
                    cart_details.option_id = product_options.option_name 
                INNER JOIN 
                    orders 
                ON 
                    user.id = orders.userid
            ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['number']}</td>
                            <td>{$row['address']}</td>
                             <td>{$row['Product']}</td>
                            <td>{$row['Unit_Price']}</td>
                            <td><img src='../product_images/{$row['Image']}' alt='Product Image' style='width:50px;height:50px;'></td>
                            <td>{$row['litre']}</td>
                            <td>{$row['total_amount']}</td>
                            <td>{$row['status']}</td>
                             <td><a class='btn btn-primary' href='?Id=$row[id]'>Approve</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No data found</td></tr>";
            }

            // Handle form submission
            if (isset($_GET['Id'])) {
                $oid = $_GET['Id'];
                echo $oid;
                $sq = "UPDATE orders
                SET status='Paid'
                    WHERE userid = $oid
                                    ";
                                    
                if($conn->query($sq)){
                    echo "Record updated successfully";
                    
                }
                else{
                    echo'error updating';
                }
            }

            ?>
        </tbody>
    </table>
</body>

</html>